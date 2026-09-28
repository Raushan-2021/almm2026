<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Installation extends Model
{
    protected $fillable = [
        'installation_status',
        'consumer_id',
        'installer_id',
        'state_implementing_agency_id',
        'installer_assignment_date',
        'approval_date'
    ];
    public static function getAll($installerId = null, $installationId = null, $state = null, $inspectorId = null) 
    {
        $query = self::join('consumers', 'consumers.id', 'installations.consumer_id')
                    ->leftjoin('state_implementing_agency_users', 'state_implementing_agency_users.id', 'installations.state_implementing_agency_id')
                    ->leftjoin('localbody_users', 'localbody_users.id', 'installations.localbody_id')
                    ->leftjoin('installers', 'installers.id', 'installations.installer_id')
                    ->leftjoin('inspectors', 'inspectors.id', 'installations.inspector_id')
                    ->leftjoin('consumer_bank_details', 'consumer_bank_details.consumer_id', 'installations.consumer_id')
                    ->join('installation_statuses', 'installation_statuses.id', 'installations.installation_status')
                    ->join('states', 'states.code', 'consumers.state_id')
                    ->join('districts', 'districts.code', 'consumers.district_id')
                    ->join('sub_districts', 'sub_districts.code', 'consumers.sub_district_id')
                    ->leftjoin('inspections', 'inspections.installation_id', 'installations.id')
                    ->select(
                        'installations.*',
                        'consumers.consumer_id as consumerId',
                        'consumers.name as consumer',
                        'consumers.house_no',
                        'consumers.post',
                        'consumers.block',
                        'consumers.panchayat',
                        'consumers.ward_no',
                        'consumers.village',
                        'consumers.sub_district_id',
                        'consumers.district_id',
                        'consumers.state_id',
                        'consumers.category as consumerCategory',
                        'consumer_bank_details.bank_name',
                        'consumer_bank_details.branch_address',
                        'consumer_bank_details.account_no',
                        'consumer_bank_details.account_type',
                        'consumer_bank_details.ifsc_code',
                        'consumer_bank_details.branch_code',
                        'consumer_bank_details.micr_code',
                        'consumer_bank_details.bank_passbook',
                        'state_implementing_agency_users.name as stateImplementingAgency',
                        'localbody_users.name as localbody',
                        'installers.name as installer',
                        'installers.installer_id as installerUniqueId',
                        'inspectors.name as inspector',
                        'inspectors.inspector_id as inspectorUniqueId',
                        'installation_statuses.name as status',
                        'inspections.id as inspectionId',
                        'inspections.inspection_id as inspectionUniqueId',
                        'inspections.date as inspectionDate',
                        'inspections.appropriate_location',
                        'inspections.beneficiary_feeding_plant',
                        'inspections.biogas_production_optimum_level',
                        'inspections.plant_connected_to_pipeline',
                        'inspections.biogas_used_at_kitchen',
                        'inspections.optimum_quantity_of_biogas_slurry_produced',
                        'inspections.slurry_used_for_agriculture_business',
                        'inspections.recommendations',
                        'inspections.approval as inspectionApproval',
                        'inspections.corrections as inspectionCorrections'
                    )->where('installations.installation_status', '!=', 1);

        if($installerId){
            $query->where('installations.installer_id', $installerId);
        }

        if($inspectorId){
            $query->where('installations.inspector_id', $inspectorId);
        }

        if($state){
            $query->where('consumers.state_id', $state);
        }

        if($installationId){
            $query->where('installations.id', $installationId);
            return $query->first();
        }
        $query->orderby('installations.updated_at', 'DESC');
        return $query->get();
    }
    public static function getInstallationListing($state = NULL, $installerId = null, $inspectorId = null, $priority = null, $status = null)
    {
        $query = Installation::select(
                                        'installations.id',
                                        'consumers.consumer_id',
                                        'consumers.name as consumer_name',
                                        'installations.bpmr_no',
                                        'installations.installation_status',
                                        'installations.inspector_id',
                                        'installations.priority',
                                        'installation_statuses.name as status',
                                        'installers.installer_id',
                                        'states.name as state_name'
                                )->join('consumers','consumers.id','installations.consumer_id')
                                ->leftjoin('states', 'states.code', 'consumers.state_id')
                                ->join('installation_statuses', 'installation_statuses.id', 'installations.installation_status')
                                ->leftjoin('installers', 'installers.id', 'installations.installer_id');

        if($state)
            $query->where('consumers.state_id', $state);

        if($installerId)
            $query->where('installations.installer_id', $installerId);

        if($inspectorId)
            $query->where('installations.inspector_id', $inspectorId);
        
        if(!empty($priority))
            $query->where('installations.priority', $priority);
        
        if(!empty($status)){
            $query->where('installations.installation_status', $status);
        }

        $query->orderBy('installations.updated_at','DESC');
        $installations = $query->get();

        return $installations;
    }
    public static function getInstallations($params, $status)
    {
        $query = self::select([
                                'installations.id AS id',
                                'installations.bpmr_no as installation_code',
                                'installations.installer_assignment_date AS assigned_date',
                                'installations.agreement_date',
                                'installations.completion_date',
                                'installations.approval_date',
                                'installations.priority',
                                'installers.id AS installer_id',
                                'installers.installer_id AS installer_code',
                                'installers.name AS installer_name',
                                'consumers.name AS consumer_name',
                                'consumers.village AS village',
                                'states.name AS state_name',
                                'districts.name AS district_name',
                                'sub_districts.name AS sub_district_name',
                                'installations.installation_status',
                                'installation_statuses.name as status_name',
                                'inspections.inspection_id as inspection_code',
                                'inspections.inspector_id'
                            ])
                            ->where('installations.installer_id', $params->user['id'])
                            ->whereIn('installations.installation_status', $status)
                            ->leftjoin('installers','installers.id','installations.installer_id')
                            ->leftjoin('consumers','consumers.id','installations.consumer_id')
                            ->leftjoin('states','states.code','consumers.state_id')
                            ->leftjoin('districts','districts.code','consumers.district_id')
                            ->leftjoin('sub_districts','sub_districts.code','consumers.sub_district_id')
                            ->leftjoin('installation_statuses','installation_statuses.id','installations.installation_status')
                            ->leftjoin('inspections','inspections.installation_id','installations.id');

        $count = $query->count();

        if(!empty($params->limit))
            $query->limit($params->limit)->offset($params->offset);

        $query->orderBy('installations.updated_at', 'DESC');

        $installations = $query->get()->map(function($installation){
            $installation->assigned_date = !empty($installation->assigned_date) ? date('d M Y', strtotime($installation->assigned_date)) : NULL;
            $installation->agreement_date = !empty($installation->agreement_date) ? date('d M Y', strtotime($installation->agreement_date)) : NULL;
            $installation->completion_date = !empty($installation->completion_date) ? date('d M Y', strtotime($installation->completion_date)) : NULL;
            $installation->approval_date = !empty($installation->approval_date) ? date('d M Y', strtotime($installation->approval_date)) : NULL;
            return $installation;
        });

        return ['count' => $count, 'installations' => $installations];
    }
    public static function getInspections($params, $status)
    {
        $query = self::select([
                                'consumers.id AS consumer_id',
                                'inspections.id AS inspection_id',
                                'inspections.inspection_id as inspection_code',
                                'installations.installer_assignment_date AS assigned_date',
                                'installations.priority',
                                'installers.name AS installer_name',
                                'consumers.name AS consumer_name',
                                'consumers.village AS village',
                                'states.name AS state_name',
                                'districts.name AS district_name',
                                'sub_districts.name AS sub_district_name',
                                'installations.installation_status',
                                'installations.approval_date'
                            ])
                            ->where('installations.inspector_id', $params->user['id'])
                            ->whereIn('installations.installation_status', $status)
                            ->leftjoin('inspections','inspections.installation_id','installations.id')
                            ->leftjoin('installers','installers.id','installations.installer_id')
                            ->leftjoin('consumers','consumers.id','installations.consumer_id')
                            ->leftjoin('states','states.code','consumers.state_id')
                            ->leftjoin('districts','districts.code','consumers.district_id')
                            ->leftjoin('sub_districts','sub_districts.code','consumers.sub_district_id');
                            
        $count = $query->count();

        if(!empty($params->limit))
            $query->limit($params->limit)->offset($params->offset);

        $query->orderBy('inspections.updated_at','DESC');

        $inspections = $query->get()->map(function($inspections){
            $inspections->assigned_date = !empty($inspections->assigned_date) ? date('d M Y', strtotime($inspections->assigned_date)) : NULL;
            $inspections->approval_date = !empty($inspections->approval_date) ? date('d M Y', strtotime($inspections->approval_date)) : NULL;
            return $inspections;
        });

        return ['count' => $count, 'inspections' => $inspections];
    }
    public static function getInstallationDetails($applicationId)
    {
        $installation = self::select(self::getFormFields())
                            ->where('installations.id', $applicationId)
                            ->leftjoin('consumers','consumers.id','installations.consumer_id')
                            ->leftjoin('consumer_bank_details','consumer_bank_details.consumer_id','consumers.id')
                            ->leftjoin('state_implementing_agency_users', 'state_implementing_agency_users.id', 'installations.state_implementing_agency_id')
                            ->leftjoin('localbody_users', 'localbody_users.id', 'installations.localbody_id')
                            ->first();

        return $installation;
    }
    protected static function getFormFields()
    {
        return [
            'installations.id',
            'installations.bpmr_no',
            'consumers.consumer_id AS owner_id',
            'consumers.name AS beneficiary_name',
            'consumers.category AS beneficiary_category',
            'consumers.house_no',
            'consumers.village',
            'consumers.post',
            'consumers.block',
            'consumers.panchayat',
            'consumers.ward_no',
            'consumers.state_id',
            'consumers.district_id',
            'consumers.sub_district_id',
            'installations.latitude',
            'installations.longitude',
            'installations.agreement_date',
            'installations.construction_start_date',
            'installations.completion_date',
            'installations.biogas_model',
            'installations.capacity',
            'installations.toilet_status',
            'installations.onm_routines_schedule',
            'installations.documents',
            'consumer_bank_details.bank_name',
            'consumer_bank_details.branch_address',
            'consumer_bank_details.account_no',
            'consumer_bank_details.account_type',
            'consumer_bank_details.ifsc_code',
            'consumer_bank_details.branch_code',
            'consumer_bank_details.micr_code',
            'consumer_bank_details.bank_passbook',
            'state_implementing_agency_users.state_implementing_agency_id',
            'localbody_users.localbody_id'
        ];
    }
    public static function getInstallation($id)
    {
        $installation = self::select(self::getInstallationSelectFields())
                            ->join('consumers','consumers.id','installations.consumer_id')
                            ->leftjoin('state_implementing_agency_users', 'state_implementing_agency_users.id', 'installations.state_implementing_agency_id')
                            ->leftjoin('localbody_users', 'localbody_users.id', 'installations.localbody_id')
                            ->leftjoin('consumer_bank_details', 'consumer_bank_details.consumer_id', 'installations.consumer_id')
                            ->leftjoin('installation_statuses', 'installation_statuses.id', 'installations.installation_status')
                            ->leftjoin('states', 'states.code', 'consumers.state_id')
                            ->leftjoin('districts', 'districts.code', 'consumers.district_id')
                            ->leftjoin('sub_districts', 'sub_districts.code', 'consumers.sub_district_id')
                            ->leftjoin('inspections', 'inspections.installation_id', 'installations.id')
                            ->leftjoin('inspectors', 'inspectors.id', 'installations.inspector_id')
                            ->leftjoin('installers', 'installers.id', 'installations.installer_id')
                            ->where('installations.id', $id)
                            ->first();
            
        return $installation;
    }
    protected static function getInstallationSelectFields()
    {
        return [
            'installations.*',
            'consumers.consumer_id as consumerId',
            'consumers.name as consumer',
            'consumers.house_no',
            'consumers.post',
            'consumers.block',
            'consumers.panchayat',
            'consumers.ward_no',
            'consumers.village',
            'consumers.sub_district_id',
            'consumers.district_id',
            'consumers.state_id',
            'consumers.category as consumerCategory',
            'consumer_bank_details.bank_name',
            'consumer_bank_details.branch_address',
            'consumer_bank_details.account_no',
            'consumer_bank_details.account_type',
            'consumer_bank_details.ifsc_code',
            'consumer_bank_details.branch_code',
            'consumer_bank_details.micr_code',
            'consumer_bank_details.bank_passbook',
            'state_implementing_agency_users.state_implementing_agency_id as stateImplementingAgencyCode',
            'localbody_users.name as localbody',
            'inspectors.name as inspector',
            'inspectors.inspector_id as inspectorUniqueId',
            'installation_statuses.name as status',
            'inspections.id as inspectionId',
            'inspections.inspection_id as inspectionUniqueId',
            'inspections.date as inspectionDate',
            'inspections.appropriate_location',
            'inspections.beneficiary_feeding_plant',
            'inspections.biogas_production_optimum_level',
            'inspections.plant_connected_to_pipeline',
            'inspections.biogas_used_at_kitchen',
            'inspections.optimum_quantity_of_biogas_slurry_produced',
            'inspections.slurry_used_for_agriculture_business',
            'inspections.recommendations',
            'inspections.approval as inspectionApproval',
            'inspections.pic_of_plant_with_family_member',
            'inspections.pic_of_stove_with_flame',
            'installers.installer_id as installerUniqueId',
            'installers.name as installer'
        ];
    }
}
