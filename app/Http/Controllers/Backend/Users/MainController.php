<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\MachineList;
use App\Models\ApplicationDetail;
use App\Models\AppliedPvmodel;
use App\Models\Annexure1;
use App\Models\Annexure3;
use App\Models\InspectionHistory;
use App\Models\Module;
use App\Models\BillMaterial;
use App\Models\AnnexureAttachment;
use App\Models\ForwardDetail;
use App\Models\ModuleType;
use App\Models\MainMasterModule;
use App\Models\ApplicationPaymentDetails;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\NewApplicationFormValidator;
use App\Utils\ApplicationProgress;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Traits\General;

use DB, URL, Auth, Hash, Storage, Config, Gate, Exception, Session, PDF, Validator;

class MainController extends Controller
{
    use General;

    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        $this->ProgressBar = new ApplicationProgress(); //Utils
        $this->validator = new NewApplicationFormValidator();
        // $this->middleware('onlyOneUser');
    }
    public function index()
    {

        $dashboard = new Dashboard();
        $data = $dashboard->getUSERDashboardData();
        $currentYear = date('Y');
        return view('backend.user.dashboard', compact('data', 'currentYear'));
    }

    public function userApplication()
    {

        $stat = request()->query('stat');
        $stat = base64_decode($stat);
        $auditData = array('action_type' => 'View', 'description' => 'Viewed Application List Page', 'user_type' => 'MFT');
        $this->auditTrail($auditData);

        $applications = array();
        $i = 0;
        // submitted
        if ($stat == 'submitted') {
            $inspectionHistory = ApplicationDetail::getUserApplications(Auth::user()->id)->where('application_details.final_submission', 1)->orderBy('application_details.id', 'DESC')->get();
        }
        else if($stat == 'approvedAtNISE') {
            $inspectionHistory = ApplicationDetail::where('status','5')->where('user_id',Auth::user()->id)->orderBy('application_details.id', 'DESC')->get();
        }
        else if($stat == 'pendingReviewNISE') {
            $inspectionHistory = ApplicationDetail::where('status','1')->where('forward_status','nise')->where('user_id',Auth::user()->id)->orderBy('application_details.id', 'DESC')->get();
        }
        else if($stat == 'scheduledInspections') {
            $inspectionHistory = ApplicationDetail::where('status','2')->where('user_id',Auth::user()->id)->orderBy('application_details.id', 'DESC')->get();
        }
        else if($stat == 'underReviewMNRE') {
            $inspectionHistory = ApplicationDetail::where('user_id',Auth::user()->id)->where('status','0')->where('final_submission',1)->where('forward_status','mnre')->orderBy('application_details.id', 'DESC')->get();
        } else {
            $inspectionHistory = ApplicationDetail::getUserApplications(Auth::user()->id)->orderBy('application_details.id', 'DESC')->get();
        }
        foreach ($inspectionHistory as $data) {
            $i++;
            $applications[$i] = $data;
            $inc_history = InspectionHistory::where('application_id', $applications[$i]->id)->limit(1)->orderBy('id', 'DESC')->get()->toArray();
            $applications[$i]['inspectionData'] = $inc_history;
        }
        return view('backend.user.userApplications', compact('applications'));
    }
    public function newApplication(Request $request, $id = NULL)
    {
        if ($request->isMethod('post')) {

            $validation = $this->validator->validateNewApplicationStepOne($request);
            if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status' => 'verror', 'data' => $validation['message']]);
            }
            try {
                //dd($request);
                $edit_id = $this->decodeid($request->edit_id);
                if ($edit_id) {
                    $applicationDetails = ApplicationDetail::findOrFail($edit_id);
                } else {
                    $applicationDetails = new ApplicationDetail();
                }
                $is_comm_add_same = 0;
                if (isset($request->is_comm_add_same)) {
                    $is_comm_add_same = 1;
                }

            //    $applicationDetails->application_type = 1;
                $applicationDetails->user_id = Auth::user()->id;
                $applicationDetails->manufacturer_name = $request->manufacturer_name;
                // $applicationDetails->manufacturer_brand_name = $request->manufacturer_brand_name;
                // Developed By Yogesh
                $applicationDetails->application_type = $request->application_type;
                if($applicationDetails->application_type==5){
                    $applicationDetails->other_application_type = $request->other_application_type;

                }else{
                    $applicationDetails->other_application_type = NULL;

                }
                $applicationDetails->additional_information = $request->additional_information;

                 //
                $applicationDetails->register_office_address = $request->register_office_address;
                $applicationDetails->register_office_phone = $request->register_office_phone;
                $applicationDetails->register_office_email = $request->register_office_email;
                // $applicationDetails->is_comm_add_same = $is_comm_add_same;
                // if ($is_comm_add_same == 1) {
                //     $applicationDetails->com_address = $request->register_office_address;
                //     $applicationDetails->com_phone = $request->register_office_phone;
                //     $applicationDetails->com_email = $request->register_office_email;
                // } else {
                //     $applicationDetails->com_address = $request->com_address;
                //     $applicationDetails->com_phone = $request->com_phone;
                //     $applicationDetails->com_email = $request->com_email;
                // }
                $applicationDetails->com_address = $request->register_office_address;
                $applicationDetails->com_phone = $request->register_office_phone;
                $applicationDetails->com_email = $request->register_office_email;
                $applicationDetails->com_address = $request->com_address;
                $applicationDetails->com_phone = $request->com_phone;
                $applicationDetails->com_email = $request->com_email;
                $applicationDetails->plant_address = $request->plant_address;
                $applicationDetails->plant_phone = $request->plant_phone;
                $applicationDetails->plant_email = $request->plant_email;
                $applicationDetails->plant_latitude = $request->plant_latitude;
                $applicationDetails->plant_longitude = $request->plant_longitude;
                // $applicationDetails->address_type = $request->address_type;
                $applicationDetails->gps_latitude = $request->gps_latitude;
                $applicationDetails->gps_longitude = $request->gps_longitude;
                $applicationDetails->country = $request->country;
                $applicationDetails->com_country = $request->com_country;
                $applicationDetails->reg_country = $request->reg_country;
                $applicationDetails->is_sez = isset($request->is_sez) ? $request->is_sez : 0;
           //     $applicationDetails->is_applied = isset($request->is_applied) ? $request->is_applied : 0;
                $applicationDetails->gst_number = $request->gst_number;
                $applicationDetails->existing_plant_india = $request->existing_plant_india;
                $applicationDetails->existing_plant_outindia = $request->existing_plant_outindia;
                // $applicationDetails->contact_person_name = $request->contact_person_name;
                // $applicationDetails->person_designation = $request->person_designation;
                $applicationDetails->person_contact_no = $request->person_contact_no;
                $applicationDetails->person_email = $request->person_email;
                $applicationDetails->authorize_name = $request->authorize_name;
                $applicationDetails->authorize_designation = $request->authorize_designation;
              //  $applicationDetails->manufacturing_capacity = $request->manufacturing_capacity;
                $applicationDetails->manufacturing_capacity = 1;

                $applicationDetails->step1 = 1;
                $applicationDetails->created_at = $this->getCurrentDate();
                $applicationDetails->updated_at = $this->getCurrentDate();

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if ($request->hasFile('authorize_letter')) {
                    $authorize_letter = $this->uploadFile($request->file('authorize_letter'), $dir_path_certificate, 'AUTHORIZE_LETTER');
                    $applicationDetails->authorize_letter = $authorize_letter['name'];
                }

                if ($request->hasFile('gst_document')) {
                    $gst_document = $this->uploadFile($request->file('gst_document'), $dir_path_certificate, 'GST_LETTER');
                    $applicationDetails->gst_document = $gst_document['name'];
                }

                $dir_path_logo = 'systems\\Logo\\';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                if ($request->hasFile('manufacturer_brand_logo')) {
                    $manufacturer_brand_logo = $this->uploadFile($request->file('manufacturer_brand_logo'), $dir_path_logo, 'LOGO');
                    $applicationDetails->manufacturer_brand_logo = $manufacturer_brand_logo['name'];
                } else {
                    $applicationDetails->manufacturer_brand_logo = $request->old_manufacturer_brand_logo;
                }

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if ($request->hasFile('certificate_incorporation')) {
                    $certificate_incorporation = $this->uploadFile($request->file('certificate_incorporation'), $dir_path_certificate, 'CERTIFICATE_INCORPORATION');
                    $applicationDetails->attc_incorporation_cerificate = $certificate_incorporation['name'];
                }

                //dd($applicationDetails);
                if (!empty($edit_id)) {
                    $applicationDetails->update();
                    $url = urlencode('/users/new-application/' . $request->edit_id);
                    return response()->json(['status' => 'success', 'message' => 'Application saved successfully.', 'url' => $url, 'redirect' => 'yes']);
                }

                $applicationDetails->save();
                $id = $applicationDetails->id;
                $url = urlencode('/users/new-application/' . $this->encodeid($applicationDetails->id));
                if ($id) {
                    $auditData = array('action_type' => 'Update', 'description' => 'Updated New Application Form', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success', 'message' => 'Application updated successfully.', 'url' => $url, 'redirect' => 'yes']);
                } else {

                    $auditData = array('action_type' => 'Error', 'description' => 'Error in Updating Details', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error', 'message' => 'Error in Updating Details!']);
                }

            } catch (\Exception $ex) {

                $auditData = array('action_type' => 'ExError', 'description' => 'Error:' . $ex->getMessage(), 'user_type' => 'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);

            }
        }
        if ($id) {
            $id = $this->decodeid($id);
        }
        $appData = array();
        if (isset($id)) {
            $appData = ApplicationDetail::where('id', $id)->where('user_id', Auth::user()->id)->first();
            //$this->checkFinalSubmission($id,$appData->final_submission);
            if (!$appData) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Request']);
                dd('Invalid Request');
            }
        }
        //$progressBar = $this->ProgressBar->getApplicationProgress($id);
        $countries = Country::all();
        $auditData = array('action_type' => 'View', 'description' => 'Viewed New Application Form Page', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.newApplication', compact('appData', 'countries'));

    }

    public function newApplicationStep2(Request $request, $id = NULL)
    {
        if ($request->isMethod('post')) {
            $validation = $this->validator->validateNewApplicationStepTwo($request);
            if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status' => 'verror', 'data' => $validation['message']]);
            }

            try {
                $edit_id = $this->decodeid($request->edit_id);
                $deleteFlg = AppliedPvmodel::where('application_id', $edit_id)->where('user_id', Auth::user()->id)->delete();
                $applicationDetails = ApplicationDetail::findOrFail($edit_id);
                //Deleting payment details if changes in form, after user add payment details
                ApplicationPaymentDetails::where('application_id', $edit_id)->delete();

                //$applicationDetails->manufacturing_capacity = $request->manufacturing_capacity;
                $applicationDetails->manufacturing_capacity = "1";
                $applicationDetails->enlisted_almm = $request->enlisted_almm;
                //$applicationDetails->applied_pv_model           = count($request->pmax);
                $applicationDetails->step2 = 1;
                $applicationDetails->created_at = $this->getCurrentDate();
                $applicationDetails->updated_at = $this->getCurrentDate();
                //Insert Data in AppliedPvmodels Table
                $allPvDetails = [];
                $i = 0;

                // foreach($request->pmax as $item){ // $interests array contains input data

                //     $allDetails = new AppliedPvmodel();
                //     $allDetails->application_id = $edit_id;
                //     $allDetails->user_id = Auth::user()->id;
                //     $allDetails->technology = $request->technology[$i];
                //     $allDetails->no_pv_models = $request->no_pv_models[$i];
                //     $allDetails->pmax = $request->pmax[$i];
                //     $allDetails->created_at = $this->getCurrentDate();
                //     $allDetails->updated_at= $this->getCurrentDate();
                //     $allPvDetails[] = $allDetails->attributesToArray();

                //     $i++;
                // }


                // AppliedPvmodel::insert($allPvDetails);
                if (!empty($edit_id)) {

                    $auditData = array('action_type' => 'Update', 'description' => 'Application saved successfully.', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);

                    $applicationDetails->update();
                    $url = urlencode('/users/new-application-step2/' . $this->encodeid($edit_id));
                    return response()->json(['status' => 'success', 'message' => 'Application saved successfully.', 'url' => $url, 'redirect' => 'yes']);

                }

            } catch (\Exception $ex) {

                $auditData = array('action_type' => 'ExError', 'description' => 'Error:' . $ex->getMessage(), 'user_type' => 'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
            }
        }
        $appData = $pvdata = array();
        $id = $this->decodeid($id);
        if (isset($id)) {
            $appData = ApplicationDetail::where('id', $id)->where('user_id', Auth::user()->id)->first();
            $pvdata = AppliedPvmodel::where('application_id', $id)->where('user_id', Auth::user()->id)->get();
            if (!$appData) {
                return response()->json(['status' => 'error', 'message' => 'Invalid Request !']);

            }
        }

        $auditData = array('action_type' => 'View', 'description' => 'Viewed Application Form', 'user_type' => 'MFT');
        $this->auditTrail($auditData);

        $progressBar = $this->ProgressBar->getApplicationProgress($id);
        return view('backend.user.form.newApplicationStep2', compact('appData', 'pvdata', 'progressBar'));
    }
    
    public function userApplicationFee(Request $request, $id = NULL)
    {
        if ($request->isMethod('post')) {
            $validation = $this->validator->validateApplicationPayment($request);
            if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status' => 'verror', 'data' => $validation['message']]);
            }
            try {

                $application_id = $this->decodeid($request->application_id);
                ApplicationPaymentDetails::where('application_id', $application_id)->delete();
                $amountDetails = explode('||', base64_decode($request->payment_id));

                $paymentdetails = new ApplicationPaymentDetails();
                $paymentdetails->application_id = $application_id;
                $paymentdetails->user_id = Auth::user()->id;
                $paymentdetails->payment_mode = $request->payment_mode;
                $paymentdetails->transaction_number = $request->transaction_number;
                $paymentdetails->amt_paid = $request->amt_paid;
                // $paymentdetails->whether_acknowledge = $request->whether_acknowledge;
                $paymentdetails->transaction_date = $request->transaction_date;
                $paymentdetails->bank_name = $request->bank_name;
                // $paymentdetails->fee_value = $amountDetails[0];
                // $paymentdetails->application_amount_paid = $amountDetails[1];
                // $paymentdetails->inspection_amount = $amountDetails[2];
                // $paymentdetails->applied_gst = $amountDetails[3];
                $paymentdetails->entry_date = $this->getCurrentDate();

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if ($request->hasFile('transaction_receipt')) {
                    $transaction_receipt = $this->uploadFile($request->file('transaction_receipt'), $dir_path_certificate, 'TRANSACTION_' . $application_id);
                    $paymentdetails->transaction_receipt = $transaction_receipt['name'];
                }
                $paymentdetails->save();
                // dd($paymentdetails);
                $id = $paymentdetails->id;
                $url = urlencode('/users/application-fees/' . $this->encodeid($application_id));
                if ($id) {

                    $auditData = array('action_type' => 'Update', 'description' => 'User Saved Transaction Details', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success', 'message' => 'Transaction details saved successfully.', 'url' => $url, 'redirect' => 'yes']);
                } else {

                    $auditData = array('action_type' => 'Error', 'description' => 'Error in Updating Transaction Details', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error', 'message' => 'Error in Updating Transaction Details!']);
                }
            } catch (\Exception $ex) {
                //throw $th;
                // dd($ex->getMessage());
                return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
            }

        }

        $auditData = array('action_type' => 'View', 'description' => 'Viewed Application Fee Page', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        $id = $this->decodeid($id);
        $progressBar = $this->ProgressBar->getApplicationProgress($id);
        $applicationData = ApplicationDetail::getApplicationDataWithFee($id);

        $appData = Annexure1::getApplicationFee($id, Auth::user()->id);
        // dd($appData);
        return view('backend.user.form.applicationFee', compact('progressBar', 'applicationData', 'appData'));
    }

    // Inspection Fee by Raushan 
    public function userApplicationInspFee(Request $request, $id = NULL)
    {
        //dd($request->all());
        if ($request->isMethod('post')) {
            $validation = $this->validator->validateInspectionPayment($request);
            if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status' => 'verror', 'data' => $validation['message']]);
            }
            try {

                $application_id = $this->decodeid($request->application_id);
                $car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);

                $paymentdetailsinsp = new ApplicationPaymentDetails();

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if ($request->hasFile('insp_transaction_receipt')) {
                    $insp_transaction_receipt = $this->uploadFile($request->file('insp_transaction_receipt'), $dir_path_certificate, 'TRANSACTIONS_' . $application_id);
                    $paymentdetailsinsp->insp_transaction_receipt = $insp_transaction_receipt['name'];
                    
                }
                $record=array(
                    "pymt_mode_insp"=>$request->pymt_mode_insp,
                    "insp_transaction_no" => $request->insp_transaction_no,
                    "insp_amt_paid" => $request->insp_amt_paid,
                    // "insp_whether_acknowledge" =>  $request->insp_whether_acknowledge,
                    "insp_transaction_date" =>  $request->insp_transaction_date,
                    "insp_transaction_receipt" =>  $insp_transaction_receipt,
                    "insp_bank_name" =>  $request->insp_bank_name,
                );
                $eid=$request->eid;
                $id=ApplicationPaymentDetails::where('id',$eid)->update($record);
                //$id = $paymentdetailsinsp->eid;
                $url = urlencode('/users/application-fees/' . $this->encodeid($application_id));
                // dd( $url);
                if ($id) {
                    $auditData = array('action_type' => 'Update', 'description' => 'User Saved Transaction Details', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    // return response()->json(['status' => 'success', 'message' => 'Transaction details saved successfully.', 'url' => $url, 'redirect' => 'yes']);
                    return redirect()->back()->with('success', 'Transaction details saved successfully');
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Transaction Details saved successfully!',
                        'url' => $url,
                        'redirect' => 'yes'
                    ]);
                    
                } else {

                    $auditData = array('action_type' => 'Error', 'description' => 'Error in Updating Transaction Details', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error', 'message' => 'Error in Updating Transaction Details!']);
                }
            } catch (\Exception $ex) {
                //throw $th;
                //dd($ex->getMessage());
                // return redirect()->back()->with("status", " successfully !");
                return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
            }
        }

        $auditData = array('action_type' => 'View', 'description' => 'Viewed Application Fee Page', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        $id = $this->decodeid($id);
        $progressBar = $this->ProgressBar->getApplicationProgress($id);
        // $applicationData = ApplicationDetail::getApplicationDataWithFee($id);
        // $inspectionData = ApplicationPaymentDetails::getInspectionPayment($id);
        $inspectionData = ApplicationDetail::getApplicationDataWithInspectionFee($id);

// dd($inspectionData);
        // $paymentDetails = ApplicationPaymentDetails::where('application_id', $id)->first();

        // dd($applicationData);
        $appData = Annexure1::getApplicationFee($id, Auth::user()->id);
        // dd($appData);
        return view('backend.user.form.applicationFee', compact('progressBar', 'inspectionData', 'appData'));
    }

    public function downloadApplication($application_id, $type = NULL)
    {
        //dd($application_id.'--'.$type);
        $application_id = $this->decodeid($application_id);
        $application_data = ApplicationDetail::where('id', $application_id)->where('user_id', Auth::user()->id)->first();
        $applied_pvmodels = AppliedPvmodel::where('application_id', $application_id)->where('user_id', Auth::user()->id)->get();
        $paymentdata = ApplicationPaymentDetails::where('application_id', $application_id)->where('user_id', Auth::user()->id)->first();
        $moduleData = Module::getModuleDataById($application_id);
        $data = array(
            'application_data' => $application_data,
            'applied_pvmodels' => $applied_pvmodels,
            'payment_data' => $paymentdata,
            'moduleData' => $moduleData
        );
        $pdf = PDF::loadView('backend/user/form/pdf_newApplication', $data);
        if ($type == 'emailFile') {
            try {
                //code...
                $fileName = 'Application_' . time() . '.pdf';
                //$path = '\\storage\\documents\\acknowledgments\\';
                $path = 'storage/documents/acknowledgments/';
                $pdf->save($path . $fileName);
                return $fileName;
                //dd('hi');
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }

            //return $pdf->download('Application_'.date("ymdhis").'.pdf');
        } else {
            return $pdf->download('Application_' . date("ymdhis") . '.pdf');
        }

    }
    // Vivek
    public function viewApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;
       
        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        $annexuredata = ApplicationDetail::where('id', $application_id)->where('user_id', Auth::user()->id)->first();
        $moduleData = MainMasterModule::getModuleDataById($id);
        $appData = Annexure1::getAllAnnexureData($application_id,Auth::user()->id);
        $appData3 = Annexure3::getAllAnnexureData($application_id,Auth::user()->id);
        $bis_test_report=ApplicationDetail::select('bis_test_report')->where('id',$application_id)->first();
        $applicationData = ApplicationDetail::getApplicationDataWithFee($id);
        $inspectionData = ApplicationDetail::getApplicationDataWithInspectionFee($id);


        // dd($applicationData);
       
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed application detail ', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.user.form.view-applications', compact('annexureData', 'application_id','annexuredata1','annexuredata','moduleData','appData','bis_test_report','appData3','applicationData','inspectionData'));
    }

    public function downloadPdfApplication(Request $request, $id)
    {
        $id = $this->decodeid($id);
        $application_id = $id;
        $annexureData = ApplicationDetail::getAnnexureByApplicationID($id);
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
        $annexuredata = ApplicationDetail::where('id', $application_id)->where('user_id', Auth::user()->id)->first();
        $moduleData = MainMasterModule::getModuleDataById($id);
        $appData = Annexure1::getAllAnnexureData($application_id,Auth::user()->id);
        $appData3 = Annexure3::getAllAnnexureData($application_id,Auth::user()->id);
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type' => 'View', 'description' => 'User viewed application detail ', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/

        $aryData = array('annexureData' => $annexureData, 'annexuredata' => $annexuredata, 'moduleData' => $moduleData, 'appData' => $appData, 'appData3' => $appData3, 'annexuredata1' => $annexuredata1, 'application_id' => $application_id);
        $pdf = PDF::loadView('backend.user.form.pdf-applications', $aryData);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('application' . date('YmdHis') . '.pdf');

        return view('backend.user.form.pdf-applications', compact('annexureData', 'application_id','annexuredata', 'moduleData', 'appData', 'appData3','annexuredata1'));
    }
    
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


    public function applicationSubmission(Request $request, $application_id = NULL)
    {
        if ($request->isMethod('post')) {
           
            $validation = $this->validator->validateFinalSubmission($request);
            if ($validation['status'] == 'error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status' => 'verror', 'data' => $validation['message']]);
            }
            try {
                $affidavit = $request->input('affidavit'); 
                $indemnity = $request->input('indemnity'); 

                $finalSubmission = ApplicationDetail::findOrFail($this->decodeid($request->edit_id));
                $application_no = 'ALMM/' . $finalSubmission->application_type . '/' . $this->decodeid($request->edit_id) . '/' . date("Y");
                $finalSubmission->declaration = $request->declaration;
                $finalSubmission->previous_id = 0;
                // $finalSubmission->final_submission = 1;
                // $finalSubmission->forward_status = 'mnre';
                if ($finalSubmission->forward_status === 'return_nise') {
                    $finalSubmission->final_submission = 1; // Save as draft
                    $finalSubmission->forward_status = 'nise'; // Send to NIWE
                } else {
                    $finalSubmission->final_submission = 1; // Final submit
                    $finalSubmission->forward_status = 'mnre'; // Send to MNRE
                }
                $finalSubmission->application_no = $application_no;

                $finalSubmission->affidavit = $affidavit;
                $finalSubmission->indemnity = $indemnity;
                $finalSubmission->created_at = $this->getCurrentDate();
                $finalSubmission->updated_at = $this->getCurrentDate();

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if ($request->hasFile('signatory_document')) {
                    $signatory_document = $this->uploadFile($request->file('signatory_document'), $dir_path_certificate, 'SIGNED_DOC_' );
                    $finalSubmission->signatory_document = $signatory_document['name'];
                }

                $dir_path_certificate = 'systems\\Attachment\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if ($request->hasFile('indemnity_document')) {
                    $indemnity_document = $this->uploadFile($request->file('indemnity_document'), $dir_path_certificate, 'SIGNED_DOC1_' );
                    $finalSubmission->indemnity_document = $indemnity_document['name'];
                }
                    // dd($finalSubmission);
                $finalSubmission->save();
                $id = $finalSubmission->id;

                // $this->emailSmsNotifications->notifyUserApplicationSubmission($data,$application_no,Auth::user()->id); //Sending Email to User
                // $this->emailSmsNotifications->notifyMNREApplicationSubmission($data,$application_no); //Sending Email to MNRE

                $notifyArray = array('id' => 1, 'to_user_type' => 'mnre', 'message' => 'User submitted Application');
                $this->userNotification($notifyArray);

                $url = urlencode('/users/user-applications/');
                if ($id) {
                    $auditData = array('action_type' => 'Update', 'description' => 'Application Final Submitted successfuly', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success', 'message' => 'Application Final Submitted successfuly!', 'url' => $url, 'redirect' => 'yes']);
                } else {
                    $auditData = array('action_type' => 'Error', 'description' => 'Error in Updating Details', 'user_type' => 'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error', 'message' => 'Error in Updating Details!']);
                }

            } catch (Exception $ex) {

                $auditData = array('action_type' => 'ExError', 'description' => 'Error:' . $ex->getMessage(), 'user_type' => 'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
            }

        }
        $application_id = $this->decodeid($application_id);
        $progressBar = $this->ProgressBar->getApplicationProgress($application_id);
        $annexuredata1 = Module::getExistingModuleDataById($application_id);
           // dd($annexuredata1);
        $auditData = array('action_type' => 'View', 'description' => 'View Annexure final submission', 'user_type' => 'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.finalSubmission', compact('progressBar','annexuredata1','application_id'));
    }

    public function trackDetail(Request $request, $application_id)
    {
        $application_id = $this->decodeid($application_id);
        $applications = ApplicationDetail::select('created_at', 'application_no')->where('id', $application_id)->first();
        $trackDetail = ForwardDetail::where('application_id', $application_id)->orderBy('id', 'DESC')->get();
        // dd($trackDetail);
        return view('backend.common.track-detail', compact('trackDetail', 'applications'));
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
            $submitUrl = URL::to('/users/change-password');
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
        $inspectHistory = InspectionHistory::findOrFail($request->id);
        $inspectHistory->proposed_date = $request->proposed_date;
        $inspectHistory->request_remark = $request->request_remark;
        $inspectHistory->change_request = 1;
        $inspectHistory->save();
        if ($inspectHistory->save()) {
            $auditData = array('action_type' => 'Update', 'description' => 'User Request to Reschedule Inspection Date', 'user_type' => 'MFT');
            $this->auditTrail($auditData);
            $action = 'Manufacturer request to re-scheduled Inspection date. New Proposed Inspection date : ' . $request->proposed_date;
            $forwardDetail = array('user_type' => 'user', 'application_id' => $request->application_id, 'action' => $action, 'description' => $request->request_remark, 'class' => 'text-warning');
            $this->forwardDetail($forwardDetail);
            //Please mail function add here

            //Notification to NISE
            $notifyArray = array('id' => 1, 'to_user_type' => 'nise', 'message' => $action);
            $this->userNotification($notifyArray);

            return response()->json(['success' => 'Request Submitted successfully']);
        } else {
            return response()->json(['error' => 'Error']);
        }

    }
    public function fetchNotificationDetailsById()
    {
        return Notification::getNotification();
    }
    public function AjaxfetchDashboardCounts($year)
    {

        $dashboard = new Dashboard();
        if ($year == 'As on Date') {
            $data = $dashboard->getUSERDashboardData();
        } else {
            $dumbYear = explode('-', $year);
            $fromDate = $dumbYear[0] . '-04-01';
            $toDate = $dumbYear[1] . '-03-31';
            $data = $dashboard->getUSERDashboardDataByYear($fromDate, $toDate);
        }
        return response()->json(['success' => 'ok', 'data' => $data]);
    }
    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/' . $folder . '/' . $file;
        //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }
    public function downloadDoc($consumerId, $folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/' . base64_decode($consumerId) . '/' . base64_decode($folder);
        $filePath = empty($maintenanceRegistryCode) ? $filePath . '/' . $file : $filePath . '/' . $maintenanceRegistryCode . '/' . $file;
        return Storage::disk('filestore')->download($filePath);
    }
}