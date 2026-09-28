<?php

namespace App\Http\Controllers\Backend\Nise;

use App\Models\HoldingReason;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
// use App\Models\Annexure1;
// use App\Models\Annexure2;
// use App\Models\Annexure3;
// use App\Models\Annexure4;
// use App\Models\Annexure5;
// use App\Models\Annexure6;
// use App\Models\BillMaterial;
use App\Models\ForwardDetail;
use App\Models\ApplicationDetail;
// use App\Models\AppliedPvmodel;
// use App\Models\State;
use App\Models\Mnre;
// use App\Models\Program;
use App\Traits\General;
use App\Models\Module;
use App\Models\MainMasterModule;
use App\Models\Annexure1;
use App\Models\Annexure3;
// use App\Models\Consumer;
// use App\Models\District;
// use App\Models\Inspector;
// use App\Models\Installer;
// use App\Models\SubDistrict;
// use App\Models\Installation;
// use App\Models\StateImplementingAgencyUser;
// use App\Models\MaintenanceRequest;
// use App\Models\LocalbodyUser;
// use App\Models\MaintenanceRegistry;
// use App\Models\InstallationReviewLog;
// use App\Models\InstallationCapacity;
use App\Models\AuditTrail;
use App\Models\Notification;
use App\Models\InspectionHistory;
// use App\Imports\InspectorImport;
// use App\Imports\InstallerImport;
// use App\Imports\LocalbodyImport;
// use App\Imports\StateImplementingAgencyImport;
// use App\Utils\Dictionary;
use App\Utils\NewApplicationFormValidator;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;


use DB, URL, Session, Auth, Hash, Storage, PDF, Validator, Config;


