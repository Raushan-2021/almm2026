<?php

namespace App\Http\Controllers\Backend\Users;

use Illuminate\Http\Request;
use App\Traits\General;
// use App\Models\ApplicationDetail;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
// use App\Models\Annexure4;
// use App\Models\Annexure5;
// use App\Models\Annexure6;
use App\Models\ModuleType;
use App\Models\Module;
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
        $moduleData = Module::getModuleDataById($id);
        return view('backend.user.form.Module.viewModule',compact('moduleData','progressBar','id'));
         
    }

    public function addModule(Request $request, $id=NULL,$editid=NULL){
        // dd($request);
        if($request->isMethod('post')){
            // dd($request);
            $validator = Validator::make($request->all(), [
                'module_type'                   => 'required|max:50',
                // 'main_model'                    => 'required|max:50',
                // 'pmax_model'                    => 'required',
                'applicable_model_covered'      => 'required',
                // 'applicable_model'              => 'required'
            ],
            [
                'module_type.required'              => 'Type of Modules field is required.',
                // 'main_model.required'               => 'Main Model field is required.',
                // 'pmax_model.required'               =>  'Pmax (Wp) of Main Model field is required',
                'applicable_model_covered.required' =>  'Applicable models covered under +- 5%, Pmax of Main Model field is required',
                // 'applicable_model.required'         =>  'Pmax (Wp) of Applicable Models Model field is required'
            ]
            );
            if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
            {
                return response()->json(['status'=>'verror','data'=>$validator->errors()]);
            }
            try {
                $request->edit_id=$this->decodeid($request->edit_id);
                $app_id = $this->decodeid($request->app_id);
                if($request->edit_id){
                    $moduleData = Module::find($request->edit_id);
                    if($moduleData==null){
                        return response()->json(['status' => 'error','message'=>'Invalid Request']);
                    }
                }else{
                    $moduleData = new Module();
                }
                $moduleData->user_id = Auth::user()->id;
                $moduleData->application_id = $app_id;
                $moduleData->module_type = json_encode($request->module_type);
                $moduleData->other_module_title = json_encode($request->other_module_title);
                // $moduleData->main_model = json_encode($request->main_model);
                // $moduleData->pmax_model = json_encode($request->pmax_model);
                $moduleData->applicable_model_covered = json_encode($request->applicable_model_covered);
                // $moduleData->applicable_model = json_encode($request->applicable_model);
                $moduleData->created_at = $this->getCurrentDate();
                $moduleData->updated_at= $this->getCurrentDate();
            //    dd($moduleData);
                $moduleData->save();
                $moduleData->id;
                $url = urlencode('/users/module-master/'.$request->app_id);
                if($moduleData->id){
                    
                    $auditData = array('action_type'=>'Insert','description'=>'Module Details saved Successfully !', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    
                    return response()->json(['status' => 'success','message'=>'Module Details saved Successfully !','url'=>$url,'redirect'=>'yes']);
                }else{
                    
                    $auditData = array('action_type'=>'Error','description'=>'Error in Updating Details', 'user_type'=>'MFT');
                    $this->auditTrail($auditData);
                    return response()->json(['status' => 'error','message'=>'Error in Updating Details!']);
                }
            } catch (\Exception $ex) {
                //throw $th;
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'View','description'=>'User viewed Master Module detail ','user_type'=>'MFT');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'ExError','message'=>$ex->getCode().'||'.$ex->getMessage()]);
            }
            // Decoding id
            
        }
        //Decoding Ids
        $id=$this->decodeid($id);
        $moduleData=array();
        if($editid){
            $editid=$this->decodeid($editid);
            $moduleData = $this->getModuleByID($editid,$id);
        }
        $auditData = array('action_type'=>'View','description'=>'Viewed Add Module Page', 'user_type'=>'MFT');
        $modulelist = ModuleType::where('status',1)->get();
        $this->auditTrail($auditData);
        $progressBar = $this->ProgressBar->getApplicationProgress($id);
        return view('backend.user.form.Module.addNewModule',compact('id','progressBar','modulelist','moduleData'));
    }

    public function getModuleByID($ediId,$applicationID){
        $getmoduleData = Module::where('user_id',Auth::user()->id)->where('id',$ediId)->where('application_id',$applicationID)->first();
        if($getmoduleData!=null){
            $moduleData=$getmoduleData;

            $moduleData['applicable_model_covered']=json_decode($getmoduleData->applicable_model_covered);
            $moduleData['module_type']=json_decode($getmoduleData->module_type);     
            return $moduleData;            
        }else{
            $auditData = array('action_type'=>'Insert','description'=>'Invalid Request!', 'user_type'=>'MFT');
            $this->auditTrail($auditData);
            return redirect()->back()->with('error', 'Invalid Request');   
        }
    }
    public function deleteModule($id){
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
        
    }
    
}