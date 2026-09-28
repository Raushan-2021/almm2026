<?php

namespace App\Imports;

use App\Models\State;
use App\Models\LocalbodyUser;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\District;
use App\Utils\EmailSmsNotifications;
use App\Traits\General;

class LocalbodyImport implements ToModel, WithStartRow
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
        $uniqueId =  $this->generateIdForStakeholders('LOB', $this->getStateId($row[4]));
        $localBody = new LocalbodyUser([
            'localbody_id' => $uniqueId,
            'program_id' => $row[0],
            'name' => $row[1],
            'nodal' => $row[2],
            'superior_agency' => (int)$row[3],
            'state_id' => $this->getStateId($row[4]),
            'district_id' => $this->getDistrictId($row[5]),
            'address' => $row[6],
            'pincode' => $row[7],
            'contact_person' => $row[8],
            'phone' => $row[9],
            'email' => $row[10],
            'website' => $row[11],
            'short_info' => $row[12],
            'date_of_reg' => date('d-m-Y', strtotime($row[13])),
            'password' => bcrypt($password),
        ]);
        
        $this->emailSmsNotifications->notifyLocalbodyRegistration($row[10], $password, $uniqueId, $row[1], $row[9]);
        return $localBody;
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
