<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Traits\General;
use App\Models\ApplicationDetail;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
use App\Models\ApplicationPaymentDetails;
// use App\Models\Annexure4;
// use App\Models\Annexure5;
// use App\Models\Annexure6;
use App\Models\ModuleType;
use App\Models\Module;
use App\Models\MainMasterModule;
use App\Http\Controllers\Controller;
use App\Utils\ApplicationProgress;

use App\Utils\EmailSmsNotifications;
// DB,Hash, Storage,Config, Gate,Session,PDF, 
use  URL,Auth,Exception,Validator;

class ModuleController extends Controller
{
    use General;

    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        $this->ProgressBar = new ApplicationProgress();
    }

    public function moduleMaster(Request $request,$id=NULL){
        $id=$this->decodeid($id);
        $moduleData =array();
        $progressBar = $this->ProgressBar->getApplicationProgress($id);
        $auditData = array('action_type'=>'View','description'=>'Viewed Add Module Page', 'user_type'=>'MFT');
        $this->auditTrail($auditData);
        $moduleData = MainMasterModule::getModuleDataById($id);
       // echo "<pre>";
        //echo  count( $moduleData);die;

        $getmoduleData = ApplicationDetail::where('user_id',Auth::user()->id)->where('id',$id)->first();

    
        if ($getmoduleData['installed_manufacturing_capacity'] == null || $getmoduleData['production_date'] == null  || $getmoduleData['calibration_certificate'] == null || $getmoduleData['raw_mtrl_docs'] == null || $getmoduleData['details_sales_docs'] == null ||
         $getmoduleData['profit_loss_docs'] == null || $getmoduleData['statement_assests_docs'] == null || $getmoduleData['balance_sheet_docs'] == null) {
            return redirect()->back()->with('error', 'Invalid Request');   
        }
        
        

        //echo "<pre>";
       // print_r($moduleData);die();
        return view('backend.user.form.Module.viewModule',compact('moduleData','progressBar','id'));
         
    }

    public function addModule(Request $request, $id = NULL, $editid = NULL) {
        // dd($request);
        if ($request->isMethod('post')) {  //print_r($request->all()); die();
        
            $validator = Validator::make($request->all(), [
                'module_type' => 'required|max:50',
                'main_model_name' => 'required',
                'main_wattage.*' => 'required|numeric',
                'sub_model_name.*' => 'required',
                'sub_model_wattage.*' => 'required|numeric',
                'cell_type.*' => 'required',
                'max_system_volatge.*' => 'required|numeric',
            ], [
                'module_type.required' => 'Type of Modules field is required.',
                'main_model_name.required' => 'Model Name field is required.',
                'main_wattage.*.required' => 'Applicable models covered under +- 5%, Pmax of Main Model field is required',
                'sub_model_name.*.required' => 'Applicable models covered under +- 5%, Pmax of Main Model field is required',
                'sub_model_wattage.*.required' => 'Applicable models covered under +- 5%, Pmax of Main Model field is required',
                'cell_type.*.required' => 'Applicable models covered under +- 5%, Pmax of Main Model field is required',
                'max_system_volatge.*.required' => 'Applicable models covered under +- 5%, Pmax of Main Model field is required',
            ]);
    
            if ($validator->fails()) {  
                return response()->json(['status' => 'verror', 'data' => $validator->errors()]);
            }

            try {
           
                $app_id = $this->decodeid($request->app_id);
                $count = count($request->sub_model_name);
    
                // If edit_id exists, we are updating an existing record
                if ($request->edit_id) {
                    $request->edit_id = $this->decodeid($request->edit_id);
                    $mainModuleData = MainMasterModule::find($request->edit_id);
    
                    if ($mainModuleData == null) {
                        return response()->json(['status' => 'error', 'message' => 'Invalid Request']);
                    }

                    $mainModuleData->user_id = Auth::user()->id;
                    $mainModuleData->application_id = $app_id;
                    $mainModuleData->module_type = $request->module_type;
                    $mainModuleData->main_model_name = $request->main_model_name;
                    $mainModuleData->main_wattage = $request->main_wattage;
                    $mainModuleData->other = $request->other;
                    $mainModuleData->updated_at = $this->getCurrentDate();
                    $mainModuleData->save();
                    $mainId = $mainModuleData->id;

                    // $deleteModule=Module::where('application_id',$app_id)->where('user_id',Auth::id())->delete();
                    // $deleteModule=Annexure1::where('application_id',$app_id)->where('user_id',Auth::id())->delete();
                    // $deleteModule=Annexure2::where('application_id',$app_id)->where('user_id',Auth::id())->delete();
                    // $deleteModule=Annexure3::where('application_id',$app_id)->where('user_id',Auth::id())->delete();
                    $modules = Module::where('main_module_id', $mainId)->pluck('id');

                    Annexure1::whereIn('module_type', $modules)->delete();
                    Annexure2::whereIn('module_type', $modules)->delete();
                    Annexure3::whereIn('module_type', $modules)->delete();
                    Module::where('main_module_id', $mainId)->delete();

                    for ($i = 0; $i < $count; $i++) {
                        $moduleData = new Module();
                        $moduleData->user_id = Auth::user()->id;
                        $moduleData->application_id = $app_id;
                        $moduleData->main_module_id = $mainId;
                        $moduleData->sub_model_name = $request->sub_model_name[$i];
                        $moduleData->sub_model_wattage = $request->sub_model_wattage[$i];
                        $moduleData->cell_type = $request->cell_type[$i];
                        $moduleData->max_system_volatge = $request->max_system_volatge[$i];
                        $moduleData->created_at = $this->getCurrentDate();
                        $moduleData->save();
                        $moduleId = $moduleData->id;

                        $Annexure1 = new Annexure1();
                        $Annexure1->user_id = Auth::user()->id;
                        $Annexure1->application_id = $app_id;
                        $Annexure1->module_type = $moduleId;
                        $Annexure1->created_at = $this->getCurrentDate();
                        $Annexure1->save();

                        $Annexure2 = new Annexure2();
                        $Annexure2->user_id = Auth::user()->id;
                        $Annexure2->application_id = $app_id;
                        $Annexure2->module_type = $moduleId;
                        $Annexure2->created_at = $this->getCurrentDate();
                        $Annexure2->save();

                        $Annexure3 = new Annexure3();
                        $Annexure3->user_id = Auth::user()->id;
                        $Annexure3->application_id = $app_id;
                        $Annexure3->module_type = $moduleId;
                        $Annexure3->created_at = $this->getCurrentDate();
                        $Annexure3->save();

                    }
                } else {            
                    $mainModuleData = new MainMasterModule();
                    $mainModuleData->user_id = Auth::user()->id;
                    $mainModuleData->application_id = $app_id;
                    $mainModuleData->module_type = $request->module_type;
                    $mainModuleData->main_model_name = $request->main_model_name;
                    $mainModuleData->main_wattage = $request->main_wattage;
                    $mainModuleData->other = $request->other;
                    $mainModuleData->created_at = $this->getCurrentDate();
                    $mainModuleData->save();
                    $mainId = $mainModuleData->id;

                    // If edit_id does not exist, create new records
                    for ($i = 0; $i < $count; $i++) {
                        $moduleData = new Module();
                        $moduleData->user_id = Auth::user()->id;
                        $moduleData->application_id = $app_id;
                        $moduleData->main_module_id = $mainId;
                        $moduleData->sub_model_name = $request->sub_model_name[$i];
                        $moduleData->sub_model_wattage = $request->sub_model_wattage[$i];
                        $moduleData->cell_type = $request->cell_type[$i];
                        $moduleData->max_system_volatge = $request->max_system_volatge[$i];
                        $moduleData->created_at = $this->getCurrentDate();
                        $moduleData->save();
                        $moduleId = $moduleData->id;

                        $Annexure1 = new Annexure1();
                        $Annexure1->user_id = Auth::user()->id;
                        $Annexure1->application_id = $app_id;
                        $Annexure1->module_type = $moduleId;
                        $Annexure1->created_at = $this->getCurrentDate();
                        $Annexure1->save();

                        $Annexure2 = new Annexure2();
                        $Annexure2->user_id = Auth::user()->id;
                        $Annexure2->application_id = $app_id;
                        $Annexure2->module_type = $moduleId;
                        $Annexure2->created_at = $this->getCurrentDate();
                        $Annexure2->save();

                        $Annexure3 = new Annexure3();
                        $Annexure3->user_id = Auth::user()->id;
                        $Annexure3->application_id = $app_id;
                        $Annexure3->module_type = $moduleId;
                        $Annexure3->created_at = $this->getCurrentDate();
                        $Annexure3->save();

                    }
                }
    
               $url = urlencode('/users/module-master/' . $request->app_id);
                return response()->json(['status' => 'success', 'message' => 'Module Details saved successfully!', 'url' => $url, 'redirect' => 'yes']);
            } catch (\Exception $ex) {
                $auditData = ['action_type' => 'View', 'description' => 'User viewed Master Module detail', 'user_type' => 'MFT'];
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError', 'message' => $ex->getCode() . '||' . $ex->getMessage()]);
            }
        }
    
        // Decoding Ids
        $id = $this->decodeid($id);
        $moduleData = [];
        $subModuleData = [];
        if ($editid) {
            $editid = $this->decodeid($editid);
            $moduleData = $this->getModuleByID($editid, $id);
            $subModuleData = $this->getsUBModuleByID($editid, $id);
        }
        $auditData = ['action_type' => 'View', 'description' => 'Viewed Add Module Page', 'user_type' => 'MFT'];
        $modulelist = ModuleType::where('status', 1)->get();
      
        $this->auditTrail($auditData);
        $progressBar = $this->ProgressBar->getApplicationProgress($id);
    
        return view('backend.user.form.Module.addNewModule', compact('id', 'progressBar', 'modulelist', 'moduleData','subModuleData'));
    }

    public function getModuleByID($ediId,$applicationID){
        // echo $ediId;die();
        $getmoduleData = MainMasterModule::where('user_id',Auth::user()->id)->where('id',$ediId)->where('application_id',$applicationID)->first();
        if($getmoduleData!=null){
            $moduleData=$getmoduleData;
            // $moduleData['applicable_model_covered']=json_decode($getmoduleData->applicable_model_covered);
            // $moduleData['module_type']=json_decode($getmoduleData->module_type);     
            return $moduleData;  
            // dd($moduleData);          
        }else{
            $auditData = array('action_type'=>'Insert','description'=>'Invalid Request!', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
            return redirect()->back()->with('error', 'Invalid Request');   
        }
    }
    public function getsUBModuleByID($ediId,$applicationID){
        // echo $ediId;die();
        $getmoduleData = Module::where('user_id',Auth::user()->id)->where('main_module_id',$ediId)->where('application_id',$applicationID)->get();
        if($getmoduleData!=null){
            $moduleData=$getmoduleData;
            // $moduleData['applicable_model_covered']=json_decode($getmoduleData->applicable_model_covered);
            // $moduleData['module_type']=json_decode($getmoduleData->module_type);     
            return $moduleData;  
            // dd($moduleData);          
        }else{
            $auditData = array('action_type'=>'Insert','description'=>'Invalid Request!', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
            return redirect()->back()->with('error', 'Invalid Request');   
        }
    }
/*    public function deleteModule($id){
        try {
            //code...
            $id=$this->decodeid($id);
            // dd($id);
            $checkModule = Module::where('id',$id)->where('user_id',Auth::id())->first();
            
            if($checkModule!=null){
                $deleteModule=Module::where('id',$id)->where('user_id',Auth::id())->delete();
                // dd($deleteModule);
                Annexure1::where('module_type',$id)->where('user_id',Auth::id())->delete();
                Annexure2::where('module_type',$id)->where('user_id',Auth::id())->delete();
                Annexure3::where('module_type',$id)->where('user_id',Auth::id())->delete();
                if($deleteModule==1){
                    return redirect('users/module-master/'.$this->encodeid($checkModule->application_id))->with('status', 'Module Deleted Successfully!');
                }
                
            }else{
                return redirect()->back()->with('error', 'Invalid Request');   
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            
        }
        
    } */

       public function deleteModule($id){
        try {
            //code...
            $id=$this->decodeid($id);
            // dd($id);
            $checkModule = MainMasterModule::where('id',$id)->where('user_id',Auth::id())->first();
            
            if($checkModule!=null){
                $deleteMainModule=MainMasterModule::where('id',$id)->where('user_id',Auth::id())->delete();
                // dd($deleteModule);
                $checkSubModule = Module::where('main_module_id',$id)->where('user_id',Auth::id())->get();

                foreach($checkSubModule as $value){
                    Annexure1::where('module_type',$value->id)->where('user_id',Auth::id())->delete();
                    Annexure2::where('module_type',$value->id)->where('user_id',Auth::id())->delete();
                    Annexure3::where('module_type',$value->id)->where('user_id',Auth::id())->delete();
                }

                $deleteModule=Module::where('main_module_id',$id)->where('user_id',Auth::id())->delete();


                if($deleteModule==1){
                    return redirect('users/module-master/'.$this->encodeid($checkModule->application_id))->with('status', 'Module Deleted Successfully!');
                }
                
            }else{
                return redirect()->back()->with('error', 'Invalid Request');   
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'ExError','message'=>$th->getCode().'||'.$th->getMessage()]);
            
        }
        
    } 
    
}