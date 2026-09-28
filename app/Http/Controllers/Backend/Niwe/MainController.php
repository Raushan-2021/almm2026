<?php

namespace App\Http\Controllers\Backend\Niwe;

use Illuminate\Http\Request;
use App\Models\RlmmHoldingReason;
use Carbon\Carbon;
use App\Models\AnnexureAttachment;
use App\Models\Module;
use App\Utils\Dictionary;
use App\Utils\ApplicationProgress;
use App\Models\RlmmForwardDetail;
use App\Models\AwApplicationDetail;
use App\Models\RlmmUser;
use App\Models\RlmmMnre;
use App\Models\RlmmInspectionHistory;
use App\Traits\General;
use App\Models\WindTurbine;
use App\Models\AwAnnexure3;
use App\Models\AuditTrail;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\MainMasterModule;
use App\Models\Feedback;
use App\Utils\AwNewApplicationFormValidator;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RlmmNiwe;
use App\Models\RlmmMomAppvdMnre;
use PDF;
use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Dompdf\Options;

use DB, URL, Hash, Storage, Validator, Config, Session, Exception;



class MainController extends Controller
{
    use General;

    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        $this->ProgressBar = new ApplicationProgress(); //Utils
        $this->validator = new AwNewApplicationFormValidator();
        // $this->middleware('onlyOneUser');
    }

    public function index(Request $request)
    {
        try {
            $dashboard = new Dashboard(); //App-utils-Dashboard
            $data = $dashboard->getNIWEDashboardData();
            $auditData = array('action_type' => '1', 'description' => 'NIWE viewed Dashboard', 'user_type' => '1');
            $this->auditTrail($auditData);

            return view('backend.niwe.dashboard', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
    }


    public function UserApplications(Request $request)
    {
        try {
            //code...
            $stat = request()->query('stat');
            $stat = base64_decode($stat);
            $applications = array();
            $i = 0;
            if ($stat == 'pending') {
                $inspectionHistory = AwApplicationDetail::where('status', '1')->where('forward_status', 'niwe')->orderBy('id', 'DESC')->get();
            } else if ($stat == 'scheduled') {
                $inspectionHistory = AwApplicationDetail::where('status', '2')->orderBy('id', 'DESC')->get();
            } else if ($stat == 'approvedAtNIWE') {
                $inspectionHistory = AwApplicationDetail::where('status', '5')->orderBy('id', 'DESC')->get();
            } else {
                $inspectionHistory = AwApplicationDetail::where('forward_status', 'niwe')->orderBy('id', 'DESC')->get();
            }
            foreach ($inspectionHistory as $data) {
                $i++;
                $applications[$i] = $data;
                $inc_history = RlmmInspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
                $applications[$i]['inspectionData'] = $inc_history;
                // dd($applications[$i]);
                $holding = RlmmHoldingReason::where('application_id', $applications[$i]->id)->count();
                $applications[$i]['holdingData'] = $holding;
            }
            //  dd($applications);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Application', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.niwe.applications-list', compact('applications'));
            
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    // Done by Raushan 
    public function manufacturerUsers(Request $request)
    {
        try {
            //code...
            $users = RlmmUser::orderBy('id', 'DESC')->paginate(50);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User visited Manufacturer Users', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.niwe.manufacturerUserList', compact('users'));
           
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    // Raushan For Niwe View
    public function viewApplication(Request $request, $id)
    {
            $id = $this->decodeid($id);
            $application_id = $id;
            $appData = AwApplicationDetail::where('id', $id)
            // ->where('user_id', Auth::user()->id)
            ->first();
            $inspection=RlmmInspectionHistory::where('application_id',$id)->first();

            $annexuredata = AwAnnexure3::where('application_id', $application_id)->first();
            // ->where('user_id', Auth::user()->id)
          
	        $annexuredata1 = Module::getExistingModuleDataById($application_id);
            $main_model=AwApplicationDetail::select('turbine_model')->where('id',$application_id)->first()['turbine_model'];
            $annexuremultipledata = WindTurbine::where('application_id', $application_id)
            // ->where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();

            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'NIWE User viewed application detail', 'user_type' => 'NIWE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.niwe.view-applications', compact('application_id','annexuredata1','appData','annexuredata','main_model','annexuremultipledata','inspection'));
    }
    
    // Done by Raushan 
    public function downloadPdfApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;
        
        $appData = AwApplicationDetail::where('id', $id)
        // ->where('user_id', Auth::user()->id)
        ->first();
        //  dd($appData);
        $annexuredata = AwAnnexure3::where('application_id', $application_id)->first();

        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        $main_model=AwApplicationDetail::select('turbine_model')->where('id',$application_id)->first()['turbine_model'];
        $annexuremultipledata = WindTurbine::where('application_id', $application_id)
            // ->where('user_id', Auth::user()->id)
            // ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();

        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed application detail ', 'user_type' => 'MFFT');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/

        $aryData = array('annexuredata' => $annexuredata, 'appData' => $appData, 'annexuredata1' => $annexuredata1, 'application_id' => $application_id, 'main_model' => $main_model, 'annexuremultipledata'=> $annexuremultipledata);
        $pdf = PDF::loadView('backend.niwe.pdf-applications', $aryData);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('application' . date('YmdHis') . '.pdf');

        return view('backend.niwe.pdf-applications', compact('annexuredata', 'application_id', 'appData', 'annexuredata1', 'main_model', 'annexuremultipledata'));
    }
    

    public function trackDetail(Request $request, $application_id)
    {
        try {
            //code...
            $application_id = $this->decodeid($application_id);
            $applications = AwApplicationDetail::select('created_at')->where('id', $application_id)->first();
            $trackDetail = RlmmForwardDetail::where('application_id', $application_id)->orderBy('id', 'DESC')->paginate(50);
            //  $trackDetail = ForwardDetail::where('application_id', $application_id)->orderBy('id', 'DESC')->get();
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Track Detail', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.common.rlmm-track-detail', compact('trackDetail', 'applications'));
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th->getMessage());
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    public function acceptRequest(Request $request)
    {  
        $inspectHistory = RlmmInspectionHistory::findOrFail($request->id);
        $inspectHistory->status = 1;
        $inspectHistory->save();

        $appRow=AwApplicationDetail::where('id',$inspectHistory->application_id)->first();
        $appRow->status=5;
        $appRow->save();

        if ($inspectHistory->save()) {
            $auditData = array('action_type' => 'Update', 'description' => 'NIWE Accept to Re-Schedule Inspection Date', 'user_type' => 'NIWE');
            $this->auditTrail($auditData);
            $action = 'NIWE Accept to Re-Schedule Inspection Date';
            //Please mail function add here

            //Notification to User
            $notifyArray = array('id' => $inspectHistory->user_id, 'to_user_type' => 'MFFT', 'message' => $action,'application_id' => $inspectHistory->application_id);
            $this->userNotification($notifyArray);
            return response()->json(['success' => 'Accepted successfully']);
        } else {
            return response()->json(['error' => 'Error']);
        }
    }

    public function completeInspection(Request $request)
    {
        // echo "testnbbn";die;
        $validation = $this->validator->validateInspectionReportForm($request);
        if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json(['status' => 'verror', 'data' => $validation['message']]);
        }
        try {
            $dir_path_payment = 'systems\\Annexure\\';
            Storage::disk('filestore')->makeDirectory($dir_path_payment);
            $applicationdetail = AwApplicationDetail::findOrFail($request->application_id);

            if ($request->hasFile('inspection_report')) {
                $inspection_report = $this->uploadFile($request->file('inspection_report'), $dir_path_payment, 'INSPECTION_REPORT_' . $request->application_id . '_' . date('ymd'));
                $applicationdetail->inspection_report = $inspection_report['name'];
            }

            $applicationdetail->inspection_remarks = $request->inspection_remarks;
            $applicationdetail->status = 5; //Inspection Completed
            $applicationdetail->update();

            $action = 'NIWE completed Inspection on ' . date('Y-m-d');
            $forwardDetail = array('user_type' => 'niwe', 'application_id' => $request->application_id, 'action' => $action, 'description' => $request->inspection_remarks);
            $this->forwardDetail($forwardDetail); //Defined in Trait/General.php

            //Notification to USERS
            $notifyArray = array('id' => $request->user_id, 'to_user_type' => 'MFFT', 'message' => $action, 'application_id' => $request->application_id);
            $this->userNotification($notifyArray);

            //Notification to MNRE
            $notifyArray = array('id' => $request->user_id, 'to_user_type' => 'mnre', 'message' => $action, 'application_id' => $request->application_id);
            $this->userNotification($notifyArray);             
  
            $auditData = array('action_type' => 'Upload', 'description' => 'NIWE Uploaded Inspection Report', 'user_type' => 'NIWE');
            $this->auditTrail($auditData);
            $url = urlencode('/niwe/applications-list');
            return response()->json(['status' => 'success', 'message' => 'Inspection Report upload successfuly', 'url' => $url]);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getCode() . '||' . $th->getMessage());
            return response()->json(['status' => 'ExError', 'message' => $th->getCode() . '||' . $th->getMessage()]);
        }
    }

    // Done by Raushan 
    public function rejectRequest(Request $request)
    {
        $inspectHistory = RlmmInspectionHistory::findOrFail($request->id);
        $inspectHistory->status = 2;
        $inspectHistory->save();
        if ($inspectHistory->save()) {
            $auditData = array('action_type' => 'Update', 'description' => 'NIWE Return to Re-Schedule Inspection Date', 'user_type' => 'NIWE');
            $this->auditTrail($auditData);
            $action = 'NIWE Return to Re-Schedule Inspection Date';
            //Please mail function add here

            //Notification to User
            $notifyArray = array('id' => $inspectHistory->user_id, 'to_user_type' => 'MFFT', 'message' => $action);
            $this->userNotification($notifyArray);
            return response()->json(['success' => 'Returned successfully']);
        } else {
            return response()->json(['error' => 'Error']);
        }
    }

    public function scheduleInspection(Request $request)
    {
        try {
            //code...
            // dd($request);
            // print_r($_POST);die;

            $this->validate($request, [
                'inspection_date' => 'required|after:now',
            ]);
            $inspectHistory = new RlmmInspectionHistory();
            $inspectHistory->user_id = $request->user_id;
            $inspectHistory->application_id = $request->application_id;
            $inspectHistory->inspection_date = $request->inspection_date;
            $inspectHistory->proposed_date = $request->proposedDate;
            $inspectHistory->remark = $request->description;
            $inspectHistory->entry_date = $this->getCurrentDate();
            $inspectHistory->save();

            //Updating status
            $applicationdetail = AwApplicationDetail::findOrFail($request->application_id);
            $applicationdetail->status = 2;
            $applicationdetail->update();

            $action = 'NIWE scheduled Inspection date to ' . $request->inspection_date;
            $forwardDetail = array('user_type' => 'niwe', 'application_id' => $request->application_id, 'action' => $action, 'description' => $request->description);
            $this->ForwardDetail($forwardDetail); //Defined in Trait/General.php

            //Notification to NIWE
            $notifyArray = array('id' => $request->user_id, 'to_user_type' => 'MFFT', 'message' => $action);
            $this->userNotification($notifyArray);

            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Update', 'description' => $action, 'user_type' => 'NIWE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect('niwe/applications-list?stat=' . base64_encode('scheduled'))->with('status', $action);
        } catch (\Throwable $th) {
            //throw $th;

            dd($th->getMessage());
        }
    }


    public function editProfile(Request $request)
    {
        $user = Auth::user();
        $states = State::all();
        $countries = Country::all();
        if ($request->isMethod('get')) {
            return view('backend.user.editProfile', compact('user', 'states', 'countries'));
        }
        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv = hex2bin("abcdef9876543210abcdef9876543210");

        $decryptedPan = openssl_decrypt($request->pan, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedPan = trim($decryptedPan);
        $request->merge(['pan' => $decryptedPan,]);

        $request->validate(
            [
                'name' => 'required|string|regex:/^[a-zA-Z ]*$/|max:20',
                'phone' => 'required|numeric|digits:10',
                'pan' => 'required|regex:/[A-Za-z]{5}[0-9]{4}[A-Za-z]/',
                'gst' => 'required',
                'address' => 'required',
                'country_id' => 'required',
                'state_id' => 'required_if:country_id,99',
                'district_id' => 'required_if:country_id,99',
                'pin_code' => 'required'
            ],
            [
                'phone.required' => 'Please enter mobile number',
                'phone.numeric' => 'The mobile number must be a number.',
                'phone.digits:10' => 'The mobile number must be 10 digits.',
                'pan.required' => 'The PAN number field is required.',
                'pan.regex' => 'The PAN number format is not valid',
                'gst.required' => 'The GST number field is required.',
                'country_id.required' => 'Please choose your country.',
                'district_id.required' => 'Please choose district.',
            ]
        );
        $dir_path_certificate = 'systems\\Logo\\';
        Storage::disk('filestore')->makeDirectory($dir_path_certificate);
        $user->state_id = $request->state_id;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gst = $request->gst;
        $user->pan = $request->pan;
        $user->address = $request->address;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->pin_code = $request->pin_code;


        if ($request->hasFile('picture')) {
            $picture = $this->uploadFile($request->file('picture'), $dir_path_certificate, 'Avatar_' . Auth::user()->id);
            $user->picture = $picture['name'];
        }
        $isSaved = $user->save();
        if ($isSaved) {
            return redirect()->back()->with("status", "Profile edited successfully !");
        }
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('get')) {
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'Manufacturer User view Change Password Option', 'user_type' => 'MFT');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            $submitUrl = URL::to('/niwe/change-password');
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

    public function forcedPasswordChange(Request $request)
    {
        $validation = $this->validator->validateForcedChangePassword($request);
        if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json(['status' => 'verror', 'data' => $validation['message']]);
        }
        try {
            //code...
            if (!$this->passwordPolicyTest($request->newpassword)) {
                $error = 'Failed strong password policy! Password must contain atleast 2 Uppercase, 1 Lowercase, 1 digit and 2 special charaters.';
                return response()->json(['status' => 'error', 'url' => '', 'message' => $error]);
            }

            if ($request->confirmpassword != $request->newpassword) {
                //Current password and new password are same
                $error = 'New password and confirm password not matched';
                return response()->json(['status' => 'error', 'url' => '', 'message' => $error]);
            }
            $user = Auth::user();
            $user->password = Hash::make($request->newpassword);
            $user->is_password_change = 1;
            $user->save();

            $auditData = array('action_type' => 'Update', 'description' => 'User changed password after login', 'user_type' => 'MFT');
            $this->auditTrail($auditData);

            $url = urlencode('/users');
            return response()->json(['status' => 'success', 'message' => 'Password Changed successfuly!', 'url' => $url, 'redirect' => 'yes']);

        } catch (\Throwable $th) {
            $auditData = array('action_type' => 'ExError', 'description' => 'Error:' . $ex->getMessage(), 'user_type' => 'MFT');
            $this->auditTrail($auditData);
            return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
        }
    }

    public function uploadPanGstDocument(Request $request)
    {
        $validation = $this->validator->validatePanGstDocumentForm($request);
        if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json(['status' => 'verror', 'data' => $validation['message']]);
        }
        try {
            $dir_path_certificate = 'systems\\Attachment\\';
            Storage::disk('filestore')->makeDirectory($dir_path_certificate);
            $user = Auth::user();
            if ($request->hasFile('pan_document')) {
                $pan_document = $this->uploadFile($request->file('pan_document'), $dir_path_certificate, 'PAN_DCOUMENT' . Auth::id() . '_');
                $user->pan_document = $pan_document['name'];
            }

            if ($request->hasFile('gst_document')) {
                $gst_document = $this->uploadFile($request->file('gst_document'), $dir_path_certificate, 'GST_DOCUMENT');
                $user->gst_document = $gst_document['name'];
            }
            $user->save();
            $auditData = array('action_type' => 'Update', 'description' => 'User upload PAN and GST Documents', 'user_type' => 'MFT');
            $this->auditTrail($auditData);

            $url = urlencode('/users');
            return response()->json(['status' => 'success', 'message' => 'PAN and GST Documents uploaded successfuly!', 'url' => $url, 'redirect' => 'yes']);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            $auditData = array('action_type' => 'ExError', 'description' => 'Error:' . $ex->getMessage(), 'user_type' => 'MFT');
            $this->auditTrail($auditData);
            return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
        }
    }

    public function requestToChangeScheduleDate(Request $request)
    {
        $inspectHistory = RlmmInspectionHistory::findOrFail($request->id);
        $inspectHistory->proposed_date = $request->proposed_date;
        $inspectHistory->request_remark = $request->request_remark;
        $inspectHistory->change_request = 1;
        $inspectHistory->save();
        if ($inspectHistory->save()) {
            $auditData = array('action_type' => 'Update', 'description' => 'User Request to Reschedule Inspection Date', 'user_type' => 'MFFT');
            $this->auditTrail($auditData);
            $action = 'Manufacturer request to re-scheduled Inspection date. New Proposed Inspection date : ' . $request->proposed_date;
            $forwardDetail = array('user_type' => 'MFFT', 'application_id' => $request->application_id, 'action' => $action, 'description' => $request->request_remark, 'class' => 'text-warning');
            $this->forwardDetail($forwardDetail);
            //Please mail function add here

            //Notification to NIWE
            $notifyArray = array('id' => 1, 'to_user_type' => 'niwe', 'message' => $action);
            $this->userNotification($notifyArray);

            return response()->json(['success' => 'Request Submitted successfully']);
        } else {
            return response()->json(['error' => 'Error']);
        }

    }

    public function forwardto(Request $request, $application_id = NULL)
    {
        if ($request->isMethod('post')) {

            if ($request->id) {
                 $applicationdetail = AWApplicationDetail::findOrFail($request->id);
                // $applicationdetail->update();
                $applicationdetail->forward_status = $request->forward_status;
                try {
                    //code...
                    if ($request->forward_status == 'mnre') {
                    $action = 'Application (' . $applicationdetail->application_no . ') has been Forwarded by  NIWE to MNRE';
                          $forward_to='mnre';

                    $dprDocumentName = null;
                    $dir_path_certificate = 'systems/Attachment/';
                    Storage::disk('filestore')->makeDirectory($dir_path_certificate);

                    if ($request->hasFile('dpr_document')) {
                        $dprUpload = $this->uploadFile($request->file('dpr_document'), $dir_path_certificate, 'dpr_DOC_');
                        $dprDocumentName = $dprUpload['name'];
                    }

                    } elseif ($request->forward_status == 'return_niwe') {
                        $action = 'Application (' . $applicationdetail->application_no . ') has been returned by Niwe';
                           $forward_to='user';
                        $applicationdetail->final_submission = 0;
                        
                    } elseif ($request->forward_status == 'MFFT') {
                        $action = 'Notification for user';
                           $forward_to='user';
                    } else {
                        $action = '';
                    }
                     
                    $applicationdetail->status = 1;
                    $applicationdetail->update();

                    $forwardDetail = array('user_type' => 'niwe', 'application_id' => $request->id, 'action' => $action, 'description' => $request->description,'forward_to'=>$forward_to,'dpr_document'=>$dprDocumentName);
                    $this->forwardDetail($forwardDetail);

                     //Notification to Users
                     $notifyArray = array('id' => $applicationdetail->user_id, 'to_user_type' => 'mfft', 'message' => $action, 'application_id' => $request->id);
                     $this->userNotification($notifyArray);
                     //Notification to MNRE
                     $notifyArray = array('id' =>$applicationdetail->user_id, 'to_user_type' => 'mnre_wind_users', 'message' => $action, 'application_id' => $request->id);
                     $this->userNotification($notifyArray);

                    /*************************Audit Trail Start**********************************/
                    $auditData = array('action_type' => 'Insert', 'description' => $action, 'user_type' => 'MNRE');
                    $this->auditTrail($auditData);
                    /*************************Audit Trail Start**********************************/
                    return redirect('niwe/applications-list')->with('status', $action);
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with("error", "Server Error!");
                }
            }
        }
    }
         
    private function forwardDetail($dataArr)
    {
        // print_r($dataArr);die;
        $applicationdetail = new RlmmForwardDetail();
        $applicationdetail->user_id = Auth::user()->id;
        $applicationdetail->user_type = $dataArr['user_type'];
        $applicationdetail->application_id = $dataArr['application_id'];
        $applicationdetail->action = $dataArr['action'];
        $applicationdetail->description = $dataArr['description'];
        if(!empty($dataArr['forward_to']))
        $applicationdetail->forward_to = $dataArr['forward_to'];
        if (!empty($dataArr['dpr_document'])) {
        $applicationdetail->dpr_document = $dataArr['dpr_document'];
        }
        $applicationdetail->save();
    }


    public function ApplicationsListMoM(Request $request)
    {
            $i = 0;
        $applications = RlmmMomAppvdMnre::join('aw_application_details', 'mom_details.application_id', '=', 'aw_application_details.id')
        ->where('aw_application_details.final_submission', 1)
        ->orderBy('mom_details.id', 'DESC')
        ->get();

        // $momRecords = RlmmMomAppvdMnre::where('status', 'approved')->get();

      return view('backend.niwe.applications-list-mom',compact('applications'));
    }

    //Approved by Niwe For Mnre 
    public function approvemom(Request $request)
    {
     if ($request->isMethod('post')) {

           $validatedData = $request->validate([
                'mom_id' => 'required|exists:mom_details,id',
                'niwe_msg' => 'required|string|max:1000',
                'niwe_file' => [
                    'nullable',
                    'file',
                    'mimes:pdf',
                    'max:2048',
                    function ($attribute, $value, $fail) {
                        $extension = strtolower($value->getClientOriginalExtension());
                        $originalName = $value->getClientOriginalName();

                        // Check for double extension
                        if (preg_match('/\.(php|exe|js|sh)\./i', $originalName)) {
                            $fail('The '.$attribute.' contains invalid characters or double extension.');
                        }

                        // Optional: restrict to only one dot before extension
                        if (substr_count($originalName, '.') > 1) {
                            $fail('The '.$attribute.' must not contain multiple extensions.');
                        }
                    },
                ],
            ]);

            //  dd($request->all());
            $momId = $request->input('mom_id'); 
            $mom = RlmmMomAppvdMnre::where('id', $momId)->first();

            $fileName='';
            if ($request->hasFile('niwe_file')) {
                $file = $request->file('niwe_file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/approvals', $fileName);
            }

                  $mom->application_id=$momId;
                       $mom->niwe_msg=$request->niwe_msg;
                         $mom->niwe_file=$fileName;
                          $mom->save();
            
            return back()->with('success', 'Committee approval saved successfully.');
        }
    }

    public function requestDocsForm(Request $request)
    {
       if ($request->isMethod('post')) {
            //  dd($request->all());
            
            $validatedData = $request->validate([
            'mom_id' => 'required|exists:mom_details,id',
            'niwe_msg_request' => 'required|string|max:1000',
            'niwe_file_request' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:2048',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    $originalName = $value->getClientOriginalName();

                    //  Block suspicious double extensions like .php.pdf
                    if (preg_match('/\.(php|exe|js|sh)\./i', $originalName)) {
                        $fail('The '.$attribute.' contains invalid characters or double extension.');
                    }

                    //  Optional: prevent multiple dots in file name (for strict control)
                    if (substr_count($originalName, '.') > 1) {
                        $fail('The '.$attribute.' must not contain multiple extensions.');
                    }
                },
            ],
        ]);

            $momId = $request->input('mom_id'); 
            $mom = RlmmMomAppvdMnre::where('id', $momId)->first();

            $fileName='';
            if ($request->hasFile('niwe_file_request')) {
                $file = $request->file('niwe_file_request');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/approvals', $fileName);
            }

                  $mom->application_id=$momId;
                       $mom->niwe_msg_request=$request->niwe_msg_request;
                         $mom->niwe_file_request=$fileName;
                          $mom->save();
            
            return back()->with('success', 'Committee approval saved successfully.');
        }
    }

    public function fetchNotificationDetailsById()
    {
        echo "dashboard";
       // return Notification::getNotification();
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

    public function scheduledInspections()
    {
        try {
            //code...
            $applications = array();
            $i = 0;
            $inspectionHistory = AwApplicationDetail::getSchemduledInspectionListNiwe()->where('application_details.status', '2')->get();
            foreach ($inspectionHistory as $data) {
                $i++;
                $applications[$i] = $data;
                $inc_history = RlmmInspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
                $applications[$i]['inspectionData'] = $inc_history;
            }

            // dd($applications);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Application', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.niwe.scheduled-inspections', compact('applications'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    public function AjaxfetchDashboardCounts($year)
    {

        $dashboard = new Dashboard();
        if ($year == 'As on Date') {
            $data = $dashboard->getRLMMUSERDashboardData();
        } else {
            $dumbYear = explode('-', $year);
            $fromDate = $dumbYear[0] . '-04-01';
            $toDate = $dumbYear[1] . '-03-31';
            $data = $dashboard->getRLMMUSERDashboardDataByYear($fromDate, $toDate);
        }
        return response()->json(['success' => 'ok', 'data' => $data]);
    }

    public function submitHoldingReason(Request $request)
    {
        try {
            $currentUrl = $request->current_url;
            $holdingReason = new RlmmHoldingReason();
            $holdingReason->user_id = $request->user_id;
            $holdingReason->application_id = $request->application_id;
            $holdingReason->reason = $request->dealay_reason;
            $holdingReason->save();
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Insert', 'description' => 'NIWE user added a holding reason.', 'user_type' => 'NIWE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect($currentUrl)->with('status', 'Holding Reason saved successfully');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with("error", "Server Error");
        }
    }

    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        // echo "helo"; die;
        //  $filePath = 'systems/' . $folder . '/' . $file;
        $filePath = 'documents/systems/' . $folder . '/' . $file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    public function downloadDoc($consumerId, $folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/' . base64_decode($consumerId) . '/' . base64_decode($folder);
        $filePath = empty($maintenanceRegistryCode) ? $filePath . '/' . $file : $filePath . '/' . $maintenanceRegistryCode . '/' . $file;
        return Storage::disk('filestore')->download($filePath);
    }


    // Not Working 
    public function previewApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;
        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed application detail ', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        $returnHTML = view('backend.user.form.preview-applications', compact('annexureData', 'application_id'))->render();
        return response()->json(['status' => 'success', 'result' => $returnHTML]);

        // $aryData=array('annexureData'=>$annexureData,'application_id'=>$application_id);
        // $pdf = PDF::loadView('backend.user.form.pdf-applications', $aryData);
        // $pdf->setPaper('A4','landscape');
        // return $pdf->download('application'.date('YmdHis').'.pdf');


        return view('backend.user.form.view-applications', compact('annexureData', 'application_id'));
    }

    
}