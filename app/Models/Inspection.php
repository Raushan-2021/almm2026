<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = ['inspection_id','inspector_id','installation_id','approval_date'];

    public static function getAll($inspectorId = null, $inspectionId = null)
    {
        $query = self::join('installations', 'installations.id', 'inspections.installation_id')
                    ->join('consumers', 'consumers.id', 'installations.consumer_id')
                    ->join('installers', 'installers.id', 'installations.installer_id')
                    ->join('inspectors', 'inspectors.id', 'installations.inspector_id')
                    ->join('installation_statuses', 'installation_statuses.id', 'installations.installation_status')
                    ->select(
                        'inspections.*',
                        'installations.bpmr_no',
                        'consumers.consumer_id as consumerId',
                        'consumers.name as consumer',
                        'installers.name as installer',
                        'installers.installer_id as installerId',
                        'inspectors.inspector_id as inspectorId',
                        'installation_statuses.name as status',
                        'installation_statuses.id as statusId'
                    );

        if($inspectorId){
            $query->where('inspections.inspector_id', $inspectorId);
        }

        if($inspectionId){
            $query->where('inspections.id', $inspectionId);
            return $query->first();
        }
        $query->orderby('inspections.updated_at','DESC');
        return $query->get();
    }
    public static function getInspectionDetails($applicationId)
    {
        $inspections = self::select(self::getFormFields())
                            ->where('inspections.id', $applicationId)
                            ->leftjoin('installations','installations.id','inspections.installation_id')
                            ->leftjoin('installers','installers.id','installations.installer_id')
                            ->leftjoin('inspectors', 'inspectors.id','inspections.inspector_id')
                            ->leftjoin('consumers','consumers.id','installations.consumer_id')
                            ->first();
        return $inspections;
    }
    protected static function getFormFields()
    {
        return [
            'inspections.id',
            'installations.bpmr_no AS system_id',
            'consumers.consumer_id AS owner_id',
            'installations.id AS installation_id',
            'installers.installer_id',
            'consumers.village',
            'consumers.post',
            'consumers.block',
            'consumers.panchayat',
            'consumers.ward_no',
            'consumers.house_no',
            'consumers.state_id',
            'consumers.district_id',
            'consumers.sub_district_id',
            'installations.latitude',
            'installations.longitude',
            'inspections.inspection_id',
            'inspections.date AS date_of_inspection',
            'inspectors.inspector_id',
            'installers.name',
            'inspections.appropriate_location',
            'inspections.beneficiary_feeding_plant',
            'inspections.biogas_production_optimum_level',
            'inspections.plant_connected_to_pipeline',
            'inspections.biogas_used_at_kitchen',
            'inspections.optimum_quantity_of_biogas_slurry_produced',
            'inspections.slurry_used_for_agriculture_business',
            'inspections.pic_of_plant_with_family_member',
            'inspections.pic_of_stove_with_flame',
            'inspections.recommendations',
            'inspections.approval',
            'inspections.corrections'
        ];
    }
}
