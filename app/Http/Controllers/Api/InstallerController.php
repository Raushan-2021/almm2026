<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utils\Responder;
use App\Models\Installer;
use App\Models\Installation;
use App\Models\Consumer;
use App\Traits\General;
use App\Models\ConsumerBankDetails;
use App\Http\Resources\InstallationDetailsResource;
use App\Utils\FormValidator;
use App\Models\MaintenanceRegistry;
use App\Policies\ApiPolicy;
use DB, Validator;

class InstallerController extends Controller
{
    use General;
    private $dir_path;
    public function __construct(){
        $this->responder = new Responder();
        $this->apiPolicy = new ApiPolicy();
    }
    public function getProfile(Request $request)
    {
        try{
            $installer = Installer::getUserProfile($request->user['id']);
            if($installer)
                return $this->responder->makeResult(true, 1004, $installer);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function consumerIntrestForm(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), $this->consumerFormValidations());
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            $requestParems = $this->formatConsumerRequest($request);
            $consumer = Consumer::create($requestParems);
            if($consumer)
                return $this->responder->makeResult(true, 1006, []);

            return $this->responder->makeResult(true, 1011, []);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function getInstallationList(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), ['list_type' => 'required','limit' => 'required','offset' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            $installations = [];
            switch ($request->list_type){
                case 'pending':
                    $installations = Installation::getInstallations($request, [2, 3, 6, 9]);
                break;
                case 'installed':
                    $installations = Installation::getInstallations($request, [4, 5, 7, 8]);
                break;
                case 'approved':
                    $installations = Installation::getInstallations($request, [10]);
                break;
            }

            $messageCode = 1012;

            if(!count($installations))
                $messageCode = 1016;

            return $this->responder->makeResult(true, $messageCode, ['installations' => $installations['installations'], 'total_installations' => $installations['count']]);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }  
    }
    public function getInstallationDetail(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), ['installation_id' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            $installation = new InstallationDetailsResource(Installation::getInstallationDetails($request->installation_id));
            $messageCode = 1011;

            if($installation) 
                $messageCode = 1013;
            
            return $this->responder->makeResult(true, $messageCode, $installation);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }  
    }
    public function updateInstallationDetail(Request $request, Installation $installation, FormValidator $validator)
    {
        $validation = Validator::make($request->all(), ['steps_completed' => 'required','installation_id' => 'required','owner_id' => 'required']);
        if($validation->fails())
            return $this->responder->makeResult(true, 1007, []);

        if($this->apiPolicy->verifyInstallationOwner($request->user['id'], $request->installation_id))
            return $this->responder->makeResult(false, 4002, []);
            
        $installationObj = Installation::select([
                                            'consumers.consumer_id',
                                            'consumers.state_id',
                                            'installations.bpmr_no',
                                            'installations.documents',
                                            'installations.inspector_id'
                                            ])->where('installations.id', $request->installation_id)
                                            ->join('consumers','consumers.id','installations.consumer_id')
                                            ->first();

        if(!$validator->installationDetailValidations($request, $request->steps_completed)){
            return $this->responder->makeResult(true, 1007, []);
        }

        try{
            $consumer_id = $installationObj->consumer_id;
            $state_id = $installationObj->state_id;
            
            $this->dir_path = 'systems\\'.$consumer_id.'\\installation\\';

            $installationData = $this->updateInstallation($request);
            $documents = $this->updateDocuments($request, json_decode($installationObj->documents, true));
            if($request->steps_completed == 3) 
                $this->updateBankDetails($request, $consumer_id);
            
            $documents = json_encode($documents);
            
            if(empty($installationObj->bpmr_no) && $request->steps_completed == 3){
                $installationData['bpmr_no'] = $this->generateIdForStakeholders('SYS', $state_id);
            }
            
            if($request->steps_completed == 3 && !empty($installationObj->inspector_id))
                $installationData['installation_status'] = 7;
            elseif($request->steps_completed == 3)
                $installationData['installation_status'] = 4;

            $installationData['documents'] = $documents;

            Installation::where('id', $request->installation_id)->update($installationData);
            return $this->responder->makeResult(true, 1014, []);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    protected function updateBankDetails($request, $consumer_id)
    {
        $consumer_id = Consumer::where('consumer_id', $consumer_id)->value('id');
        $bankDataArray = [
            'bank_name' => $request->bank_name,
            'branch_address' => $request->branch_address,
            'account_no' => $request->account_no,
            'account_type' => $request->account_type,
            'ifsc_code' => $request->ifsc_code,
            'branch_code' => $request->branch_code,
            'micr_code' => $request->micr_code
        ];
        
        if($request->hasFile('bank_passbook')){
            $bankDataArray['bank_passbook'] = json_encode($this->uploadFile($request->file('bank_passbook'), $this->dir_path));
        }
        
        if(ConsumerBankDetails::where('consumer_id', $consumer_id)->first())
            ConsumerBankDetails::where('consumer_id', $consumer_id)->update($bankDataArray);
        else{
            $bankDataArray['consumer_id'] = $consumer_id;
            ConsumerBankDetails::create($bankDataArray);
        }
    }
    protected function updateInstallation($request)
    {
        $installationDataArray = [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'agreement_date' => date('Y-m-d', strtotime($request->agreement_date)),
            'construction_start_date' => date('Y-m-d', strtotime($request->construction_start_date)),
            'completion_date' => date('Y-m-d', strtotime($request->completion_date)),
            'biogas_model' => $request->biogas_model,
            'capacity' => $request->capacity,
            'toilet_status' => $request->toilet_status,
            'onm_routines_schedule' => date('Y-m-d', strtotime($request->onm_routines_schedule))
        ];
        return $installationDataArray;
    }
    protected function updateDocuments($request, $docs)
    {
        if(empty($docs)) { 
            $docs = [];
         }
        if($request->hasFile('agreement_copy')){
            $docs['agreement_copy'] = $this->uploadFile($request->file('agreement_copy'), $this->dir_path);
        }
        if($request->hasFile('installer_pic')){
            $docs['installer_pic'] = $this->uploadFile($request->file('installer_pic'), $this->dir_path);
        }
        if($request->hasFile('owner_pic')){
            $docs['owner_pic'] = $this->uploadFile($request->file('owner_pic'), $this->dir_path);
        }
        if($request->hasFile('site_before_installation_pic')){
            $docs['site_before_installation_pic'] = $this->uploadFile($request->file('site_before_installation_pic'), $this->dir_path);
        }
        if($request->hasFile('under_const_bio_plant_pic')){
            $docs['under_const_bio_plant'] = $this->uploadFile($request->file('under_const_bio_plant_pic'), $this->dir_path);
        }
        if($request->hasFile('bio_plant_with_beneficiary_pic')){
            $docs['bio_plant_with_beneficiary'] = $this->uploadFile($request->file('bio_plant_with_beneficiary_pic'), $this->dir_path);
        }
        if($request->hasFile('stove_pic')){
            $docs['stove_pic'] = $this->uploadFile($request->file('stove_pic'), $this->dir_path);
        }
        if($request->hasFile('h_s_training_statement_pic')){
            $docs['h_s_training_statement_pic'] = $this->uploadFile($request->file('h_s_training_statement_pic'), $this->dir_path);
        }
        if($request->hasFile('linked_toilet_photo')){
            $docs['linked_toilet_photo'] = $this->uploadFile($request->file('linked_toilet_photo'), $this->dir_path);
        }
        return $docs;
    }
    public function getMaintenanceList(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), ['list_type' => 'required','limit' => 'required','offset' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            $maintenance = [];
            switch ($request->list_type){
                case 'pending':
                    $maintenance = MaintenanceRegistry::getMaintenanceLists($request, 0);
                break;
                case 'completed':
                    $maintenance = MaintenanceRegistry::getMaintenanceLists($request, 1);
                break;
            }
            
            $messageCode = 1020;

            if(!count($maintenance))
                $messageCode = 1021;

            return $this->responder->makeResult(true, $messageCode, ['maintenances' => $maintenance['maintenances'], 'total_maintenances' => $maintenance['count']]);
        }
        catch(\Exception $e){
            return $e;
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function getMaintenanceDetail(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), ['maintenance_id' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            if($this->apiPolicy->verifyMaintenanceOwner($request->user['id'], $request->maintenance_id))
                return $this->responder->makeResult(false, 4002, []);

            $maintenance = MaintenanceRegistry::select([
                                                        'maintenance_registries.id as maintenance_id',
                                                        'maintenance_registries.request_code as maintenance_request_code',
                                                        'maintenance_registries.maintenance_code as maintenance_registry_code',
                                                        'installations.bpmr_no as system_code',
                                                        'maintenance_registries.scheduled_date',
                                                        'maintenance_registries.maintenance_date',
                                                        'maintenance_registries.type as maintenance_type',
                                                        'maintenance_registries.request_note',
                                                        'installers.installer_id',
                                                        'maintenance_registries.description',
                                                        'maintenance_registries.images',
                                                        'consumers.consumer_id'
                                                    ])->where('maintenance_registries.id', $request->maintenance_id)
                                                    ->leftjoin('installers','installers.id','maintenance_registries.installer_id')
                                                    ->leftjoin('installations','installations.id','maintenance_registries.system_id')
                                                    ->join('consumers','consumers.id','installations.consumer_id')
                                                    ->first();
            
            if(!$maintenance)
                return $this->responder->makeResult(true, 1011, []);

            if(!empty($maintenance->scheduled_date))
                $maintenance->scheduled_date = date('d M Y', strtotime($maintenance->scheduled_date));

            if(!empty($maintenance->maintenance_date))
                $maintenance->maintenance_date = date('d M Y', strtotime($maintenance->maintenance_date));

            switch ($maintenance->maintenance_type){
                case 'PR':
                    $maintenance->maintenance_type = 'Preventive';
                break;
                case 'CR':
                    $maintenance->maintenance_type = 'Curative';
                break;
                default: null;
            }

            $maintenance = $maintenance->toArray();

            $imageBaseUrl = url('api/v1/get-document/'.base64_encode($maintenance['consumer_id']).'/'.base64_encode('maintenance'));

            if($maintenance['images']){
                $images = json_decode($maintenance['images'], true);
                $maintenance['images'] = [];
                foreach($images as $key => $image)
                    $maintenance['images'][$key] = $imageBaseUrl.'/'.base64_encode($image['name']).'/'.base64_encode($maintenance['maintenance_registry_code']);
            }

            return $this->responder->makeResult(true, 1023, $maintenance);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function updateMaintenanceDetails(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), ['maintenance_id' => 'required','description' => 'required','maintenance_date' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            if($this->apiPolicy->verifyMaintenanceOwner($request->user['id'], $request->maintenance_id))
                return $this->responder->makeResult(false, 4002, []);
                
            $record = MaintenanceRegistry::select('maintenance_registries.request_code','consumers.consumer_id','states.short_name','maintenance_registries.maintenance_date')
                                            ->where('maintenance_registries.id', $request->maintenance_id)
                                            ->leftjoin('installations','maintenance_registries.system_id','installations.id')
                                            ->leftjoin('consumers','installations.consumer_id','consumers.id')
                                            ->join('states','states.code','consumers.state_id')
                                            ->first();

            $registryCode = MaintenanceRegistry::generateCode($record->short_name, 'MREG');

            $this->dir_path = 'systems\\'.$record->consumer_id.'\\maintenance\\'.$registryCode.'\\';
            $documents = [];
            if(!empty($request->hasFile('images'))){
                $files = $request->file('images');
                foreach($files as $image){
                    $result = $this->uploadFile($image, $this->dir_path);
                    array_push($documents, $result);
                }
            }
            $documents = json_encode($documents);
            $arrayData = [
                'maintenance_code' => $registryCode,
                'images' => $documents,
                'description' => $request->description,
                'status' => 1,
                'maintenance_date' => date('Y-m-d', strtotime($request->maintenance_date))
            ];
            
            $maintenance  = MaintenanceRegistry::where('id', $request->maintenance_id)->update($arrayData);
            
            if(!$maintenance){
                return $this->responder->makeResult(true, 1011, []);
            }
            return $this->responder->makeResult(true, 1024, []);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    protected function consumerFormValidations()
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'aadhar_no' => 'required',
            'category' => 'required',
            'house_no' => 'required',
            'village' => 'required',
            'post' => 'required',
            'block' => 'required',
            'panchayat' => 'required',
            'ward_no' => 'required',
            'sub_district_id' => 'required',
            'state_id' => 'required',
            'district_id' => 'required',
            'toilet_linked' => 'required',
            'number_of_cattle' => 'required'
        ];
    }
    protected function formatConsumerRequest($request)
    {
        return [
            'installer_id' => $request->user['id'],
            'consumer_id' => $this->generateIdForStakeholders('CON', $request->state_id),
            'name' => $request->name,
            'house_no' => $request->house_no,
            'village' => $request->village,
            'post' => $request->post,
            'block' => $request->block,
            'panchayat' => $request->panchayat,
            'ward_no' => $request->ward_no,
            'sub_district_id' => $request->sub_district_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'phone' => $request->phone,
            'aadhar_no' => base64_encode($request->aadhar_no),
            'email' => $request->email,
            'category' => $request->category,
            'toilet_linked' => $request->toilet_linked,
            "existing_biogas_plant" => $request->existing_biogas_plant,
            'subsidy_availed' => $request->subsidy_availed,
            'comment' => $request->comment,
            'number_of_cattle' => json_encode($request->number_of_cattle),
            'date_of_reg' => date("d-m-Y")
        ];
    }
}