class MainController extends Controller
{
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        $this->validator = new NewApplicationFormValidator();
        //dd(Auth::user());
    }

    public function fetchNotificationDetailsById()
    {
        return Notification::getNotification();
    }

    public function index(Request $request)
    {
        try {
            $dashboard = new Dashboard(); //App-utils-Dashboard
            $data = $dashboard->getNISEDashboardData();
            $auditData = array('action_type' => '1', 'description' => 'NISE viewed Dashboard', 'user_type' => '1');
            $this->auditTrail($auditData);

            return view('backend.nise.dashboard', compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    public function mnreUsers(Request $request)
    {
        try {
            //code...
            $users = Mnre::where('admin', 0)->where('admin', 0)->get(); //data fatch kiya
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'User viewed MNRE User List', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.mnre.mnreUserList', compact('users'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
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

    public function editMnreUser(Request $request, $id)
    {
        try {
            //code...
            $user = Mnre::where('id', base64_decode($id))->first()->toArray();
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed update profile page ', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.mnre.createMnreUser', compact('user'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
    }


    public function manufacturerUsers(Request $request)
    {
        try {
            //code...
            $users = User::orderBy('id', 'DESC')->paginate(50);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User visited Manufacturer Users', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.mnre.manufacturerUserList', compact('users'));
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
                $inspectionHistory = ApplicationDetail::where('status', '1')->where('forward_status', 'nise')->orderBy('id', 'DESC')->get();
            } else if ($stat == 'scheduled') {
                $inspectionHistory = ApplicationDetail::where('status', '2')->orderBy('id', 'DESC')->get();
            } else if ($stat == 'approvedAtNISE') {
                $inspectionHistory = ApplicationDetail::where('status', '5')->orderBy('id', 'DESC')->get();
            } else {
                $inspectionHistory = ApplicationDetail::where('forward_status', 'nise')->orderBy('id', 'DESC')->get();
            }
            foreach ($inspectionHistory as $data) {
                $i++;
                $applications[$i] = $data;
                $inc_history = InspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
                $applications[$i]['inspectionData'] = $inc_history;

                $holding = HoldingReason::where('application_id', $applications[$i]->id)->count();
                $applications[$i]['holdingData'] = $holding;
            }
            // dd($applications);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Application', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.nise.applications-list', compact('applications'));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    public function trackDetail(Request $request, $application_id)
    {
        try {
            //code...
            $application_id = $this->decodeid($application_id);
            $applications = ApplicationDetail::select('created_at')->where('id', $application_id)->first();
            $trackDetail = ForwardDetail::where('application_id', $application_id)->orderBy('id', 'DESC')->paginate(50);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Track Detail', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.common.track-detail', compact('trackDetail', 'applications'));
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th->getMessage());
            return redirect()->back()->with("error", "Server Error!");
        }
    }


    public function forwardto(Request $request, $application_id = NULL)
    {
        if ($request->isMethod('post')) {

            if ($request->id) {
                $applicationdetail = ApplicationDetail::findOrFail($request->id);
                // $applicationdetail->update();
                $applicationdetail->forward_status = $request->forward_status;
                try {

                    if ($request->forward_status == 'mnre') {
                    $action = 'Application has been Forwarded by  NISE to MNRE';
                          $forward_to='mnre';

                    // $dprDocumentName = null;
                    // $dir_path_certificate = 'systems/Attachment/';
                    // Storage::disk('filestore')->makeDirectory($dir_path_certificate);

                    // if ($request->hasFile('dpr_document')) {
                    //     $dprUpload = $this->uploadFile($request->file('dpr_document'), $dir_path_certificate, 'dpr_DOC_');
                    //     $dprDocumentName = $dprUpload['name'];
                    // }

                    } elseif ($request->forward_status == 'return_nise') {
                        $action = 'Application (' . $applicationdetail->application_no . ') has been returned by NISE';
                           $forward_to='user';
                        $applicationdetail->final_submission = 0;
                        
                    } elseif ($request->forward_status == 'user') {
                        $action = 'Notification for user';
                         $forward_to='user';
                    } else {
                        $action = '';
                    }

                    $applicationdetail->status = 1;
                    $applicationdetail->update();

                    $forwardDetail = array('user_type' => 'nise', 'application_id' => $request->id, 'action' => $action, 'description' => $request->description,
                    'forward_to'=>$forward_to,
                    // 'dpr_document'=>$dprDocumentName
                );
                    $this->forwardDetail($forwardDetail);
                    //code...
                    // if ($request->forward_status == 'mnre') {
                    //     $action = 'Application has been Forwarded to MNRE by NISE';
                    // } elseif ($request->forward_status == 'reject') {

                    //     $action = 'Application has been returned by NISE';
                    // } elseif ($request->forward_status == 'user') {

                    //     $action = 'Notification for user';
                    // } else {
                    //     $action = '';
                    // }
                    // $forwardDetail = array('user_type' => 'nise', 'application_id' => $request->id, 'action' => $action, 'description' => $request->description);
                    // $this->forwardDetail($forwardDetail);
                    /*************************Audit Trail Start**********************************/
                    $auditData = array('action_type' => 'Insert', 'description' => $action, 'user_type' => 'MNRE');
                    $this->auditTrail($auditData);
                    /*************************Audit Trail Start**********************************/
                    return redirect('nise/applications-list')->with('status', $action);
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with("error", "Server Error!");
                }
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
        $applicationdetail->forward_to = $dataArr['forward_to'];
        // if (!empty($dataArr['dpr_document'])) {
        // $applicationdetail->dpr_document = $dataArr['dpr_document'];
        // }
        $applicationdetail->save();
    }


    public function rejectRequest(Request $request)
    {
        $inspectHistory = InspectionHistory::findOrFail($request->id);
        $inspectHistory->status = 2;
        $inspectHistory->save();
        if ($inspectHistory->save()) {
            $auditData = array('action_type' => 'Update', 'description' => 'NISE Return to Re-Schedule Inspection Date', 'user_type' => 'NISE');
            $this->auditTrail($auditData);
            $action = 'NISE Return to Re-Schedule Inspection Date';
            //Please mail function add here

            //Notification to User
            $notifyArray = array('id' => $inspectHistory->user_id, 'to_user_type' => 'users', 'message' => $action);
            $this->userNotification($notifyArray);
            return response()->json(['success' => 'Returned successfully']);
        } else {
            return response()->json(['error' => 'Error']);
        }
    }

    public function completeInspection(Request $request)
    {
        $validation = $this->validator->validateInspectionReportForm($request);
        if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
        {
            return response()->json(['status' => 'verror', 'data' => $validation['message']]);
        }
        try {
            $dir_path_payment = 'systems\\Annexure\\';
            Storage::disk('filestore')->makeDirectory($dir_path_payment);
            $applicationdetail = ApplicationDetail::findOrFail($request->application_id);

            if ($request->hasFile('inspection_report')) {
                $inspection_report = $this->uploadFile($request->file('inspection_report'), $dir_path_payment, 'INSPECTION_REPORT_' . $request->application_id . '_' . date('ymd'));
                $applicationdetail->inspection_report = $inspection_report['name'];
            }
            $applicationdetail->inspection_remarks = $request->inspection_remarks;
            $applicationdetail->status = 5; //Inspection Completed
            $applicationdetail->update();

            $action = 'NISE completed Inspection on ' . date('Y-m-d');
            $forwardDetail = array('user_type' => 'nise', 'application_id' => $request->application_id, 'action' => $action, 'description' => $request->inspection_remarks);
            $this->forwardDetail($forwardDetail); //Defined in Trait/General.php

            //Notification to NISE
            $notifyArray = array('id' => $request->user_id, 'to_user_type' => 'users', 'message' => $action);
            $this->userNotification($notifyArray);

            $auditData = array('action_type' => 'Upload', 'description' => 'NISE Uploaded Inspection Report', 'user_type' => 'NISE');
            $this->auditTrail($auditData);
            $url = urlencode('/nise/applications-list');
            return response()->json(['status' => 'success', 'message' => 'Inspection Report upload successfuly', 'url' => $url]);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getCode() . '||' . $th->getMessage());
            return response()->json(['status' => 'ExError', 'message' => $th->getCode() . '||' . $th->getMessage()]);
        }
    }

    public function scheduleInspection(Request $request)
    {
        try {
            //code...
            //dd($request);

            $this->validate($request, [
                'inspection_date' => 'required|after:now',
            ]);
            $inspectHistory = new InspectionHistory();
            $inspectHistory->user_id = $request->user_id;
            $inspectHistory->application_id = $request->application_id;
            $inspectHistory->inspection_date = $request->inspection_date;
            $inspectHistory->proposed_date = $request->proposedDate;
            $inspectHistory->remark = $request->description;
            $inspectHistory->entry_date = $this->getCurrentDate();
            $inspectHistory->save();

            //Updating status
            $applicationdetail = ApplicationDetail::findOrFail($request->application_id);
            $applicationdetail->status = 2;
            $applicationdetail->update();

            $action = 'NISE scheduled Inspection date to ' . $request->inspection_date;
            $forwardDetail = array('user_type' => 'nise', 'application_id' => $request->application_id, 'action' => $action, 'description' => $request->description);
            $this->forwardDetail($forwardDetail); //Defined in Trait/General.php

            //Notification to NISE
            $notifyArray = array('id' => $request->user_id, 'to_user_type' => 'users', 'message' => $action);
            $this->userNotification($notifyArray);

            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Update', 'description' => $action, 'user_type' => 'NISE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect('nise/applications-list?stat=' . base64_encode('scheduled'))->with('status', $action);
        } catch (\Throwable $th) {
            //throw $th;

            dd($th->getMessage());
        }
    }

    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'documents/systems/' . $folder . '/' . $file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    public function viewApplication(Request $request, $id)
    {
        try {
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
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed ' . $annexureData['applicationDetail']['application_no'] . ' application detail', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.nise.view-applications', compact('annexureData', 'application_id', 'annexuredata1','annexuredata', 'moduleData','appData','appData3','bis_test_report','applicationData'));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with("error", "Server Error!");
        }
    }
    
    public function scheduledInspections()
    {
        try {
            //code...
            $applications = array();
            $i = 0;
            $inspectionHistory = ApplicationDetail::getSchemduledInspectionListNise()->where('application_details.status', '2')->get();
            foreach ($inspectionHistory as $data) {
                $i++;
                $applications[$i] = $data;
                $inc_history = InspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
                $applications[$i]['inspectionData'] = $inc_history;
            }

            // dd($applications);
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'View', 'description' => 'MNRE User viewed Application', 'user_type' => 'MNRE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return view('backend.nise.scheduled-inspections', compact('applications'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            //code...
            $manufacturer_user = User::findOrFail($request->id);
            $password = $this->generateRandomString(10);
            $password_hash = Hash::make($password);
            $manufacturer_user->password = $password_hash;
            $manufacturer_user->update();
            if ($manufacturer_user->update()) {
                //Please mail function add here
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => 'Password has been changed by MNRE User', 'user_type' => 'MNRE');
                $this->auditTrail($auditData);
                return response()->json(['success' => 'Password has been changed successfully']);
            } else {
                return response()->json(['success' => 'Password has been changed successfully']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with("error", "Server Error!");
            dd($th->getMessage());
        }
    }
    //Vivek

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
            // dd("HI");
            if ($request->isMethod('get')) {
                $submitUrl = URL::to('/nise/change-password');
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'View', 'description' => 'NISE User view Change Password Option', 'user_type' => 'NISE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
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
                $auditData = array('action_type' => 'Update', 'description' => ' NISE User  Match Password ', 'user_type' => 'NISE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                // The passwords matches
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }

            if (!$this->passwordPolicyTest($request->new_password)) {
                $error = 'Failed strong password policy!';
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => 'NISE User Test password Policy  ', 'user_type' => 'NISE');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/

                return redirect()->back()->with("error", $error);
            }

            if (strcmp($request->current_password, $request->new_password) == 0) {
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type' => 'Update', 'description' => ' NISE User verify condition currunt and new password not same  ', 'user_type' => 'NISE');
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
            $auditData = array('action_type' => 'Update', 'description' => ' NISE User Inserted new password  ', 'user_type' => 'NISE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("status", "Password changed successfully !");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Server Error !");
        }
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
        $pdf = PDF::loadView('backend.nise.master.pdf-applications', $aryData);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('application' . date('YmdHis') . '.pdf');

        return view('backend.nise.master.pdf-applications', compact('annexureData', 'application_id','annexuredata', 'moduleData', 'appData', 'appData3','annexuredata1','bis_test_report','applicationData'));
    }


    public function submitHoldingReason(Request $request)
    {
        try {
            $currentUrl = $request->current_url;
            $holdingReason = new HoldingReason();
            $holdingReason->user_id = $request->user_id;
            $holdingReason->application_id = $request->application_id;
            $holdingReason->reason = $request->dealay_reason;
            $holdingReason->save();
            /*************************Audit Trail Start**********************************/
            $auditData = array('action_type' => 'Insert', 'description' => 'NISE user added a holding reason.', 'user_type' => 'NISE');
            $this->auditTrail($auditData);
            /*************************Audit Trail Start**********************************/
            return redirect($currentUrl)->with('status', 'Holding Reason saved successfully');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with("error", "Server Error");
        }
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
