<?php

namespace App\Imports;

use App\Models\State;
use App\Models\Inspector;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Utils\EmailSmsNotifications;
use App\Traits\General;

class InspectorImport implements ToModel, WithStartRow
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
        $uniqueId = $this->generateIdForStakeholders('INP', $this->getStateId($row[2]));
        $inspector =  new Inspector([
            'inspector_id' => $uniqueId,
            'program_id' => $row[0],
            'name' => $row[1],
            'state_id' => $this->getStateId($row[2]),
            'phone' => $row[3],
            'email' => $row[4],
            'dob' => date('Y-m-d', strtotime($row[5])),
            'designation' => $row[6],
            'biogas_training_attended' => $row[7],
            'comment' => $row[8],
            'date_of_reg' => date('Y-m-d', strtotime($row[9])),
            'password' => bcrypt($password),
        ]);

        $this->emailSmsNotifications->notifyInpectorRegistration($row[4], $password, $uniqueId, $row[1]);

        return $inspector;
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
}
