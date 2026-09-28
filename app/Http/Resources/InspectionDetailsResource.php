<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InspectionDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    private $docUrl;
    public function toArray($request)
    {
        $this->docUrl = url('api/v1/get-document/'.base64_encode($this->owner_id).'/'.base64_encode('inspection'));

        return [
            'id' => $this->id,
            'general' => [
                'system_id' => $this->system_id,
                'owner_id' => $this->owner_id,
                'installation_id' => $this->installation_id,
                'installer_id' => $this->installer_id,
                'village' => $this->village,
                'post' => $this->post,
                'block' => $this->block,
                'panchayat' => $this->panchayat,
                'ward_no' => $this->ward_no,
                'house_no' => $this->house_no,
                'state_id' => $this->state_id,
                'district_id' => $this->district_id,
                'sub_district_id' => $this->sub_district_id,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'installer_name' => $this->name
            ],
            'inspection_details' => [
                'inspection_id' => $this->id,
                'inspector_id' => $this->inspector_id,
                'inspection_code' => $this->inspection_id,
                'date_of_inspection' => !empty($this->date_of_inspection) ? date('d-m-Y', strtotime($this->date_of_inspection)) : NULL,
                'appropriate_location' => $this->appropriate_location,
                'beneficiary_feeding_plant' => $this->beneficiary_feeding_plant,
                'biogas_production_optimum_level' => $this->biogas_production_optimum_level,
                'plant_connected_to_pipeline' => $this->plant_connected_to_pipeline,
                'biogas_used_at_kitchen' => $this->biogas_used_at_kitchen,
                'optimum_quantity_of_biogas_slurry_produced' => $this->optimum_quantity_of_biogas_slurry_produced,
                'slurry_used_for_agriculture_business' => $this->slurry_used_for_agriculture_business,
                'recommendations' => $this->recommendations,
                'approval' => $this->approval,
                'corrections' => $this->corrections,
                'pic_of_plant_with_family_member' => !empty($this->pic_of_plant_with_family_member) ? $this->docUrl.'/'.base64_encode(json_decode($this->pic_of_plant_with_family_member, true)['name']) : NULL,
                'pic_of_stove_with_flame' => !empty($this->pic_of_stove_with_flame) ? $this->docUrl.'/'.base64_encode(json_decode($this->pic_of_stove_with_flame, true)['name']) : NULL
            ]
        ];
    }
}
