<?php

namespace App\Http\Controllers\Backend\Mnre;

use App\Models\HoldingReason;
use App\Models\InspectionHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Annexure1;
// use App\Models\Annexure2;
use App\Models\Annexure3;
// use App\Models\Annexure4;
// use App\Models\Annexure5;
// use App\Models\Annexure6;
// use App\Models\BillMaterial;
use App\Models\ForwardDetail;
use App\Models\ApplicationDetail;
use App\Models\ApplicationPaymentDetails;
// use App\Models\AppliedPvmodel;
// use App\Models\State;
use App\Models\Mnre;
use App\Models\Module;
use App\Models\MainMasterModule;
// use App\Models\Program;
use App\Traits\General;
// use App\Models\Consumer;
// use App\Models\District;
// use App\Models\SubDistrict;
use App\Models\AuditTrail;
use App\Models\Notification;
use App\Utils\Dashboard;
use App\Models\Feedback;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use PDF;
use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Dompdf\Options;

use DB, URL, Auth, Hash, Storage, Validator, Config, Session;


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

        $data = $dashboard->getMNREDashboardData();//Dashboard.php (getMNREDashboardData)
        $auditData = array('action_type' => 'View', 'description' => 'User viewed Dashboard', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        return view('backend.mnre.dashboard', compact('data'));

    }
 
    public function mnreUsers(Request $request)
    {
        $users = Mnre::where('admin', 0)->get();//data fatch kiya
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed MNRE User List', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.mnreUserList', compact('users'));
    }

    public function createMnreUser(Request $request)
    {
        if ($request->isMethod('get')) {
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Insert', 'description' => ' MNRE User visited Create Mnre User ', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.mnre.createMnreUser');
        } elseif ($request->isMethod('post')) {
            try {
                $userData = [
                    'name' => $request->name,
                    'email' => $request->email
                ];
                if (!empty($request->password))
                    $userData['password'] = Hash::make($request->password);

                if (empty($request->id)) {
                    $msg = 'New MNRE user created successfully!';
                    Mnre::create($userData);

                    /*************************Audit Trail Start**********************************/
                    $auditData = array('action_type' => '2', 'description' => ' MNRE User create new user ', 'user_type' => '1');
                    $this->auditTrail($auditData);
                    /*************************Audit Trail Start**********************************/
                } else {

                    $msg = 'MNRE user updated successfully!';
                    Mnre::where('id', $request->id)->update($userData);

                    /*************************Audit Trail Start**********************************/
                    $auditData = array('action_type' => '3', 'description' => ' MNRE User Update data in mnre-user-list ', 'user_type' => '1');
                    $this->auditTrail($auditData);
                    /*************************Audit Trail Start**********************************/
                }

                return redirect('mnre/mnre-user-list')->with("status", $msg);
            } catch (\Exception $e) {
                return redirect()->back()->with("error", "Server Error!");
            }
        }
    }

    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'documents/systems/' . $folder . '/' . $file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    public function editMnreUser(Request $request, $id)
    {

        $user = Mnre::where('id', base64_decode($id))->first()->toArray();
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed update profile page ', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.createMnreUser', compact('user'));
    }

    public function manufacturerUsers(Request $request)
    {
        $users = User::orderBy('id', 'DESC')->paginate(50);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User visited Manufacturer Users', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.manufacturerUserList', compact('users'));
    }

    public function UserApplications(Request $request)
    {
        $stat = request()->query('stat');
        $stat = base64_decode($stat);
        $i = 0;
        if ($stat == 'underReviewMNRE') {
            $applications = ApplicationDetail::orderBy('id', 'DESC')->where('status', '0')->where('forward_status', 'mnre')->where('final_submission', 1)->get();
        } else if ($stat == 'pendingReviewNISE') {
            $applications = ApplicationDetail::orderBy('id', 'DESC')->where('status', '1')->where('forward_status', 'nise')->get();
        } else if ($stat == 'scheduledInspections') {
            $applications = ApplicationDetail::orderBy('id', 'DESC')->where('status', '2')->get();
        } else if ($stat == 'approvedAtNISE') {
            $applications = ApplicationDetail::orderBy('id', 'DESC')->where('status', '5')->get();
        } else {
            $applications = ApplicationDetail::orderBy('id', 'DESC')->where('final_submission', 1)->get();
        }
        foreach ($applications as $data) {
            $inc_history = InspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
            $applications[$i]['inspectionData'] = $inc_history;

            $holding = HoldingReason::where('application_id', $applications[$i]->id)->count();
            $applications[$i]['holdingData'] = $holding;

            $i++;
        }

        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Application', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.mnre.applications-list', compact('applications'));
    }

    public function trackDetail(Request $request, $application_id)
    {
        $applications = ApplicationDetail::select('created_at', 'application_no')->where('id', base64_decode($application_id))->first();
        // dd($applications);
        $trackDetail = ForwardDetail::where('application_id', base64_decode($application_id))->orderBy('id', 'DESC')->paginate(50);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Track Detail', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.common.track-detail', compact('trackDetail', 'applications'));
    }

    public function forwardto(Request $request, $application_id = NULL)
    {
        if ($request->isMethod('post')) {

            if ($request->id) {
                $applicationdetail = ApplicationDetail::findOrFail($request->id);
                $applicationdetail->forward_status = $request->forward_status;
                if ($request->forward_status == 'nise') {
                    $action = 'Application (' . $applicationdetail->application_no . ') has been Forwarded to NISE by MNRE';

                } elseif ($request->forward_status == 'return_mnre') {
                    $action = 'Application (' . $applicationdetail->application_no . ') has been returned by MNRE';
                    $applicationdetail->final_submission = 0;
                     $forward_to='user';
                } else {

                    $action = '';
                }
                
                $applicationdetail->status = 1;

                $applicationdetail->update();
                $forwardDetail = array('user_type' => 'mnre', 'application_id' => $request->id, 'action' => $action, 'description' => $request->description);
                $this->forwardDetail($forwardDetail);

                //Notification to User
                $notifyArray = array('id' => $applicationdetail->user_id, 'to_user_type' => 'users', 'message' => $action);
                $this->userNotification($notifyArray);

                //Notification to NISE
                $notifyArray = array('id' => 1, 'to_user_type' => 'nise', 'message' => 'Application (' . $applicationdetail->application_no . ') has been Forwarded by MNRE');
                $this->userNotification($notifyArray);

                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Insert', 'description' => $action, 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return redirect('mnre/applications-list')->with('status', $action);
            }

        }
    }

    private function forwardDetail($dataArr)
    {
        $applicationdetail = new ForwardDetail();
        $applicationdetail->user_id = Auth::user()->id;
        $applicationdetail->user_type = $dataArr['user_type'];
        $applicationdetail->application_id = $dataArr['application_id'];
        $applicationdetail->action = $dataArr['action'];
        $applicationdetail->description = $dataArr['description'];
        $applicationdetail->save();
    }


    public function viewApplication(Request $request, $id)
    {
        // dd($request);
        $id = $this->decodeid($id);
        $application_id = $id;

        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        // $annexuredata = ApplicationDetail::where('id', $application_id)->where('user_id', Auth::user()->id)->first();
        $annexuredata = ApplicationDetail::where('id', $application_id)->first();
        $moduleData = MainMasterModule::getModuleDataById($id);
        // $appData = Annexure1::getAllAnnexureData($application_id,Auth::mnre()->id);
        // $appData3 = Annexure3::getAllAnnexureData($application_id,Auth::mnre()->id);
        $appData = Annexure1::where('application_id', $application_id)->get();
        $appData3 = Annexure3::where('application_id', $application_id)->get();

        $bis_test_report = ApplicationDetail::where('id', $application_id)->value('bis_test_report');

        // $bis_test_report=ApplicationDetail::select('bis_test_report')->where('id',$application_id)->first();
        $applicationData = ApplicationDetail::getApplicationDataWithFee($id);
        
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed application detail', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail End**********************************/
        return view('backend.mnre.view-applications', compact('annexureData', 'application_id','annexuredata1','annexuredata','bis_test_report','moduleData','appData','appData3','applicationData'));
    }

    public function downloadPdfApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;
        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        $annexuredata = ApplicationDetail::where('id', $application_id)->first();
        $moduleData = MainMasterModule::getModuleDataById($id);
        $appData = Annexure1::where('application_id', $application_id)->get();
        $appData3 = Annexure3::where('application_id', $application_id)->get();
        $bis_test_report = ApplicationDetail::where('id', $application_id)->value('bis_test_report');
        $applicationData = ApplicationDetail::getApplicationDataWithFee($id);

        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'Mnre user viewed application detail ', 'user_type' => 'MNRE');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/

        $aryData = array('annexureData' => $annexureData, 'application_id' => $application_id, 'annexuredata1' => $annexuredata1, 'annexuredata' => $annexuredata, 'moduleData' => $moduleData,
        'appData' => $appData, 'appData3' => $appData3, 'bis_test_report' => $bis_test_report, 'applicationData' => $applicationData );
        $pdf = PDF::loadView('backend.mnre.pdf-applications', $aryData);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('application' . date('YmdHis') . '.pdf');

        return view('backend.mnre.pdf-applications', compact('annexureData', 'application_id','annexuredata', 'moduleData', 'appData', 'appData3','annexuredata1','bis_test_report','applicationData'));
    }


    public function resetPassword(Request $request)
    {
        $manufacturer_user = User::findOrFail($request->id);
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
        try {
            if ($request->isMethod('get')) {
                $submitUrl = URL::to('/mnre/change-password');
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'View', 'description' => 'MNRE User view Change Password Option', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                // dd("hi");
                return view('backend.common.changePassword', compact('submitUrl'));
            }
            $request->validate(
                [
                    'current_password' => 'required',
                    'new_password' => 'required|min:8',
                    'new_password_confirmation' => 'required',

                ]
            );
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
            //dd($password);
            if ($password[1] != $sessionToken) {
                return redirect()->back()->with("error", "Invalid Request !");
            }
            $request->merge([
                'current_password' => $decryptedCrPass[0],
                'new_password' => $password[0],
            ]);
            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => ' MNRE User  Match Password ', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                // The passwords matches
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }

            if (!$this->passwordPolicyTest($request->new_password)) {
                $error = 'Failed strong password policy!';
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => 'MNRE User Test password Policy  ', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/

                return redirect()->back()->with("error", $error);
            }

            if (strcmp($request->current_password, $request->new_password) == 0) {
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => ' MNRE User verify condition currunt and new password not same  ', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                //Current password and new password are same
                return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            }

            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->new_password);
            $user->save();
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Update', 'description' => ' MNRE User Inserted new password  ', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("status", "Password changed successfully !");
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with("error", "Server Error !");
        }
    }
    
    public function userAuditTrail(Request $request)
    {

        if ($request->isMethod('get')) {
            $auditTrailData = AuditTrail::orderBy("entry_date", 'DESC')->paginate(30);
            return view('backend.mnre.auditTrail', compact('auditTrailData'));
        }
        $validatedData = $request->validate([
            'fromDate' => 'required',
            'toDate' => 'required',
        ]);
        $fromdata = $request->input('fromDate');
        $todata = $request->input('toDate');

        $auditTrailData = AuditTrail::whereBetween('entry_date', [$fromdata, $todata . ' 23:59:59'])->paginate(30);
        return view('backend.mnre.auditTrail', compact('auditTrailData', 'fromdata', 'todata'));

    }

    public function reports(Request $request)
    {

        $applicationDetails = ApplicationDetail::select('id', 'user_id', 'manufacturer_name', 'register_office_address', 'manufacturing_capacity')
            ->where('final_submission', '=', 1)
            ->where('forward_status', '=', 'nise')
            ->where('status', '=', 5)
            ->orderBy('id', 'DESC')
            ->get();

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
            $html = view('backend.mnre.reportPdf', compact('applicationDetails'))->render();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $filename = "approved-list-" . time() . ".pdf";
            $dompdf->stream($filename, array("Attachment" => true));
        } else {
            return view('backend.mnre.reports', compact('applicationDetails'));
        }
    }

    public function feedbacks(Request $request)
    {
        $feedbackData = Feedback::orderBy('id', 'DESC')->paginate(30);
        $feedbackData->getCollection()->transform(function ($feedback) {
            $feedback->created_at_human = Carbon::parse($feedback->created_at)->format('d-m-Y h:i A');
            return $feedback;
        });
        return view('backend.mnre.viewFeedback', compact('feedbackData'));
    }

    public function holdingReason(Request $request)
    {
        try {
            $data = HoldingReason::where('user_id', $request->user_id)->where('application_id', $request->app_id)->orderBy('id', 'DESC')->get();
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