<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Traits\General;
use App\Models\ApplicationDetail;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
use App\Models\Annexure4;
use App\Models\Annexure5;
use App\Models\Annexure6;
use App\Models\ModuleType;
use App\Models\Module;
use App\Models\BillMaterial;
use App\Models\Country;
use App\Models\MachineList;
use App\Utils\NewApplicationFormValidator;
use App\Http\Controllers\Controller;
use App\Utils\ApplicationProgress;
use Illuminate\Support\Facades\Crypt;
use App\Utils\EmailSmsNotifications;

use DB, URL, Auth, Hash, Storage, Config, Gate,Exception, Session, PDF,Validator;

class AnnexureController extends Controller
{
    use General;

    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        $this->ProgressBar = new ApplicationProgress();
        $this->validator = new NewApplicationFormValidator();       
        
    }
    public function annexure1(Request $request, $application_id='',$edit_id='',$type=NULL){
        
        if($request->isMethod('post')){
            
            //Validation
            $validation = $this->validator->validateAnnexureOneOfOne($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            // try{
                $request->edit_id = $this->decodeid($request->edit_id);
                  
                if($request->edit_id){
                    $deletOldAnnexure = Annexure1::where('module_type',$request->edit_id) ->where('application_id',$this->decodeid($request->application_id))
                    ->where('sub_annexure',1)->where('user_id',Auth::user()->id)->delete();
                }

                $dataArray=array();
                for($i=0;$i<=count($request->no_of_cells)-1;$i++){
                    $dataArray[]=array(
                        'application_id' => $this->decodeid($request->application_id),
                        'user_id'        => Auth::user()->id,
                        'module_type'    => $request->edit_id,
                        'sub_annexure'   => 1, //Annexure 3.1
                        'no_of_cells'    => $request->no_of_cells[$i],
                        // 'system_voltage' => $request->system_voltage[$i],
                        'cell_type'       => $request->cell_type[$i],
                        'created_at'     => $this->getCurrentDate(),
                        'updated_at'     => $this->getCurrentDate()

                    );
                    
                }
                // dd($dataArray);
                $id=Annexure1::insert($dataArray);
              
                $url = urlencode('/users/annexure-one/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure 1 Details Updated successfully!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    // return response()->json(['status' => 'success','message'=>'Annexure 1 Details saved successfully!', 'url'=>$url]);
                    return redirect('/users/annexure-one/'.$request->application_id)->with('status', 'Details Updated successfully!');
                   
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }

            // }catch(\Exception $ex) {
                
            //     $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
            //     $this->auditTrail($auditData);
            //     return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            // }
        }

        $appData=$annexuredata=$moduleList=array();
        //Decoding ID
       
        $application_id=$this->decodeid($application_id);
        // dd($application_id);
        $progressBar=array(0,false);
        if(isset($application_id)){
            //Parameters : Application ID,User ID, Sub Annexure Type, 
            $appData = Annexure1::getAnnexureData($application_id,Auth::user()->id,1);
            // dd( $appData);
            if(!$appData){
                return abort(404);
            }
            if(isset($edit_id)){
                $edit_id=$this->decodeid($edit_id);
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 1', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //1=Sub Annexure
                $annexuredata = Annexure1::getAnnexureDataByID($application_id,Auth::user()->id,$edit_id,1);
               
                
            }
        }
        //  dd($annexuredata);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $module_one_data_sheet=ApplicationDetail::select('module_one_data_sheet')->where('id',$application_id)->first();
        // dd("okay");
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 1 Form Page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureOne.annexure1',compact('appData','application_id','annexuredata','progressBar','module_one_data_sheet'));
    } 
    
    public function annexureOneAttachment(Request $request,$application_id=NULL){
        
        if($request->isMethod('post')){
            
            $request->validate(
                [
                    'module_one_data_sheet'       =>  'required|file|mimes:pdf|max:2048',
                ],
                [
                    'module_one_data_sheet.mimes' => "Please upload PDF file only",
                    'module_one_data_sheet.max' => "Maximum file size to upload is 2MB ."
                ]);
           
            try {
                $request->application_id=$this->decodeid($request->application_id);
                $dir_path_logo = 'systems\\Attachment\\';
                $module_one_data_sheet_file='';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                $annexureAttachmentData = ApplicationDetail::findOrFail($request->application_id);
                if($request->hasFile('module_one_data_sheet')){
               
                    $module_one_data_sheet=$this->uploadFile($request->file('module_one_data_sheet'), $dir_path_logo,'MODULE_DATA_SHEET'.$request->application_id);
                    $annexureAttachmentData->module_one_data_sheet = $module_one_data_sheet['name'];
                }
                $annexureAttachmentData->save();
                $auditData = array('action_type'=>'Upload','description'=>'User Uploaded Module Data Sheet', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-one/'.$this->encodeid($request->application_id))->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                dd($th->getCode().'||'.$th->getMessage());
                return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            }
        }
    }

    public function annexure1_1(Request $request, $application_id=NULL,$edit_id=NULL,$type=NULL){
        
        if($request->isMethod('post')){

            $validation = $this->validator->validateAnnexureOneOfTwo($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try{
                //Decoding Id
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $deletOldAnnexure = Annexure1::where('module_type',$request->edit_id)->where('application_id',$this->decodeid($request->application_id))
                    ->where('sub_annexure',2)->where('electrical_data_type',$request->electrical_data_type)->where('user_id',Auth::user()->id)->delete();
                }
                $dataArray=array();
                
                for($i=0;$i<=count($request->pmax_watt)-1;$i++){
                    $dataArray[]=array(
                        'application_id' => $this->decodeid($request->application_id),
                        'user_id'        => Auth::user()->id,
                        'module_type'    => $request->edit_id,
                        'sub_annexure'   => 2, //Annexure 3.2
                        'electrical_data_type'   => $request->electrical_data_type, //STC/NOCT
                        'power_output'      => $request->power_output[$i],
                        'pmax'              => $request->pmax[$i],
                        'pmax_watt'         => $request->pmax_watt[$i],
                        'vmp'               => $request->vmp[$i],
                        'imp'               => $request->imp[$i],
                        'voc'               => $request->voc[$i],
                        'isc'               => $request->isc[$i],
                        'model_efficiency'  => $request->model_efficiency[$i],
                        'fill_factor'       => $request->fill_factor[$i],
                        'created_at'        => $this->getCurrentDate(),
                        'updated_at'        => $this->getCurrentDate()

                    );
                }
                $id=Annexure1::insert($dataArray);

                $url = urlencode('/users/annexure-one-b/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }

            }catch(\Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }
        }
        // echo $application_id;die();
        $appData=$annexuredata=array();
        $application_id=$this->decodeid($application_id);
        if(isset($application_id)){
           //Parameters : Application ID,User ID, Sub Annexure Type, Electrical Data Type (1=STC,2=NOCT)
           $appData['appDataSTC'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,2,1); 
           $appData['appDataNOCT'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,2,2); 
        //    dd($appData['appDataSTC']);//STC Data
        // dd($appData['appDataNOCT']);//STC Data
        //    $appData['appDataNOCTtype']=2;//NOCT Data
           if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }
            if(isset($edit_id)){
                $edit_id=$this->decodeid($edit_id);
                //Parameter :2=Sub Annexure, ($type : 1 =STC Data,2 = NOCT)
                $annexuredata = Annexure1::getAnnexureDataByID($application_id,Auth::user()->id,$edit_id,2,$type);
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 1 of 1', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
            
            }
        }

        // dd( $annexuredata);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 1 of 1 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        $module_data_sheet=ApplicationDetail::select('module_data_sheet')->where('id',$application_id)->first();
        return view('backend.user.form.annexureOne.annexure1_2',compact('appData','application_id','annexuredata','progressBar','module_data_sheet'));
    }
    public function annexureOnebAttachment(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            
            $request->validate(
                [
                    'module_data_sheet'       =>  'required|file|mimes:pdf|max:2048',
                ],
                [
                    'module_data_sheet.mimes' => "Please upload PDF file only",
                    'module_data_sheet.max' => "Maximum file size to upload is 2MB ."
                ]);
           
            try {
                $request->application_id=$this->decodeid($request->application_id);
                $dir_path_logo = 'systems\\Attachment\\';
                $module_data_sheet_file='';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                $annexureAttachmentData = ApplicationDetail::findOrFail($request->application_id);
                if($request->hasFile('module_data_sheet')){
               
                    $module_data_sheet=$this->uploadFile($request->file('module_data_sheet'), $dir_path_logo,'MODULE_DATA_SHEET'.$request->application_id);
                    $annexureAttachmentData->module_data_sheet = $module_data_sheet['name'];
                }
                $annexureAttachmentData->save();
                $auditData = array('action_type'=>'Upload','description'=>'User Uploaded Module Data Sheet', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-one-b/'.$this->encodeid($request->application_id))->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                dd($th->getCode().'||'.$th->getMessage());
                return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            }
            

        }
        
    }
    public function annexure1_3(Request $request, $application_id=NULL,$edit_id=NULL,$type=NULL){
        if($request->isMethod('post')){
            $sub_annexure_type = $request->sub_annexure_type;
            $validation = $this->validator->validateAnnexureOneOfThree($request, $sub_annexure_type);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $deletOldAnnexure = Annexure1::where('module_type',$request->edit_id)->where('application_id',$this->decodeid($request->application_id))
                    ->where('sub_annexure',$sub_annexure_type)->where('user_id',Auth::user()->id)->delete();
                }
                $dataArray=array();
                if($sub_annexure_type==3){
                    for($i=0;$i<=count($request->operation_temp)-1;$i++){
                            $dataArray[]=array(
                                'application_id' => $this->decodeid($request->application_id),
                                'user_id'        => Auth::user()->id,
                                'module_type'    => $request->edit_id,
                                'sub_annexure'   => 3, //Annexure 3.4 :Module Operational Ratings
                                'operation_temp' => $request->operation_temp[$i],
                                'max_voltage'    => $request->max_voltage[$i],
                                'max_fuse_rating'=> $request->max_fuse_rating[$i],
                                'diode_rating'   => $request->diode_rating[$i],
                                'fire_rating'    => $request->fire_rating[$i],
                                // 'warrenty_details'  => $request->warrenty_details[$i],
                                'created_at'        => $this->getCurrentDate(),
                                'updated_at'        => $this->getCurrentDate()

                        );
                    }
                }
                if($sub_annexure_type==4){
                    for($i=0;$i<=count($request->pmax_watt)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 4, //Annexure 3.5 :Module Temperature Characteristics
                            'pmax_watt'      => $request->pmax_watt[$i],
                            'voc'            => $request->voc[$i],
                            'isc'            => $request->isc[$i],
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate()

                        );
                    }
                }
                if($sub_annexure_type==5){
                    for($i=0;$i<=count($request->module_length)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 5, //Annexure 3.6 :Module Dimensions
                            'module_dimensions' => $request->module_dimensions[$i],
                            'module_length'  => $request->module_length[$i],
                            'module_breadth' => $request->module_breadth[$i],
                            'module_area'    => $request->module_area[$i],
                            'module_weight'  => $request->module_weight[$i],
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate()

                        );
                    }
                }
                if($sub_annexure_type==6){
                    for($i=0;$i<=count($request->module_length)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 6, //Annexure 3.7 :Module Dimensions
                            // 'cell_technology'  => $request->cell_technology[$i],
                            'cell_efficiency' => $request->cell_efficiency[$i],
                            'cell_wattage'    => $request->cell_wattage[$i],
                            'cell_dimension'  => $request->cell_dimension[$i],
                            // 'cell_type'  => $request->cell_type[$i],
                            'cell_total_no'  => $request->cell_total_no[$i],
                            'cell_total_bus'  => $request->cell_total_bus[$i],
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate()

                        );
                    }
                }
               
                if($sub_annexure_type==7){
                    for($i=0;$i<=count($request->module_length)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 7, 
                            'front_cover'    => $request->front_cover[$i],
                            'sub_supplier'   => $request->sub_supplier[$i],
                            'back_cover'     => $request->back_cover[$i],
                            'frame'          => $request->frame[$i],
                            'adhesive'       => $request->adhesive[$i],
                            'encapsulate'    => $request->encapsulate[$i],
                            'junction_box'   => $request->junction_box[$i],
                            'connector'      => $request->connector[$i],
                            'cable'          => $request->cable[$i],
                            'bypass_diode'   => $request->bypass_diode[$i],
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate() 
                            
                        );
                    }
                }


                $id=Annexure1::insert($dataArray);

                $url = urlencode('/users/annexure-one-c/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
                
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=array();
        if(isset($application_id)){
            //Parameters : Application ID,User ID, Sub Annexure Type, 
            $appData['AnnexureSub3'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,3); //Module Operational Ratings
            $appData['AnnexureSub4'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,4);
            $appData['AnnexureSub5'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,5);
            $appData['AnnexureSub6'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,6);
            $appData['AnnexureSub7'] = Annexure1::getAnnexureData($application_id,Auth::user()->id,7);
            // dd($appData);
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                //$annexuredata = Annexure1::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                //$type : 3 =Module Operational Ratings,4=Module Temperature Characteristics
                $annexuredata = Annexure1::getAnnexureDataByID($application_id,Auth::user()->id,$edit_id,$type);
                // dd( $annexuredata);
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 1 of 3 form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                // dd( $annexuredata);
            }
        }
        $cell_data_sheet=ApplicationDetail::select('cell_data_sheet')->where('id',$application_id)->first();
        $bom_data_sheet=ApplicationDetail::select('bom_data_sheet')->where('id',$application_id)->first();
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 1 of 3 form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        
        return view('backend.user.form.annexureOne.annexure1_3',compact('appData','application_id','annexuredata','progressBar','cell_data_sheet','bom_data_sheet'));
    }

    // BoM Attachment data sheet by Raushan 
    public function bomdatasheet(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            
            $request->validate(
                [
                    'bom_data_sheet'       =>  'required|file|mimes:pdf|max:2048',
                ],
                [
                    'bom_data_sheet.mimes' => "Please upload PDF file only",
                    'bom_data_sheet.max' => "Maximum file size to upload is 2MB ."
                ]);
           
            try {
                $request->application_id=$this->decodeid($request->application_id);
                $dir_path_logo = 'systems\\Attachment\\';
                $bom_data_sheet_file='';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                $bomDataFile = ApplicationDetail::findOrFail($request->application_id);
                if($request->hasFile('bom_data_sheet')){
               
                    $bom_data_sheet=$this->uploadFile($request->file('bom_data_sheet'), $dir_path_logo,'BOM_DATA_SHEET'.$request->application_id);
                    $bomDataFile->bom_data_sheet = $bom_data_sheet['name'];
                }
                $bomDataFile->save();
                $auditData = array('action_type'=>'Upload','description'=>'User Uploaded BoM Data Sheet', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-one-c/'.$this->encodeid($request->application_id))->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                dd($th->getCode().'||'.$th->getMessage());
                return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            }
            

        }
        
    }


    public function annexureOnecAttachment(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            
            $request->validate(
                [
                    'cell_data_sheet'       =>  'required|file|mimes:pdf|max:2048',
                ],
                [
                    'cell_data_sheet.mimes' => "Please upload PDF file only",
                    'cell_data_sheet.max' => "Maximum file size to upload is 2MB ."
                ]);
           
            try {
                $request->application_id=$this->decodeid($request->application_id);
                $dir_path_logo = 'systems\\Attachment\\';
                $cell_data_sheet_file='';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                $cellDataFile = ApplicationDetail::findOrFail($request->application_id);
                if($request->hasFile('cell_data_sheet')){
               
                    $cell_data_sheet=$this->uploadFile($request->file('cell_data_sheet'), $dir_path_logo,'CELL_DATA_SHEET'.$request->application_id);
                    $cellDataFile->cell_data_sheet = $cell_data_sheet['name'];
                }
                $cellDataFile->save();
                $auditData = array('action_type'=>'Upload','description'=>'User Uploaded Module Data Sheet', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-one-c/'.$this->encodeid($request->application_id))->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                dd($th->getCode().'||'.$th->getMessage());
                return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            }
            

        }
        
    }
    public function annexureTwo(Request $request, $application_id=NULL,$edit_id=NULL){
       
        if($request->isMethod('post')){
            // dd($request);
            $validation = $this->validator->validateAnnexureTwo($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $oldData = Annexure2::select('bom_attachment')->where('application_id',$this->decodeid($request->application_id))
                    ->where('user_id',Auth::user()->id)->get()->toArray();
                    foreach($oldData as $d_file){
                        Storage::disk('filestore')->delete('systems/BOM/'.$d_file['bom_attachment']);
                    }
                    $deletOldAnnexure = Annexure2::where('application_id',$this->decodeid($request->application_id))
                    ->where('user_id',Auth::user()->id)->delete();
                }

                $dataArray=array();
                $file = $request->file('bom_attachment');
                $dir_path_certificate = 'systems\\BOM\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                //dd($file);
                $attachment='';
                if($request->hasFile('bom_attachment')){
                    $bom_attachment=$this->uploadFile($request->file('bom_attachment'), $dir_path_certificate,'BOM_'.Auth::id().'_'.$request->edit_id.'_'.$this->decodeid($request->application_id));
                    $attachment = $bom_attachment['name'];
                }
                for($i=0;$i<=count($request->module_type)-1;$i++){
                    
                    $dataArray[]=array(
                        'application_id' => $this->decodeid($request->application_id),
                        'user_id'        => Auth::user()->id,
                        'module_type'    => $request->module_type[$i],
                        'bom_attachment' => $attachment,
                        'created_at'     => $this->getCurrentDate(),
                        'updated_at'     => $this->getCurrentDate()
                    );
                }
                $id=Annexure2::insert($dataArray);
                $url = urlencode('/users/annexure-two/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'no']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }
        }
       
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=array();$aryData=array();
        if(isset($application_id)){
            //$appData = Annexure2::getAnnexureTwoData($application_id,Auth::user()->id); 
            //Parameters : Application ID,User ID
            $appData = Annexure2::getAnnexureData($application_id,Auth::user()->id); 
            //dd($appData);
            if(!$appData){
                return response()->json(['status' => 'error','message'=>'Server error ! Error: ','url'=>'']);
            }            
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure2::getAnnexureDataByID($application_id,Auth::user()->id,$edit_id);
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
            }
        }
        $countSubModule=Module::getSubModuleCount($application_id);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 2 form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureTwo.annexureTwo',compact('application_id','aryData','annexuredata','appData','progressBar','countSubModule'));

    }
    public function annexureThree(Request $request, $application_id=NULL,$edit_id=NULL,$type=NULL){
        
        if($request->isMethod('post')){
            $subAnnexureType = $request->subAnnexureType;
            $validation = $this->validator->validateAnnexureThree($request,$subAnnexureType);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }

            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    //Deleting Old Files
                    $oldData = Annexure3::select('doc_certificate')->where('application_id',$this->decodeid($request->application_id))
                    ->where('module_type',$request->edit_id)->where('user_id',Auth::user()->id)->where('sub_annexure',$subAnnexureType)->get()->toArray();
                    foreach($oldData as $d_file){
                        Storage::disk('filestore')->delete('systems/Annexure/'.$d_file['doc_certificate']);
                    }
                    $deletOldAnnexure = Annexure3::where('module_type',$request->edit_id)->where('application_id',$this->decodeid($request->application_id))
                    ->where('sub_annexure',$subAnnexureType)->where('user_id',Auth::user()->id)->delete();
                }

                // $dataArray=array();
                if($subAnnexureType==1){
                    $doc_certificate='';
                    $dir_path_payment = 'systems\\Annexure\\';
                    Storage::disk('filestore')->makeDirectory($dir_path_payment);
                    if($request->hasFile('bis_certificate')){
                        $bis_certificate=$this->uploadFile($request->file('bis_certificate'), $dir_path_payment,'ANNEXURE3_BISCRT_'.Auth::user()->id.'_'.$request->edit_id);
                        $doc_certificate = $bis_certificate['name'];
                    }
                    for($i=0;$i<=count($request->bis_certificate_no)-1;$i++){
                            $dataArray[]=array(
                                'application_id' => $this->decodeid($request->application_id),
                                'user_id'        => Auth::user()->id,
                                'module_type'    => $request->edit_id,
                                'sub_annexure'   => 1, //Annexure 4.1 :BIS Certification Details
                                'bis_certificate_no'      => $request->bis_certificate_no[$i],
                                'bis_certificate_issue'   => $request->bis_certificate_issue[$i],
                                'bis_certificate_valid'   => $request->bis_certificate_valid[$i],
                                'doc_certificate'   => $doc_certificate,
                                'created_at'        => $this->getCurrentDate(),
                                'updated_at'        => $this->getCurrentDate()
    
                        );
                    }
  
                }
                
                //$dataArray=array();
                if($subAnnexureType==2){
                    // $doc_certificate='';
                    // $dir_path_payment = 'systems\\Annexure\\';
                    // Storage::disk('filestore')->makeDirectory($dir_path_payment);
                    // if($request->hasFile('nabl_certificate')){
                    //     $nabl_certificate=$this->uploadFile($request->file('nabl_certificate'), $dir_path_payment,'ANNEXURE3_NAVLCRT_'.Auth::user()->id.'_'.$request->edit_id);
                    //     $doc_certificate = $nabl_certificate['name'];
                    // }
                    
                    for($i=0;$i<=count($request->orgn_contact_name)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 2, //Annexure 4.2 :Module Test Reports Details

                            'orgn_contact_name'             => $request->orgn_contact_name[$i],
                            'orgn_contact_address'          => $request->orgn_contact_address[$i],
                            'orgn_contact_phone'            => $request->orgn_contact_phone[$i],
                            'orgn_contact_email'            => $request->orgn_contact_email[$i],
                             
                            // 'test_standard_module'      => $request->test_standard_module[$i],
                            // 'test_report_no'            => $request->test_report_no[$i],
                            // 'testing_laboratory'        => $request->testing_laboratory[$i],
                            // 'testing_laboratory_address'        => $request->testing_laboratory_address[$i],
                            // 'valid_nabl_certificate_no'        => $request->valid_nabl_certificate_no[$i],
                            // 'doc_certificate'   => $doc_certificate,
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate()
    
                        );
                    }
                }
                //$dataArray=array();
                if($subAnnexureType==3){
                    for($i=0;$i<=count($request->lab_contact_name)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 3, 

                            'lab_contact_name'             => $request->lab_contact_name[$i],
                            'lab_contact_address'          => $request->lab_contact_address[$i],
                            'lab_contact_phone'            => $request->lab_contact_phone[$i],
                            'lab_contact_email'            => $request->lab_contact_email[$i],
                             
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate()
    
                        );
                    }
                }
                //$dataArray=array();
                if($subAnnexureType==8){
                    for($i=0;$i<=count($request->accred_contact_name)-1;$i++){
                        $dataArray[]=array(
                            'application_id' => $this->decodeid($request->application_id),
                            'user_id'        => Auth::user()->id,
                            'module_type'    => $request->edit_id,
                            'sub_annexure'   => 8, 

                            'accred_contact_name'             => $request->accred_contact_name[$i],
                            'accred_contact_address'          => $request->accred_contact_address[$i],
                            'accred_contact_phone'            => $request->accred_contact_phone[$i],
                            'accred_contact_email'            => $request->accred_contact_email[$i],
                            'created_at'     => $this->getCurrentDate(),
                            'updated_at'     => $this->getCurrentDate()
    
                        );
                    }

                }
                //$dataArray=array();
                if($subAnnexureType==9){
                    $doc_accred_certificate='';
                    $dir_path_payment = 'systems\\Annexure\\';
                    Storage::disk('filestore')->makeDirectory($dir_path_payment);
                    if($request->hasFile('accred_certificate')){
                        $accred_certificate=$this->uploadFile($request->file('accred_certificate'), $dir_path_payment,'ANNEXURE3_BISCRT_'.Auth::user()->id.'_'.$request->edit_id);
                        $doc_accred_certificate = $accred_certificate['name'];
                    }
                    for($i=0;$i<=count($request->accred_valid_upto)-1;$i++){
                            $dataArray[]=array(
                                'application_id' => $this->decodeid($request->application_id),
                                'user_id'        => Auth::user()->id,
                                'module_type'    => $request->edit_id,
                                'sub_annexure'   => 9, //Annexure 4.1 :BIS Certification Details

                                'accred_valid_upto' => $request->accred_valid_upto[$i],
                                'accred_certificate_no'=> $request->accred_certificate_no[$i],
                                'doc_accred_certificate'   => $doc_accred_certificate,
                                'created_at'        => $this->getCurrentDate(),
                                'updated_at'        => $this->getCurrentDate()
                                
                        );
                    }
                }


                // dd($dataArray);
                $id=Annexure3::insert($dataArray);
                $url = urlencode('/users/annexure-three/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'no']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
                
            }

        }
        
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=array();
        // dd($application_id);
        if(isset($application_id)){
            //1:Sub Annexure 1, 2:Sub Annexure 2
            $appData['bis'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,1); 
            $appData['nabl'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,2); 
            $appData['lab'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,3);
            $appData['accred'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,8);
            $appData['accred_attach'] = Annexure3::getAnnexureData($application_id,Auth::user()->id,9);
            //  dd($appData['accred_attach']);
            // dd($appData['bis']);
            // dd($appData['accred']);
            if($appData['bis']==null && $appData['nabl']==null && $appData['lab']==null && $appData['accred']==null  ){
                return redirect()->back()->with("error","Invalid Request !");
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
               $annexuredata = Annexure3::getAnnexureDataByID($application_id,Auth::user()->id,$edit_id,$type);
            //    dd($annexuredata);
               $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 3 details', 'user_type'=>'MFT');
               $this->auditTrail($auditData);
            }
        }
        // dd($annexuredata);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure 3', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureThree.annexureThree',compact('application_id','annexuredata','appData','progressBar'));
    }
    public function annexureFour(Request $request, $application_id=NULL, $edit_id=NULL){
        // dd($application_id);
        if($request->isMethod('post')){
            $request->validate(
            [
                'plant_floor_area'          =>  'required',
                'plant_operational_date'    =>  'required',
                'no_manufaturing_line'      =>  'required',
                'no_working_day'            =>  'required',
                'manufacturing_capacity'    =>  'required',
                'electricity_load'          =>  'required',
                'electricity_consumption'   =>  'required',
                'power_backup_details'      =>  'required',
                'manufacturing_capacity'    =>  'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/',

            ],
            [
                'module_type.required'=>'Please select module',
                'pmax_applicable_model.*'=>'Please enter Pmax (Wp) of Applicable Models Model',
                'no_of_cells.*'=>'Please enter No of Cells & Cell Type',
                'system_voltage.*'=>'Please enter System Voltage (VDC)',
                'no_manufaturing_line.required'=>'The no manufacturing line field is required.',
            ]
            );
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                //dd($request->edit_id);
                if($request->edit_id){
                    
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->where('sub_annexure',1)->delete();
                }
                $annexure4 = new Annexure4();
                $annexure4->application_id = $this->decodeid($request->application_id);
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 1;
                $annexure4->plant_floor_area = $request->plant_floor_area;
                $annexure4->plant_operational_date = $request->plant_operational_date;
                $annexure4->no_manufaturing_line = $request->no_manufaturing_line;
                $annexure4->no_working_day = $request->no_working_day;
                $annexure4->manufacturing_capacity = $request->manufacturing_capacity;
                $annexure4->electricity_load = $request->electricity_load;
                $annexure4->electricity_consumption = $request->electricity_consumption;
                $annexure4->power_backup_details = $request->power_backup_details;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
                $annexure4->save();
                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                dd($ex->getMessage());
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }

        $application_id=$this->decodeid($application_id);
        
        $appData=$annexuredata=$annexuredata6=array();
        // dd($appData);
        if(isset($application_id)){
            
            $annexuredata = Annexure4::where('application_id',$application_id)->where('sub_annexure',1)->where('user_id',Auth::user()->id)->first();
            $appData = Annexure6::where('application_id',$application_id)->where('user_id',Auth::user()->id)->get();
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata6 = Annexure6::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure  6', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //dd($annexuredata6);
            }
            if(!$annexuredata){
                $annexuredata=array();
            }
            $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 Form', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
        }
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $countrydata = Country::select('countrycd','name')->get();
        $manufactureCapacity=ApplicationDetail::select('manufacturing_capacity')->where('id',$application_id)->first()['manufacturing_capacity'];
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour1',compact('application_id','annexuredata','annexuredata6','appData','countrydata','progressBar','manufactureCapacity'));
    }
    public function annexureFourTwo(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $request->validate(
            [
                'line'                  =>  'required',
                'compatible_technology' =>  'required|string|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:70',
                'commissioning_date'    =>  'required',
                'rated_mfg_capacity'    =>  'required',
                'major_equipments.*'    =>  'required',
                'equipments_type.*'     =>  'required',
                'no_of_units.*'         =>  'required',
                'make.*'                =>  'required',
                'model.*'               =>  'required',
                'rating.*'              =>  'required',
                'country_of_origin.*'   =>  'required',

            ],
            [
                'line.required'=>'Please select line',
                'compatible_technology.required'=>'Please enter Compatible Technology',
                'commissioning_date.required'=>'Please select Commissioning Date',
                'rated_mfg_capacity.required'=>'Please enter Rated Manufacturing Capacity',
                'major_equipments.*'=>'Please select Major Machines/Equipments',
                'equipments_type.*'=>'Please select Machine Type',
                'no_of_units.*'=>'Please mention No. of Units',
                'make.*'=>'Please mention Making details',
                'model.*'=>'Please mention Model Details',
                'rating.*'=>'Please mention rating',
                'country_of_origin.*'=>'Please select country origin',
            ]
            );
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->where('sub_annexure',2)->delete();
                }
                $annexure4 = new Annexure4();
                $annexure4->application_id = $this->decodeid($request->application_id);
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 2;
                $annexure4->line = $request->line;
                $annexure4->compatible_technology = $request->compatible_technology;
                $annexure4->commissioning_date = $request->commissioning_date;
                $annexure4->rated_mfg_capacity = $request->rated_mfg_capacity;
                $annexure4->major_equipments = json_encode($request->major_equipments);
                $annexure4->other_machine_title = json_encode($request->other_machine_title);
                $annexure4->other_machine_title = json_encode($request->other_machine_title);
                $annexure4->equipments_type = json_encode($request->equipments_type);
                $annexure4->no_of_units = json_encode($request->no_of_units);
                $annexure4->make = json_encode($request->make);
                $annexure4->model = json_encode($request->model);
                $annexure4->rating = json_encode($request->rating);
                $annexure4->country_of_origin = json_encode($request->country_of_origin);
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
            
                $annexure4->save();
                // dd($annexure4);
                $id=$annexure4->id;
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 4 part 2 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-two/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect('users/annexure-four-two/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,2);
            if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }else{
                foreach($appData as $index => $entry) {
                    $appData[$index] = $entry;
                    $appData[$index]['major_equipments']=Annexure4::getMajoEquipmentData($entry->major_equipments);
                    // $appData[$index]['other_machine_title']=Annexure4::getMajoEquipmentData($entry->other_machine_title);
                    $appData[$index]['country_of_origin'] = Annexure4::getCountryData($entry->country_of_origin);
                    $appData[$index]['equipments_type'] = Annexure4::getEquipmentType($entry->equipments_type);
                }
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $annexuredata['major_equipments'] = json_decode($annexuredata->major_equipments);
                // $annexuredata['other_machine_title'] = $annexuredata->other_machine_title;
                $annexuredata['other_machine_title'] = json_decode($annexuredata->other_machine_title);
                $annexuredata['equipments_type'] = json_decode($annexuredata->equipments_type);
                $annexuredata['no_of_units'] = json_decode($annexuredata->no_of_units);
                $annexuredata['make'] = json_decode($annexuredata->make);
                $annexuredata['model'] = json_decode($annexuredata->model);
                $annexuredata['rating'] = json_decode($annexuredata->rating);
                $annexuredata['country_of_origin'] = json_decode($annexuredata->country_of_origin);
                //  dd($annexuredata);
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 2 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
            }
            
        }
        $countries=Country::all();
        $machineList = MachineList::all();
        //  dd($machineList);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 2 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour2',compact('application_id','annexuredata','appData','countries','machineList','progressBar'));
    }
    public function annexureFourThree(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureFourOfThree($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->where('sub_annexure',3)->delete();
                }

                $annexure4 = new Annexure4();
                $annexure4->application_id = $this->decodeid($request->application_id);
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 3;
                $annexure4->make_and_model = $request->make_and_model;
                $annexure4->machine_serial_no = $request->machine_serial_no;
                $annexure4->calibration_done_by = $request->calibration_done_by;
                $annexure4->last_calibration_date = $request->last_calibration_date;
                $annexure4->calibration_valid_upto = $request->calibration_valid_upto;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();

                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('calibration_certificate')){
                    $calibration_certificate=$this->uploadFile($request->file('calibration_certificate'), $dir_path_payment,'ANNEXURE4_SUNSMU_'.Auth::user()->id.'_'.$request->edit_id);
                    $annexure4->calibration_certificate = $calibration_certificate['name'];
                }
            
                $annexure4->save();
                $id=$annexure4->id;
                $url = urlencode('/users/annexure-four-three/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'no']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
                
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,3);
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 3 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
               //dd($annexuredata);
            }
            
        }
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 3 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour3',compact('application_id','annexuredata','appData','progressBar'));
    }
    public function annexureFourFour(Request $request, $application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureFourOfFour($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $deletOldAnnexure = Annexure4::where('id',$request->edit_id)->where('user_id',Auth::user()->id)->where('sub_annexure',4)->delete();
                }
                $docPrefix='GOLD';
                if($request->module_type==2){$docPrefix="SILVER";}
                $annexure4 = new Annexure4();
                $annexure4->application_id = $this->decodeid($request->application_id);
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 4;
                $annexure4->module_type = $request->module_type;
                $annexure4->machine_serial_no = $request->machine_serial_no;
                $annexure4->calibration_done_by = $request->calibration_done_by;
                $annexure4->last_calibration_date = $request->last_calibration_date;
                $annexure4->calibration_valid_upto = $request->calibration_valid_upto;

                $annexure4->technology_used = $request->technology_used;
                $annexure4->no_full_cell = $request->no_full_cell;
                $annexure4->no_half_cell = $request->no_half_cell;
                $annexure4->capacity = $request->capacity;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
            
                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('calibration_certificate')){
                    $calibration_certificate=$this->uploadFile($request->file('calibration_certificate'), $dir_path_payment,'ANNEXURE4_'.$docPrefix.'_'.Auth::user()->id.'_'.$request->edit_id);
                    $annexure4->calibration_certificate = $calibration_certificate['name'];
                }

                $annexure4->save();
                $id=$annexure4->id;

                $url = urlencode('/users/annexure-four-four/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'no']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }

            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=$count=array();
        if(isset($application_id)){
            //$appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,4);
            $appData = Annexure4::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('sub_annexure',4)->orderby('module_type','ASC')->get();
            $count['gold']=Annexure4::where('module_type',1)->where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('sub_annexure',4)->count();
            $count['silver']=Annexure4::where('module_type',2)->where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('sub_annexure',4)->count();
            //dd($count);
            if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 4 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
               //dd($annexuredata);
            }
            
        }
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 4 Form', 'user_type'=>'MFT');
        $modulelist = ModuleType::where('status',1)->get();
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour4',compact('application_id','annexuredata','appData','progressBar','count','modulelist'));
    }
    public function annexureFourFive(Request $request,$application_id=NULL,$edit_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureFourOfFive($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id){
                    $annexure4 = Annexure4::findOrFail($request->edit_id);
                }else{
                    $annexure4 = new Annexure4();
                }
                $annexure4->application_id = $this->decodeid($request->application_id);
                $annexure4->user_id = Auth::user()->id;
                $annexure4->sub_annexure = 5;
                $annexure4->iso_certificate = $request->iso_certificate;
                $annexure4->issuing_agency = $request->issuing_agency;
                $annexure4->issuing_date = $request->issuing_date;
                $annexure4->certificate_validate = $request->certificate_validate;
                $annexure4->created_at = $this->getCurrentDate();
                $annexure4->updated_at = $this->getCurrentDate();
                
                $dir_path_certificate = 'systems\\Certificate\\';
                Storage::disk('filestore')->makeDirectory($dir_path_certificate);
                if($request->hasFile('iso_certificate_doc')){
                    $iso_certificate_doc=$this->uploadFile($request->file('iso_certificate_doc'), $dir_path_certificate,'ANNEXURE4_ISO_Certificate'.'_'.Auth::user()->id.'_'.$request->application_id);
                    $annexure4->iso_certificate_doc = $iso_certificate_doc['name'];
                }
                $annexure4->save();

                $id=$annexure4->id;
                $url = urlencode('/users/annexure-four-five/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'no']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure4::getAnnexureFourData($application_id,Auth::user()->id,5);
            //dd($appData);
            if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure4::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure 4 part 5 Form', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
               //dd($annexuredata);
            }
            
        }
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 4 part 5 Form', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFour.annexureFour5',compact('application_id','annexuredata','appData','progressBar'));
    }
    // Vivek
    public function annexureFiveBk(Request $request, $application_id=NULL, $edit_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureFive($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
               
                $request->edit_id = $this->decodeid($request->edit_id);
                $url = urlencode('/users/annexure-five/'.$request->application_id);
                if($request->id)
                {
                    
                    $annexure5 = Annexure5::findOrFail($request->id);
                    //dd($annexure5);
                    $annexure5->application_id = $this->decodeid($request->application_id);
                    $annexure5->user_id = Auth::user()->id;
                    $annexure5->month = $request->month;
                    $annexure5->financial_year = $request->financial_year;
                    $annexure5->module_production_data = $request->module_production_data;
                    $annexure5->module_sale = $request->module_sale;
                    $annexure5->module_sale_amount = $request->module_sale_amount;
                    $annexure5->type = 0;
                    $annexure5->epc_other_amount = $request->epc_other_amount;
                    $annexure5->total_sales = $request->total_sales;
                    $annexure5->raw_purchase_module = $request->raw_purchase_module;
                    $annexure5->other_raw_purchase = $request->other_raw_purchase;
                    $annexure5->total_purchase = $request->total_purchase;
                    $annexure5->update();
                    $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Annexure 5 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                    //return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Annexure Details updated successfuly!');
                }else{
                    $annexure5 = new Annexure5();
                    $annexure5->application_id = $this->decodeid($request->application_id);
                    $annexure5->user_id = Auth::user()->id;
                    $annexure5->month = $request->month;
                    $annexure5->financial_year = $request->financial_year;
                    $annexure5->module_production_data = $request->module_production_data;
                    $annexure5->module_sale = $request->module_sale;
                    $annexure5->module_sale_amount = $request->module_sale_amount;
                    $annexure5->epc_other_amount = $request->epc_other_amount;
                    $annexure5->total_sales = $request->total_sales;
                    $annexure5->raw_purchase_module = $request->raw_purchase_module;
                    $annexure5->other_raw_purchase = $request->other_raw_purchase;
                    $annexure5->total_purchase = $request->total_purchase;
                    $annexure5->save();
                    $auditData = array('action_type'=>'Insert','description'=>'Details Saved successfuly for Annexure 5 ', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                    //return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                }
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
         $appData=$annexuredata=array();
        if(isset($application_id)){
            $startYear = date("Y")+1;
            $prevYear = date("Y");
            $current_financial_year = $prevYear."-".$startYear;
            $appData = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('financial_year',$current_financial_year)->get();



            $startYear = date("Y");
            $prevYear = date("Y")-1;
            $last_financial_year = $prevYear."-".$startYear;
            $lfyappData = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('financial_year',$last_financial_year)->get();

            $startYear = date("Y")-1;
            $prevYear = date("Y")-2;
            $lasttolast_financial_year = $prevYear."-".$startYear;
            $ltlfyappData = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->where('financial_year',$lasttolast_financial_year)->get();
            if(!$appData){
                dd('Invalid Request');
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure5::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure  5', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //dd($annexuredata);
            }
        }
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 5', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFive.annexureFive',compact('application_id','appData','annexuredata','lfyappData','ltlfyappData','progressBar'));

    }   
    // Vivek
    public function annexureFive(Request $request, $application_id=NULL, $financial_year=NULL,$datatype=NULL){

        if($request->isMethod('post')){
            // $validation = $this->validator->validateAnnexureFive($request);
            // if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            // {
            //     return response()->json(['status'=>'verror','data'=>$validation['message']]);
            // }
            try {
                //dd($request);
                // dd(array_combine($request->month,$request->cf));
                if($request->edit_id){
                    Annexure5::where('application_id',$this->decodeid($request->application_id))->where('financial_year',$request->financial_year)
                    ->where('user_id',Auth::user()->id)->where('type',$request->datatype)->delete();
                    
                }
                if($request->datatype==3){
                    $checkData=Annexure5::where('application_id',$this->decodeid($request->application_id))
                    ->where('user_id',Auth::user()->id)->where('type',$request->datatype)->first();
                }else{
                    $checkData=Annexure5::where('application_id',$this->decodeid($request->application_id))->where('financial_year',$request->financial_year)
                    ->where('user_id',Auth::user()->id)->where('type',$request->datatype)->first();
                }
                
                //1=PV Module Sale Data, 2=Raw Material, 3=Production Date
                if($request->datatype==1){
                    $i=0;
                    //dd($request);
                    if($checkData==null){
                        $chk=array();
                        for($i=0;$i<=count($request->module_sale)-1;$i++){
                            $annexure5 = new Annexure5();
                            $annexure5->financial_year = $request->financial_year;
                            $annexure5->month = $request->month[$i];
                            $annexure5->user_id = Auth::user()->id;
                            $annexure5->type = $request->datatype;
                            $annexure5->application_id = $this->decodeid($request->application_id);
                            $annexure5->module_sale = $request->module_sale[$i];
                            $annexure5->module_sale_domestic = $request->module_sale_domestic[$i];
                            $annexure5->module_sale_amount = $request->module_sale_amount[$i];
                            $annexure5->epc_other_amount = $request->epc_other_amount[$i];
                            $annexure5->save();
                        }
                        $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Financial Year '.$request->financial_year, 'user_type'=>'MFT');
                        $this->auditTrail($auditData);
                        return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Details updated successfuly for Financial Year '.$request->financial_year);
                    }
                    return redirect('users/annexure-five/'.$request->application_id)->with('error', 'Details already saved for Financial Year '.$request->financial_year);
                   

                }
                if($request->datatype==2){
                    $i=0;
                    if($checkData==null){
                        for($i=0;$i<=count($request->module_sale)-1;$i++){
                            $annexure5 = new Annexure5();
                            $annexure5->financial_year = $request->financial_year;
                            $annexure5->user_id = Auth::user()->id;
                            $annexure5->month = $request->month[$i];
                            $annexure5->type = $request->datatype;
                            $annexure5->application_id = $this->decodeid($request->application_id);
                            $annexure5->raw_purchase_module = $request->raw_purchase_module[$i];
                            $annexure5->other_raw_purchase = $request->other_raw_purchase[$i];
                            $annexure5->save();
                        }
                        $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Financial Year '.$request->financial_year, 'user_type'=>'MFT');
                        $this->auditTrail($auditData);
                        return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Details updated successfuly for Financial Year '.$request->financial_year);
                    }
                    return redirect('users/annexure-five/'.$request->application_id)->with('error', 'Details already saved for Financial Year '.$request->financial_year);

                }
                if($request->datatype==3){
                    $i=0;
                    if($checkData==null){
                        for($i=0;$i<=count($request->cf)-1;$i++){
                            $annexure5 = new Annexure5();
                            $annexure5->financial_year = $request->cf_fy;
                            $annexure5->user_id = Auth::user()->id;
                            $annexure5->month = $request->month[$i];
                            $annexure5->type = $request->datatype;
                            $annexure5->application_id = $this->decodeid($request->application_id);
                            $annexure5->module_production_data = $request->cf[$i];
                            $annexure5->save();
                        }

                        for($j=0;$j<=count($request->lf)-1;$j++){
                            $annexure5 = new Annexure5();
                            $annexure5->financial_year = $request->lf_fy;
                            $annexure5->user_id = Auth::user()->id;
                            $annexure5->month = $request->month[$j];
                            $annexure5->type = $request->datatype;
                            $annexure5->application_id = $this->decodeid($request->application_id);
                            $annexure5->module_production_data = $request->lf[$j];
                            $annexure5->save();
                        }

                        for($k=0;$k<=count($request->llf)-1;$k++){
                            $annexure5 = new Annexure5();
                            $annexure5->financial_year = $request->llf_fy;
                            $annexure5->user_id = Auth::user()->id;
                            $annexure5->month = $request->month[$k];
                            $annexure5->type = $request->datatype;
                            $annexure5->application_id = $this->decodeid($request->application_id);
                            $annexure5->module_production_data = $request->llf[$k];
                            $annexure5->save();
                        }

                        $auditData = array('action_type'=>'Update','description'=>'Details updated successfuly for Financial Year '.$request->financial_year, 'user_type'=>'MFT');
                        $this->auditTrail($auditData);
                        return redirect('users/annexure-five/'.$request->application_id)->with('status', 'Details updated successfuly for Financial Year '.$request->financial_year);
                    }
                    return redirect('users/annexure-five/'.$request->application_id)->with('error', 'Details already saved for Financial Year '.$request->financial_year);
                }
                
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
        $appData=$annexuredata=$financialYear=array();
        if(isset($application_id)){
            $appData_fetch = Annexure5::where('application_id',$application_id)->where('user_id',Auth::user()->id)->orderBy("id")->get();
            $financialYearData = Annexure5::select('financial_year')->where('application_id',$application_id)->where('user_id',Auth::user()->id)
            ->groupby('financial_year')->orderBy("financial_year",'DESC')->get()->toArray();
            $i=$j=$k=$l=0;
            if($financialYearData!=null){
                    $financialYear['current']=$financialYearData[0]['financial_year'] ?? '';
                    $financialYear['last']=$financialYearData[1]['financial_year'] ?? '';
                    $financialYear['lastTolast']=$financialYearData[2]['financial_year'] ?? '';
            }
            foreach($appData_fetch as $data){$i++;
                
                if($data->type==1){ //Module Sale Data
                    $appData['datatype1'][$i]=$data;
                }elseif($data->type==2){ //Raw material
                    $appData['datatype2'][$i]=$data;
                }elseif($data->type==3){
                    
                    //$appData['datatype3'][$i]=$data;
                    if($data->financial_year ==$financialYear['current']){
                        $j++;
                       $appData['datatype3']['current'][$j]=$data->toArray();
                    }
                    if($data->financial_year ==$financialYear['last']){
                        $k++;
                        $appData['datatype3']['last'][$k]=$data->toArray();
                    }
                    if($data->financial_year ==$financialYear['lastTolast']){
                        $l++;
                        $appData['datatype3']['lastTolast'][$l]=$data->toArray();
                    }
                     
                }
            }
            $urlParameter=array();
            if(isset($datatype)){
                $urlParameter = array('financialyear'=>$financial_year,'datatype'=>$this->decodeid($datatype),'edit'=>'yes');
                $datatype = $this->decodeid($datatype);
                $annexuredata = Annexure5::where('user_id',Auth::user()->id)->where('application_id',$application_id)
                    ->where('type',$datatype)->where('financial_year',$financial_year)->orderby('id')->get();
                if($annexuredata->first()==null){
                    //return redirect()->back()->with("error","Invalid Request !");
                    //return redirect('users/annexure-five/'.$this->encodeid($application_id))->with('error', 'Invalid Request');
                }
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure  5', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                
            }
        }
        $attc_balance_sheet_last_years=ApplicationDetail::select('attc_balance_sheet_last_years')->where('id',$application_id)->first();
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 5', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureFive.annexureFive',compact('application_id','appData','annexuredata','financialYear','progressBar','urlParameter','attc_balance_sheet_last_years'));

    }  
    public function updateModuleData(Request $request){
        $annexure5 = Annexure5::FindOrFail($request->dataid);
        $annexure5->module_production_data = $request->datavalue;
        $annexure5->save();
        return response()->json(['status'=>'success'], 200);

    }   
    // annexure5attachment
    public function annexure5attachment(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            
            $request->validate(
                [
                    'attc_balance_sheet_last_years'       =>  'required|file|mimes:pdf|max:10192',
                ],
                [
                    'attc_balance_sheet_last_years.required' => "Please upload balance sheet",
                    'attc_balance_sheet_last_years.mimes' => "Please upload PDF file only",
                    'attc_balance_sheet_last_years.max' => "Maximum file size to upload is 2MB ."
                ]);
           
            try {
                $request->application_id=$this->decodeid($request->application_id);
                $dir_path_logo = 'systems\\Attachment\\';
                $attc_balance_sheet_last_years_file='';
                Storage::disk('filestore')->makeDirectory($dir_path_logo);
                $balanceSheetFile = ApplicationDetail::findOrFail($request->application_id);
                if($request->hasFile('attc_balance_sheet_last_years')){
               
                    $attc_balance_sheet_last_years=$this->uploadFile($request->file('attc_balance_sheet_last_years'), $dir_path_logo,'BALANCE_SHEET'.$request->application_id);
                    $balanceSheetFile->attc_balance_sheet_last_years = $attc_balance_sheet_last_years['name'];
                }
                $balanceSheetFile->save();
                $auditData = array('action_type'=>'Upload','description'=>'User Uploaded Module Data Sheet', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return redirect('users/annexure-five/'.$this->encodeid($request->application_id))->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                dd($th->getCode().'||'.$th->getMessage());
                return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            }
            

        }
        
    }

    public function annexureSix(Request $request, $application_id=NULL, $edit_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureSix($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            
            try {
                $request->edit_id = $this->decodeid($request->edit_id);
                if($request->edit_id)
                {
                    $annexure6 = Annexure6::findOrFail($request->edit_id);
                }else{
                    $annexure6 = new Annexure6();
                }
                    
                $annexure6->application_id = $this->decodeid($request->application_id);
                $annexure6->user_id = Auth::user()->id;
                $annexure6->name_of_company = $request->name_of_company;
                $annexure6->country = $request->country;
                $annexure6->address = $request->address;
                $annexure6->whether_enlisted = $request->whether_enlisted;
                $annexure6->noofpv_models = $request->noofpv_models;
                $annexure6->manufacturing_capacity = $request->manufacturing_capacity;
                $annexure6->save();
                $id=$annexure6->id;
                $auditData = array('action_type'=>'Insert','description'=>'Details Saved successfuly for Annexure 6 ', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //$id=Annexure2::insert($dataArray);
                $url = urlencode('/users/annexure-four/'.$request->application_id);
                if($id){
                    $auditData = array('action_type'=>'Update','description'=>'Annexure Details Updated successfuly!', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                }else{
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!','url'=>'no']);
                    //return redirect('users/annexure-one/'.$request->application_id)->with('error', 'Error in Updating Details');
                }
                //return redirect('users/annexure-six/'.$request->application_id)->with('status', 'Annexure Details saved successfuly!');
                
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $application_id=$this->decodeid($application_id);
         $appData=$annexuredata=array();
        if(isset($application_id)){
            $appData = Annexure6::where('application_id',$application_id)->where('user_id',Auth::user()->id)->get();
            //dd($appData);
            if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }
            if(isset($edit_id)){
                $edit_id = $this->decodeid($edit_id);
                $annexuredata = Annexure6::where('user_id',Auth::user()->id)->where('id',$edit_id)->get()->first();
                $auditData = array('action_type'=>'Edit','description'=>'Edit Annexure  6', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                //dd($annexuredata);
            }
        }
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $countrydata = Country::select('countrycd','name')->get();
        $auditData = array('action_type'=>'View','description'=>'View Annexure 6', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureSix.annexureSix',compact('application_id','appData','annexuredata','countrydata','progressBar'));

    }   
    public function annexureSeven(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureSeven($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
                $request->edit_id=$this->decodeid($request->edit_id);
                $applicationDetails = ApplicationDetail::find($request->edit_id);
                if($applicationDetails==null){
                    $auditData = array('action_type'=>'Error','description'=>'Invalid Request', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return redirect()->back()->with("error","Invalid Request !");
                }
                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('annexure7')){
                    $attachment_2=$this->uploadFile($request->file('annexure7'), $dir_path_payment,'ANNEXURE7_'.$request->edit_id);
                    $applicationDetails->annexure7 = $attachment_2['name'];
                }   
                $applicationDetails->save();
                $url = urlencode('/users/annexure-seven/'.$request->application_id);
                $auditData = array('action_type'=>'Upload','description'=>'Annexure uploaded successfuly', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
                //return redirect('users/annexure-seven/'.$request->application_id)->with('status', 'Annexure uploaded successfuly!');
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $appData=array();
        $application_id=$this->decodeid($application_id);
        if(isset($application_id)){
            $appData = ApplicationDetail::select('annexure7','id')->where('id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }
        }
        //dd($appData);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 7', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureSeven.annexureSeven',compact('application_id','appData','progressBar'));
    }
    public function annexureEight(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            $validation = $this->validator->validateAnnexureEight($request);
            if ($validation['status']=='error')   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validation['message']]);
            }
            try {
                $request->edit_id=$this->decodeid($request->edit_id);
                $applicationDetails = ApplicationDetail::find($request->edit_id);
                if($applicationDetails==null){
                    return redirect()->back()->with("error","Invalid Request !"); 
                }
                $dir_path_payment = 'systems\\Annexure\\';
                Storage::disk('filestore')->makeDirectory($dir_path_payment);
                if($request->hasFile('annexure8')){
                    $attachment_2=$this->uploadFile($request->file('annexure8'), $dir_path_payment,'ANNEXURE8_'.$request->edit_id);
                    $applicationDetails->annexure8 = $attachment_2['name'];
                }  
                $applicationDetails->save();
                $url = urlencode('/users/annexure-eight/'.$request->application_id);
                $auditData = array('action_type'=>'Upload','description'=>'Annexure uploaded successfuly', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'success','message'=>'Annexure Details saved successfuly!','url'=>$url]);
            } catch (Exception $ex) {
                
                $auditData = array('action_type'=>'ExError','description'=>'Error:'.$ex->getMessage(), 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }

        }
        $appData=array();
        $application_id=$this->decodeid($application_id);
        if(isset($application_id)){
            $appData = ApplicationDetail::select('annexure8','id')->where('id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                dd('Invalid Request');
            }
        }
        //dd($appData);
        $progressBar = $this->ProgressBar->getApplicationAnnexureProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'View Annexure 8', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureEight.annexureEight',compact('application_id','appData','progressBar'));
    }
    public function deleteAnnexure($annexure_id,$id){
        $id=$this->decodeid($id);
        if($annexure_id ==1){ //Annexure Table 1
            $deleteData = Annexure1::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==2){ //Annexure Table 2
            $deleteData = Annexure2::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==3){ //Annexure Table 3
            $deleteData = Annexure3::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==4){ //Annexure Table 4
            $deleteData = Annexure4::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==5){ //Annexure Table 5
            $deleteData = Annexure5::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        if($annexure_id ==6){ //Annexure Table 6
            $deleteData = Annexure6::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        
        if($deleteData){
            $auditData = array('action_type'=>'Delete','description'=>'Annexure deleted', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
             return redirect()->back()->with('status', 'Delete successfuly!');
        }else{
             return redirect()->back()->with('error', 'Error in Deleting Details');
        }
    }
    public function deleteAnnexure5($annexure_id,$id){
        $id = $this->decodeid($id);
        if($annexure_id ==1){ //Annexure Table 1
            $deleteData = Annexure5::where('id',$id)->where('user_id',Auth::user()->id)->delete();
        }
        
        if($deleteData){
            $auditData = array('action_type'=>'Delete','description'=>'Annexure Deleted', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
             return redirect()->back()->with('status', 'Delete successfuly!');
        }else{
             return redirect()->back()->with('error', 'Error in Deleting Details');
        }
    }
    public function annexureAttachment(Request $request,$application_id=NULL){
        if($request->isMethod('post')){
            $request->application_id=$this->decodeid($request->application_id);
            $annexureAttachmentData = ApplicationDetail::findOrFail($request->application_id);
            $dir_path_logo = 'systems\\Attachment\\';
            Storage::disk('filestore')->makeDirectory($dir_path_logo);

            //Certificate of Incorporation
            if($request->hasFile('attc_incorporation_cerificate')){
                $request->validate(
                    [
                    'attc_incorporation_cerificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_incorporation_cerificate.mimes' => "Please upload PDF file only",
                    'attc_incorporation_cerificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_incorporation_cerificate=$this->uploadFile($request->file('attc_incorporation_cerificate'), $dir_path_logo,'CORP_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_incorporation_cerificate = $attc_incorporation_cerificate['name'];
            }
            //Details of Payment of Application and Inspection Fee
            if($request->hasFile('attc_application_inspection_payment')){
                $request->validate(
                [
                    'attc_application_inspection_payment'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_application_inspection_payment.mimes' => "Please upload PDF file only",
                    'attc_application_inspection_payment.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_application_inspection_payment=$this->uploadFile($request->file('attc_application_inspection_payment'), $dir_path_logo,'PAYMENT_'.$request->application_id);
                $annexureAttachmentData->attc_application_inspection_payment = $attc_application_inspection_payment['name'];
            }
            //Datasheets of the modules applied for enlistment in ALMM
            if($request->hasFile('attc_enlisted_module_datalist')){
                $request->validate(
                [
                    'attc_enlisted_module_datalist'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_enlisted_module_datalist.mimes' => "Please upload PDF file only",
                    'attc_enlisted_module_datalist.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_enlisted_module_datalist=$this->uploadFile($request->file('attc_enlisted_module_datalist'), $dir_path_logo,'MODULE_DATALIST_'.$request->application_id);
                $annexureAttachmentData->attc_enlisted_module_datalist = $attc_enlisted_module_datalist['name'];
            }
            //Datasheets of the solar cells used in the modules
            if($request->hasFile('attc_solar_cell_datalist')){
                $request->validate(
                [
                    'attc_solar_cell_datalist'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_solar_cell_datalist.mimes' => "Please upload PDF file only",
                    'attc_solar_cell_datalist.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_solar_cell_datalist=$this->uploadFile($request->file('attc_solar_cell_datalist'), $dir_path_logo,'SOLARCELL_DATALIST_'.$request->application_id);
                $annexureAttachmentData->attc_solar_cell_datalist = $attc_solar_cell_datalist['name'];
            }
            //Details of Balance of Materials as sought in Application Form
            if($request->hasFile('attc_bom_details')){
                $request->validate(
                [
                    'attc_bom_details'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_bom_details.mimes' => "Please upload PDF file only",
                    'attc_bom_details.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_bom_details=$this->uploadFile($request->file('attc_bom_details'), $dir_path_logo,'BOM_DETAILS_'.$request->application_id);
                $annexureAttachmentData->attc_bom_details = $attc_bom_details['name'];
            }
            //Copy of Certificate for BIS Registration/ Certification
            if($request->hasFile('attc_bis_certificate')){
                $request->validate(
                [
                    'attc_bis_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_bis_certificate.mimes' => "Please upload PDF file only",
                    'attc_bis_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_bis_certificate=$this->uploadFile($request->file('attc_bis_certificate'), $dir_path_logo,'BIS_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_bis_certificate = $attc_bis_certificate['name'];
            }
            //Copy of the Accreditation Certificate of the Lab which has given test certificates required for BIS Registration/ Certification
            if($request->hasFile('attc_accreditation_certificate')){
                $request->validate(
                [
                    'attc_accreditation_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_accreditation_certificate.mimes' => "Please upload PDF file only",
                    'attc_accreditation_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_accreditation_certificate=$this->uploadFile($request->file('attc_accreditation_certificate'), $dir_path_logo,'ACREDITATION_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_accreditation_certificate = $attc_accreditation_certificate['name'];
            }
            //Calibration Report of Sun Simulator
            if($request->hasFile('attc_calibration_report_sun_simulator')){
                $request->validate(
                [
                    'attc_calibration_report_sun_simulator'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_calibration_report_sun_simulator.mimes' => "Please upload PDF file only",
                    'attc_calibration_report_sun_simulator.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_calibration_report_sun_simulator=$this->uploadFile($request->file('attc_calibration_report_sun_simulator'), $dir_path_logo,'REPORT_SUN_SIMULATOR_'.$request->application_id);
                $annexureAttachmentData->attc_calibration_report_sun_simulator = $attc_calibration_report_sun_simulator['name'];
            }
            //Calibration Report of Reference Modules
            if($request->hasFile('attc_calibration_report_module')){
                $request->validate(
                [
                    'attc_calibration_report_module'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_calibration_report_module.mimes' => "Please upload PDF file only",
                    'attc_calibration_report_module.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_calibration_report_module=$this->uploadFile($request->file('attc_calibration_report_module'), $dir_path_logo,'REPORT_MODULE_'.$request->application_id);
                $annexureAttachmentData->attc_calibration_report_module = $attc_calibration_report_module['name'];
            }
            //Copy of valid ISO Certificate for quality management system
            if($request->hasFile('attc_iso_certificate')){
                $request->validate(
                [
                    'attc_iso_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_iso_certificate.mimes' => "Please upload PDF file only",
                    'attc_iso_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_iso_certificate=$this->uploadFile($request->file('attc_iso_certificate'), $dir_path_logo,'ISO_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_iso_certificate = $attc_iso_certificate['name'];
            }
            //Balance Sheet for last three years or the period of existence of such units, whichever is less
            if($request->hasFile('attc_balance_sheet_last_years')){
                $request->validate(
                [
                    'attc_balance_sheet_last_years'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_balance_sheet_last_years.mimes' => "Please upload PDF file only",
                    'attc_balance_sheet_last_years.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_balance_sheet_last_years=$this->uploadFile($request->file('attc_balance_sheet_last_years'), $dir_path_logo,'BALANCE_SHEET_'.$request->application_id);
                $annexureAttachmentData->attc_balance_sheet_last_years = $attc_balance_sheet_last_years['name'];
            }
            //Trademark Registration Certificate
            if($request->hasFile('attc_trademark_certificate')){
                $request->validate(
                [
                    'attc_trademark_certificate'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_trademark_certificate.mimes' => "Please upload PDF file only",
                    'attc_trademark_certificate.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_trademark_certificate=$this->uploadFile($request->file('attc_trademark_certificate'), $dir_path_logo,'TRADEMARK_CERTIFICATE_'.$request->application_id);
                $annexureAttachmentData->attc_trademark_certificate = $attc_trademark_certificate['name'];
            }
            //Construction Data Form(CDF) from BIS lab Report
            if($request->hasFile('attc_bis_lab_report')){
                $request->validate(
                [
                    'attc_bis_lab_report'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_bis_lab_report.mimes' => "Please upload PDF file only",
                    'attc_bis_lab_report.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_bis_lab_report=$this->uploadFile($request->file('attc_bis_lab_report'), $dir_path_logo,'BIS_LAB_REPORT_'.$request->application_id);
                $annexureAttachmentData->attc_bis_lab_report = $attc_bis_lab_report['name'];
            }
            //BIS lab Report
            if($request->hasFile('attc_lab_report')){
                $request->validate(
                [
                    'attc_lab_report'       =>  'file|mimes:pdf|max:10192',
                ],
                [
                    'attc_lab_report.mimes' => "Please upload PDF file only",
                    'attc_lab_report.max' => "Maximum file size to upload is 10MB (10192 KB)."
                ]);
                $attc_lab_report=$this->uploadFile($request->file('attc_lab_report'), $dir_path_logo,'LAB_REPORT_'.$request->application_id);
                $annexureAttachmentData->attc_lab_report = $attc_lab_report['name'];
                $annexureAttachmentData->attachment_uploaded=1;
            }
            try {
                
                $annexureAttachmentData->save();
                $auditData = array('action_type'=>'Upload','description'=>'User Upload Attachments', 'user_type'=>'MFT');
                $this->auditTrail($auditData);
                $request->application_id=$this->encodeid($request->application_id);
                return redirect('users/annexure-attachment/'.$request->application_id)->with('status', 'Dcoument upload successfuly!');
            } catch (\Throwable $th) {
                return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            }
            

        }
        $appData=array();
        $application_id=$this->decodeid($application_id);
        if(isset($application_id)){
            $appData = ApplicationDetail::where('id',$application_id)->where('user_id',Auth::user()->id)->first();
            if(!$appData){
                return redirect()->back()->with("error","Invalid Request !");
            }
        }
        //dd($appData);
        $progressBar = $this->ProgressBar->getApplicationProgress($application_id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Annexure attachment page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        return view('backend.user.form.annexureAttachment',compact('application_id','appData','progressBar'));
    }
    public function deleteAttachment($application_id,$column_name){
        $file_name='';
        $application_id=$this->decodeid($application_id);
        $annexureAttachmentData = ApplicationDetail::findOrFail($application_id);
        if($column_name=='attachment_1'){
            $file=ApplicationDetail::getAttachmentName('attc_incorporation_cerificate',$application_id);
            $file_name = $file->attc_incorporation_cerificate;
            $annexureAttachmentData->attc_incorporation_cerificate = NULL;
        }
        if($column_name=='attachment_2'){
            $file=ApplicationDetail::getAttachmentName('attc_application_inspection_payment',$application_id);
            $file_name = $file->attc_application_inspection_payment;
            $annexureAttachmentData->attc_application_inspection_payment = NULL;
        }
        if($column_name=='attachment_3'){
            $file=ApplicationDetail::getAttachmentName('attc_enlisted_module_datalist',$application_id);
            $file_name = $file->attc_enlisted_module_datalist;
            $annexureAttachmentData->attc_enlisted_module_datalist = NULL;
        }
        if($column_name=='attachment_4'){
            $file=ApplicationDetail::getAttachmentName('attc_solar_cell_datalist',$application_id);
            $file_name = $file->attc_solar_cell_datalist;
            $annexureAttachmentData->attc_solar_cell_datalist = NULL;
        }
        if($column_name=='attachment_5'){
            $file=ApplicationDetail::getAttachmentName('attc_bom_details',$application_id);
            $file_name = $file->attc_bom_details;
            $annexureAttachmentData->attc_bom_details = NULL;
        }
        if($column_name=='attachment_6'){
            $file=ApplicationDetail::getAttachmentName('attc_bis_certificate',$application_id);
            $file_name = $file->attc_bis_certificate;
            $annexureAttachmentData->attc_bis_certificate = NULL;
        }
        if($column_name=='attachment_7'){
            $file=ApplicationDetail::getAttachmentName('attc_accreditation_certificate',$application_id);
            $file_name = $file->attc_accreditation_certificate;
            $annexureAttachmentData->attc_accreditation_certificate = NULL;
        }
        if($column_name=='attachment_8'){
            $file=ApplicationDetail::getAttachmentName('attc_calibration_report_sun_simulator',$application_id);
            $file_name = $file->attc_calibration_report_sun_simulator;
            $annexureAttachmentData->attc_calibration_report_sun_simulator = NULL;
        }
        // if($column_name=='attachment_9'){
        //     $file=ApplicationDetail::getAttachmentName('attc_calibration_report_module',$application_id);
        //     $file_name = $file->attc_calibration_report_module;
        //     $annexureAttachmentData->attc_calibration_report_module = NULL;
        // }
        if($column_name=='attachment_9'){
            $file=ApplicationDetail::getAttachmentName('attc_iso_certificate',$application_id);
            $file_name = $file->attc_iso_certificate;
            $annexureAttachmentData->attc_iso_certificate = NULL;
        }
        if($column_name=='attachment_10'){
            $file=ApplicationDetail::getAttachmentName('attc_balance_sheet_last_years',$application_id);
            $file_name = $file->attc_balance_sheet_last_years;
            $annexureAttachmentData->attc_balance_sheet_last_years = NULL;
        }
        if($column_name=='attachment_11'){
            $file=ApplicationDetail::getAttachmentName('attc_trademark_certificate',$application_id);
            $file_name = $file->attc_trademark_certificate;
            $annexureAttachmentData->attc_trademark_certificate = NULL;
        }
        //attc_lab_report
        if($column_name=='attachment_12'){
            $file=ApplicationDetail::getAttachmentName('attc_bis_lab_report',$application_id);
            $file_name = $file->attc_bis_lab_report;
            $annexureAttachmentData->attc_bis_lab_report = NULL;
        }
        if($column_name=='attachment_13'){
            $file=ApplicationDetail::getAttachmentName('attc_lab_report',$application_id);
            $file_name = $file->attc_lab_report;
            $annexureAttachmentData->attc_lab_report = NULL;
        }
        Storage::disk('filestore')->delete('systems/Attachment/'.$file_name);
        $annexureAttachmentData->save();
        $auditData = array('action_type'=>'Delete','description'=>'Deleted Annexure attachment ', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        $application_id=$this->encodeid($application_id);
        return redirect('users/annexure-attachment/'.$application_id)->with('status', 'Dcoument Removed successfuly!');
      
    }
    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL){
        try {
            //code...
            $filePath = 'documents/systems/'.$folder.'/'.$file;
            //$filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
            return view('auth.preview', compact('filePath'));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
       
    }

}