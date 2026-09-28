<?php

namespace App\Imports;

use App\Models\State;
use App\Models\Installer;
use App\Models\District;
use App\Traits\General;
use App\Utils\EmailSmsNotifications;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InstallerImport implements ToModel, WithStartRow
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
        $uniqueId = $this->generateIdForStakeholders('INT',$this->getStateId($row[3]));
        $installer =  new Installer([
            'installer_id' => $uniqueId,
            'program_id' => $row[0],
            'name' => $row[1],
            'category' => $row[2],
            'state_id' => $this->getStateId($row[3]),
            'district_id' => $this->getDistrictId($row[4]),
            'address' => $row[5],
            'pincode' => $row[6],
            'contact_person' => $row[7],
            'phone' => $row[8],
            'email' => $row[9],
            'aadhar_no' => base64_encode($row[10]),
            'bdtc_biogas_training_certificate_no' => $row[11],
            'website' => $row[12],
            'user_id' => $row[13],
            'short_info' => $row[14],
            'company_reg_no' => $row[15],
            'installation_experiance' => $row[16],
            'installed_plants' => $row[17],
            'bank_name' => $row[18],
            'branch_address' => $row[19],
            'account_no' => $row[20],
            'account_type' => $row[21],
            'ifsc_code' => $row[22],
            'branch_code' => $row[23],
            'micr_code' => $row[24],
            'comment' => $row[25],
            'date_of_reg' => $row[26],
            'password' => bcrypt($password),
        ]);
        
        $this->emailSmsNotifications->notifyInstallerRegistration($row[9], $password, $uniqueId, $row[1], $row[8]);
        return $installer;
    }

    public function startRow(): int
    {
        return 2;
    }

    protected function getStateId($name){
        $dbState = State::where('name', 'LIKE', '%'.strtoupper($name).'%')->select('code', 'name', 'short_name')->first();
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
