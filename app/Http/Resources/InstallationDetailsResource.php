<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstallationDetailsResource extends JsonResource
{
    private $docUrl;

    public function toArray($request)
    {
        $this->docUrl = url('api/v1/get-document/'.base64_encode($this->owner_id).'/'.base64_encode('installation'));
        $documents = !empty($this->documents) ? $this->prepareDocuments($this->documents) : NULL;
        return [
            'id' => $this->id,
            'general' => [
                'bpmr_no' => $this->bpmr_no,
                'owner_id' => $this->owner_id,
                'beneficiary_name' => $this->beneficiary_name,
                'beneficiary_category' => $this->beneficiary_category,
                'house_no' => $this->house_no,
                'village' => $this->village,
                'post' => $this->post,
                'block' => $this->block,
                'panchayat' => $this->panchayat,
                'ward_no' => $this->ward_no,
                'state_id' => $this->state_id,
                'district_id' => $this->district_id,
                'sub_district_id' => $this->sub_district_id,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'agreement_date' => !empty($this->agreement_date) ? date('d-m-Y', strtotime($this->agreement_date)) : NULL,
                'construction_start_date' => !empty($this->construction_start_date) ? date('d-m-Y', strtotime($this->construction_start_date)) : NULL,
                'completion_date' => !empty($this->completion_date) ? date('d-m-Y', strtotime($this->completion_date)) : NULL,
                'biogas_model' => $this->biogas_model,
                'capacity' => $this->capacity,
                'toilet_status' => $this->toilet_status,
                'onm_routines_schedule' => !empty($this->onm_routines_schedule) ? date('d-m-Y', strtotime($this->onm_routines_schedule)) : NULL,
                'state_implementing_agency_code' => $this->state_implementing_agency_id,
                'localbody_code' => $this->localbody_id
            ],
            'bank_details' => [
                'bank_name' => $this->bank_name,
                'branch_address' => $this->branch_address,
                'account_no' => $this->account_no,
                'account_type' => $this->account_type,
                'ifsc_code' => $this->ifsc_code,
                'branch_code' => $this->branch_code,
                'micr_code' => $this->micr_code,
                'bank_passbook' => !empty($this->bank_passbook) ? $this->docUrl.'/'.base64_encode(json_decode($this->bank_passbook, true)['name']) : NULL
            ],
            'documents' => $documents
        ];
    }
    protected function prepareDocuments($documents)
    {
        $documents = json_decode($documents, true);
        foreach($documents as $key => $doc)
            $documents[$key] = !empty($doc) ? $this->docUrl.'/'.base64_encode($doc['name']) : NULL;

        return $documents;
    }
}
