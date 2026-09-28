<?php

namespace App\Http\Controllers\Backend\RlmmMnre;

// namespace App\Services;
use App\Models\RlmmHoldingReason;
use App\Models\RlmmInspectionHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

use App\Models\WindTurbine;
use App\Models\AwAnnexure3;
use App\Models\RlmmForwardDetail;
use App\Models\RlmmMomAppvdMnre;

use App\Models\RlmmMnre;
use App\Models\RlmmUser;
use App\Models\AwApplicationDetail;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Models\Module;
use App\Models\MainMasterModule;
use App\Traits\General;
use App\Models\AuditTrail;
use App\Models\Notification;
use App\Utils\Dashboard;
use App\Models\Feedback;
use App\Utils\EmailSmsNotifications;

use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use PDF;
use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Validation\Rule;

use DB, URL, Hash, Storage, Validator, Config, Session;


class MainController extends Controller
{
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        //dd(Auth::user());
    }
    public function fetchNotificationDetailsById()
    {
        return Notification::getNotification();
    }
    
    public function index()
    {
        $dashboard = new Dashboard();//App-utils-Dashboard

        $data = $dashboard->getMNRERLMMDashboardData();//Dashboard.php (getMNREDashboardData)
        // dd($data);
        $auditData = array('action_type' => 'View', 'description' => 'User viewed Dashboard', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        return view('backend.mnrewind.dashboard', compact('data'));

    }

    // Done By Raushan 
    public function mnreUsers(Request $request)
    {
        $users = RlmmMnre::where('admin', 0)->get();//data fatch kiya
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed MNRE User List', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnrewind.mnreUserList', compact('users'));
    }

    // Done By Raushan 
   public function createMnreUser(Request $request)
   {
    // AES Key and IV (move to .env for security)
    $key = hex2bin("0123456789abcdef0123456789abcdef");
    $iv  = hex2bin("abcdef9876543210abcdef9876543210");

    if ($request->isMethod('get')) {

        // Audit Trail
        $auditData = [
            'action_type' => 'Insert',
            'description' => 'MNRE User visited Create Mnre User page',
            'user_type'   => 'MNRE'
        ];
        $this->auditTrail($auditData);

        return view('backend.mnrewind.createMnreUser');
    }

    // ---------------- POST Request (Create User) ---------------- //
    if ($request->isMethod('post')) {
        try {
            // --- AES Decryption of Password ---
            $decryptedPassword = openssl_decrypt(
                base64_decode($request->password),
                'AES-128-CBC',
                $key,
                OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
                $iv
            );

            $decryptedPassword = trim($decryptedPassword);

            // (Optional) If your frontend appends session token using "-", remove it
            // Example: "MyPass123-SESSIONTOKEN"
            $passwordParts = explode('-', $decryptedPassword);
            $plainPassword = $passwordParts[0]; // First part is the actual password

            // Validation rules
            $rules = [
                'name'     => 'required|string|max:255',
                'email'    => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('rlmm_mnre_users', 'email')
                ],
                'password' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Prepare user data
            $userData = [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($plainPassword)
            ];

            // Create new MNRE user
            RlmmMnre::create($userData);

            // Audit Trail
            $auditData = [
                'action_type' => '2',
                'description' => 'MNRE User created a new user',
                'user_type'   => '1'
            ];
            $this->auditTrail($auditData);

            return redirect('mnre_wind_users/mnre-user-list')
                ->with("status", "New MNRE user created successfully!");

        } catch (\Exception $e) {
            \Log::error("MNRE Create User Error: " . $e->getMessage());
            return redirect()->back()->with("error", "Server Error!");
        }
    }
}

    // Done By Raushan
    public function editMnreUser(Request $request, $id)
    {
        // $user = RlmmMnre::where('id', base64_decode($id))->firstOrFail();
        $user = RlmmMnre::where('id', base64_decode($id))->first()->toArray();
        if ($request->isMethod('post')) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:rlmm_mnres,email,' . $user->id, // ignore same user’s email
            // 'password' => 'required|min:6|confirmed', // optional password update
        ]);

        try {
            $userData = [
                'name'  => $request->name,
                'email' => $request->email,
            ];

            // if (!empty($request->password)) {
            //     $userData['password'] = Hash::make($request->password);
            // }
        
            $user->update($userData);

            $auditData = [
                'action_type' => 'Update',
                'description' => 'MNRE user profile updated',
                'user_type'   => 'MNRE',
            ];
            $this->auditTrail($auditData);

            return redirect()->back()->with('success', 'MNRE user updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

        $user = RlmmMnre::where('id', base64_decode($id))->first()->toArray();
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed update profile page ', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnrewind.createMnreUser', compact('user'));
    }

    // Done By Raushan
    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'documents/systems/' . $folder . '/' . $file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    // Done By Raushan
    public function manufacturerUsers(Request $request)
    {
        $users = RlmmUser::orderBy('id', 'DESC')->paginate(50);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User visited Manufacturer Users', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnrewind.manufacturerUserList', compact('users'));
    }

    public function UserApplications(Request $request)
    {
        $stat = request()->query('stat');
        $stat = base64_decode($stat);
        $i = 0;
        if ($stat == 'underReviewMNRE') {
            $applications = AwApplicationDetail::orderBy('id', 'DESC')->where('status', '1')->where('forward_status', 'mnre')->where('final_submission', 1)->get();
        } else if ($stat == 'pendingReviewNIWE') {
            $applications = AwApplicationDetail::orderBy('id', 'DESC')->where('status', '1')->where('forward_status', 'niwe')->get();
        } else if ($stat == 'scheduledInspections') {
            $applications = AwApplicationDetail::orderBy('id', 'DESC')->where('status', '2')->get();
        } else if ($stat == 'approvedAtNIWE') {
            $applications = AwApplicationDetail::orderBy('id', 'DESC')->where('status', '5')->get();
        } else {
            $applications = AwApplicationDetail::orderBy('id', 'DESC')->where('final_submission', 1)->get();
        }
        foreach ($applications as $data) {
            $inc_history = RlmmInspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
            $applications[$i]['inspectionData'] = $inc_history;

            $holding = RlmmHoldingReason::where('application_id', $applications[$i]->id)->count();
            $applications[$i]['holdingData'] = $holding;

            $i++;
        }

        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Application', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnrewind.applications-list', compact('applications'));
    }


    // Done By Raushan
    public function trackDetail(Request $request, $application_id)
    {
        $applications = AwApplicationDetail::select('created_at', 'application_no')->where('id', base64_decode($application_id))->first();
        //  dd($applications);
        $trackDetail = RlmmForwardDetail::where('application_id', base64_decode($application_id))->orderBy('id', 'DESC')->paginate(50);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Track Detail', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.common.rlmm-track-detail', compact('trackDetail', 'applications'));
    }


    public function forwardto(Request $request, $application_id = NULL)
    {
        if ($request->isMethod('post')) {
        $forward_to='';
                    if ($request->id) {
                        $applicationdetail = AwApplicationDetail::findOrFail($request->id);
                        $applicationdetail->forward_status = $request->forward_status;
                        if ($request->forward_status == 'niwe') {
                            $action = 'Application (' . $applicationdetail->application_no . ') has been Forwarded to NIWE by MNRE';
                            $forward_to='niwe';

                        } elseif ($request->forward_status == 'return_mnre') {
                            $action = 'Application (' . $applicationdetail->application_no . ') has been returned by MNRE';
                            $applicationdetail->final_submission = 0;
                            $forward_to='user';
                            
                        } else {
                            $action = '';
                        }

                        $applicationdetail->status = 1;

                        $applicationdetail->update();
                        $forwardDetail = array('user_type' => 'mnre', 'application_id' => $request->id, 'action' => $action, 'description' => $request->description,'forward_to'=>$forward_to);
                        $this->forwardDetail($forwardDetail);

                        //Notification to User
                        $notifyArray = array('id' => $applicationdetail->user_id, 'to_user_type' => 'mfft', 'message' => $action);
                        $this->userNotification($notifyArray);
                        //dd($notifyArray);
                        //Notification to NIWE
                        $notifyArray = array('id' => 1, 'to_user_type' => 'niwe', 'message' => 'Application (' . $applicationdetail->application_no . ') has been Forwarded by MNRE');
                        $this->userNotification($notifyArray);

                        /*************************Audit Trail Start**********************************/
                        $auditData = array('action_type' => 'Insert', 'description' => $action, 'user_type' => 'MNRE');
                        $this->auditTrail($auditData);
                        /*************************Audit Trail Start**********************************/
                        return redirect('mnre_wind_users/applications-list')->with('status', $action);
                    }

                }

            }

            private function forwardDetail($dataArr)
            {
                $applicationdetail = new RlmmForwardDetail();
                $applicationdetail->user_id = Auth::user()->id;
                $applicationdetail->user_type = $dataArr['user_type'];
                $applicationdetail->application_id = $dataArr['application_id'];
                $applicationdetail->action = $dataArr['action'];
                $applicationdetail->description = $dataArr['description'];

        $applicationdetail->forward_to = $dataArr['forward_to'];
        $applicationdetail->save();
    }

    public function approvemom(Request $request)
    {
            // print_r($_POST);die;
            if ($request->isMethod('post')) {
    
            //  dd($request->all());
            $momId = $request->input('mom_id'); 
            $mom = RlmmMomAppvdMnre::where('application_id', $momId)->first();

            $fileName='';
            if ($request->hasFile('approval_file')) {
                $file = $request->file('approval_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/approvals', $fileName);
            }

            if (empty($mom)) {
                $mom = new RlmmMomAppvdMnre();
                $mom->application_id=$momId;
                    $mom->approval_message=$request->approval_message;
                        $mom->approval_file=$fileName;
                        $mom->save();
            // return back()->with('error', 'MoM not found.');
            }
            else{
                  $mom->application_id=$momId;
                       $mom->approval_message=$request->approval_message;
                         $mom->approval_file=$fileName;
                          $mom->save();
            }

            return back()->with('success', 'Committee approval saved successfully.');
        }
    }
       

    public function ApplicationsListMoM(Request $request)
    {
            $i = 0;
       //$applications = RlmmMomAppvdMnre::join('aw_application_details','mom_details.application_id','=','aw_application_details.id')->orderBy('id', 'DESC')->where('final_submission', 1)->get();
        $applications = RlmmMomAppvdMnre::join('aw_application_details', 'mom_details.application_id', '=', 'aw_application_details.id')
        ->where('aw_application_details.final_submission', 1)
        ->orderBy('mom_details.id', 'DESC')
        ->get();
     
      return view('backend.mnrewind.applications-list-mom',compact('applications'));
    }



    public function viewApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;
        $appData = AwApplicationDetail::where('id', $id)
            // ->where('user_id', Auth::user()->id)
            ->first();
            //  dd($appData);
        $annexuredata = AwAnnexure3::where('application_id', $application_id)
        // ->where('user_id', Auth::user()->id)
        ->first();
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        $main_model=AwApplicationDetail::select('turbine_model')->where('id',$application_id)->first()['turbine_model'];
        $annexuremultipledata = WindTurbine::where('application_id', $application_id)
            // ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();
    
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed application detail', 'user_type' => 'MNREWIND');
        $this->auditTrail($auditData);
        /*************************Audit Trail End**********************************/
        return view('backend.mnrewind.view-applications', compact('application_id','annexuredata1','appData','annexuredata','main_model','annexuremultipledata'));
    }

    
    public function downloadPdfApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;

        $appData = AwApplicationDetail::where('id', $id)->first();
        //  dd($appData);
        $annexuredata = AwAnnexure3::where('application_id', $application_id)->first();
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        $main_model=AwApplicationDetail::select('turbine_model')->where('id',$application_id)->first()['turbine_model'];
        $annexuremultipledata = WindTurbine::where('application_id', $application_id)
            // ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();
        
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed application detail ', 'user_type' => 'MFFT');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/

        $aryData = array('annexuredata' => $annexuredata, 'appData' => $appData, 'annexuredata1' => $annexuredata1, 'application_id' => $application_id,'main_model' =>$main_model, 'annexuremultipledata'=>$annexuremultipledata );
        $pdf = PDF::loadView('backend.mnrewind.pdf-applications', $aryData);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('application' . date('YmdHis') . '.pdf');

        return view('backend.mnrewind.pdf-applications', compact('annexuredata', 'application_id', 'annexuredata1', 'appData','main_model','annexuremultipledata'));
    }


    public function resetPassword(Request $request)
    {
        $manufacturer_user = RlmmUser::findOrFail($request->id);
        $password = $this->randomPassword();
        $password_hash = Hash::make($password);
        $manufacturer_user->password = $password_hash;
        $manufacturer_user->update();
        if ($manufacturer_user->update()) {

            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Update', 'description' => 'Password has been changed by MNRE User', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            //Please mail function add here
            return response()->json(['success' => 'Password has been changed successfully']);
        } else {
            return response()->json(['error' => 'Error In Password Changing']);
        }

    }

    public function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function editProfile(Request $request)
    {
        try {
            $user = Auth::user();
            if ($request->isMethod('get')) {
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed edit Profile Page', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return view('backend.mnre.editProfile', compact('user'));
            }

            $user->name = $request->name;
            $isSaved = $user->save();
            if ($isSaved) {
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => 'Profile edited MNRE User', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return redirect()->back()->with("status", "Profile edited successfully !");
            }
        } catch (\Throwable $th) {
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'ExError', 'description' => 'Server Error !', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("error", "Server Error !");
        }
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('get')) {
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'Manufacturer User view Change Password Option', 'user_type' => 'MFT');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            $submitUrl = URL::to('/mnre_wind_users/change-password');
            return view('backend.common.changePassword', compact('submitUrl'));
        }

        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv = hex2bin("abcdef9876543210abcdef9876543210");
        // Current Password
        $decryptedCrPass = openssl_decrypt($request->current_password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedCrPass = trim($decryptedCrPass);

        //New Password
        $decryptedNwPass = openssl_decrypt($request->new_password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedNwPass = trim($decryptedNwPass);

        $password = explode('-', $decryptedNwPass);
        $decryptedCrPass = explode('-', $decryptedCrPass);
        $sessionToken = Session::get('token');
        // dd($password);
        // echo $sessionToken; die();
        // if ($password[1] != $sessionToken) {

        //     return redirect()->back()->with("error", "Invalid Request !");
        // }
        $request->merge([
            'current_password' => $decryptedCrPass[0],
            'new_password' => $password[0],
        ]);
        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (!$this->passwordPolicyTest($request->new_password)) {
            $error = 'Failed strong password policy!';
            return redirect()->back()->with("error", $error);
        }

        if (strcmp($request->current_password, $request->new_password) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with("status", "Password changed successfully !");
    }
    // public function changePassword(Request $request)
        // {
        //     try {
        //         if ($request->isMethod('get')) {
        //             $submitUrl = URL::to('/mnre_wind_users/change-password');
        //             /*************************Audit Trail Start**********************************/
        //             $auditData = array('action_type' => 'View', 'description' => 'MNRE User view Change Password Option', 'user_type' => 'MNRE');
        //             $this->auditTrail($auditData);
        //             /*************************Audit Trail Start**********************************/
        //             // dd("hi");
        //             return view('backend.common.changePassword', compact('submitUrl'));
        //         }
        //         $request->validate(
        //             [
        //                 'current_password' => 'required',
        //                 'new_password' => 'required|min:8',
        //                 'new_password_confirmation' => 'required',
        //             ]
        //         );
        //         $key = hex2bin("0123456789abcdef0123456789abcdef");
        //         $iv = hex2bin("abcdef9876543210abcdef9876543210");
        //         // Current Password
        //         $decryptedCrPass = openssl_decrypt($request->current_password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        //         $decryptedCrPass = trim($decryptedCrPass);

        //         //New Password
        //         $decryptedNwPass = openssl_decrypt($request->new_password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        //         $decryptedNwPass = trim($decryptedNwPass);

        //         $password = explode('-', $decryptedNwPass);
        //         $decryptedCrPass = explode('-', $decryptedCrPass);
        //         $sessionToken = Session::get('token');
        //         //dd($password);
        //         if ($password[1] != $sessionToken) {
        //             return redirect()->back()->with("error", "Invalid Request !");
        //         }
        //         $request->merge([
        //             'current_password' => $decryptedCrPass[0],
        //             'new_password' => $password[0],
        //         ]);
                
        //         if (!(Hash::check($request->current_password, Auth::user()->password))) {
        //             /*************************Audit Trail Start**********************************/
        //             $auditData = array('action_type' => 'Update', 'description' => ' MNRE User  Match Password ', 'user_type' => 'MNRE');
        //             $this->auditTrail($auditData);
        //             /*************************Audit Trail Start**********************************/
        //             // The passwords matches
        //             return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        //         }

        //         if (!$this->passwordPolicyTest($request->new_password)) {
        //             $error = 'Failed strong password policy!';
        //             /*************************Audit Trail Start**********************************/
        //             $auditData = array('action_type' => 'Update', 'description' => 'MNRE User Test password Policy  ', 'user_type' => 'MNRE');
        //             $this->auditTrail($auditData);
        //             /*************************Audit Trail Start**********************************/

        //             return redirect()->back()->with("error", $error);
        //         }

        //         if (strcmp($request->current_password, $request->new_password) == 0) {
        //             /*************************Audit Trail Start**********************************/
        //             $auditData = array('action_type' => 'Update', 'description' => ' MNRE User verify condition currunt and new password not same  ', 'user_type' => 'MNRE');
        //             $this->auditTrail($auditData);
        //             /*************************Audit Trail Start**********************************/
        //             //Current password and new password are same
        //             return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        //         }

        //         //Change Password
        //         $user = Auth::user();
        //         $user->password = bcrypt($request->new_password);
        //         $user->save();
        //         /*************************Audit Trail Start**********************************/
        //         $auditData = array('action_type' => 'Update', 'description' => ' MNRE User Inserted new password  ', 'user_type' => 'MNRE');
        //         $this->auditTrail($auditData);
        //         /*************************Audit Trail Start**********************************/
        //         return redirect()->back()->with("status", "Password changed successfully !");
        //     } catch (\Throwable $th) {
        //         dd($th->getMessage());
        //         return redirect()->back()->with("error", "Server Error !");
        //     }
    // }
    
    public function userAuditTrail(Request $request)
    {

        if ($request->isMethod('get')) {
            $auditTrailData = AuditTrail::orderBy("entry_date", 'DESC')->paginate(30);
            return view('backend.mnrewind.auditTrail', compact('auditTrailData'));
        }
        $validatedData = $request->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
        ]);
        $fromdata = $request->input('fromDate');
        $todata = $request->input('toDate');

        $auditTrailData = AuditTrail::whereBetween('entry_date', [$fromdata, $todata . ' 23:59:59'])->paginate(30);
        return view('backend.mnrewind.auditTrail', compact('auditTrailData', 'fromdata', 'todata'));

    }

    public function reports(Request $request)
    {

        $applicationDetails = AwApplicationDetail::select('id', 'user_id', 'manufacturer_name', 'register_office_address', 'manufacturing_capacity')
        
            ->where('final_submission', '=', 1)
            ->where('forward_status', '=', 'niwe')
            ->where('status', '=', 5)
            ->orderBy('id', 'DESC')
            ->get();
     // dd($applicationDetails);
        $i = 0;
        foreach ($applicationDetails as $application) {
            $user_id = $application['user_id'];
            $applicationDetails[$i]['annexure1'] = Annexure1::getAnnexureData($application['id'], $user_id, 1);
            $applicationDetails[$i]['bis'] = Annexure3::select('bis_certificate_no', 'bis_certificate_issue', 'bis_certificate_valid')
                ->where('application_id', '=', $application['id'])
                ->where('sub_annexure', '=', 1)
                ->whereNotNull('bis_certificate_no')
                ->whereNotNull('bis_certificate_issue')
                ->whereNotNull('bis_certificate_valid')
                ->orderBy('id', 'DESC')
                ->limit(1)
                ->get();
            $i++;
        }

        if ($request->has('download')) {
            // $mpdf = new Mpdf();
            // $mpdf->WriteHTML(view('backend.mnre.reportPdf', compact('applicationDetails')));
            // $filename = "approved-list-" . time() . ".pdf";
            // return $mpdf->Output($filename, 'D');

            // Initialize Dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($options);
            $html = view('backend.mnrewind.reportPdf', compact('applicationDetails'))->render();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $filename = "approved-list-" . time() . ".pdf";
            $dompdf->stream($filename, array("Attachment" => true));
        } else {
            return view('backend.mnrewind.reports', compact('applicationDetails'));
        }
    }

    public function feedbacks(Request $request)
    {
        $feedbackData = Feedback::orderBy('id', 'DESC')->paginate(30);
        $feedbackData->getCollection()->transform(function ($feedback) {
            $feedback->created_at_human = Carbon::parse($feedback->created_at)->format('d-m-Y h:i A');
            return $feedback;
        });
        return view('backend.mnrewind.viewFeedback', compact('feedbackData'));
    }

    public function holdingReason(Request $request)
    {
        try {
            $data = RlmmHoldingReason::where('user_id', $request->user_id)->where('application_id', $request->app_id)->orderBy('id', 'DESC')->get();
            $data->transform(function ($item, $key) {
                $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y H:i:s');
                return $item;
            });
            return response()->json(['data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getCode() . '||' . $th->getMessage()])->setStatusCode(500);
            ;
        }
    }

}