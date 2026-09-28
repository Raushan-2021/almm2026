<?php

namespace App\Imports;

use App\Models\State;
use App\Models\StateImplementingAgencyUser;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\District;
use App\Utils\EmailSmsNotifications;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Traits\General;

class StateImplementingAgencyImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function model(array $row)
    {
        $password = $this->generateRandomString(10);
        $uniqueId = $this->generateIdForStakeholders('SIA', $this->getStateId($row[3]));
        $sia = new StateImplementingAgencyUser([
            'state_implementing_agency_id' => $uniqueId,
            'program_id' => $row[0],
            'name' => $row[1],
            'nodal' => $row[2],
            'state_id' => $this->getStateId($row[3]),
            'district_id' => $this->getDistrictId($row[4]),
            'pincode' => $row[5],
            'address' => $row[6],
            'contact_person' => $row[7],
            'phone' => $row[8],
            'email' => $row[9],
            'website' => $row[10],
            'short_info' => $row[11],
            'date_of_reg' => date('d-m-Y', strtotime($row[12])),
            'password' => bcrypt($password),
        ]);
        
        $this->emailSmsNotifications->notifyAgencyRegistration($row[9], $password, $uniqueId, $row[1]);
        return $sia;
    }

    public function startRow(): int
    {
        return 2;
    }

    protected function getStateId($name){
        $dbState = State::where('name', 'LIKE', '%'.strtoupper($name).'%')->select('code', 'name')->first();
        $state_name = str_replace(' ', '', $dbState->name);
        $name = str_replace(' ', '', $name);
        similar_text(strtoupper($name), $state_name, $percentage);
        if($percentage >= 70){
            return $dbState->code;
        }
        return NULL;
    }
    protected function getDistrictId($name){
        $dbDistrict = District::where('name', 'LIKE', '%'.strtoupper($name).'%')->select('code', 'name')->first();
        $district_name = str_replace(' ', '', $dbDistrict->name);
        $name = str_replace(' ', '', $name);
        similar_text(strtoupper($name), $district_name, $percentage);
        if($percentage >= 70){
            return $dbDistrict->code;
        }
        return NULL;
    }
}
