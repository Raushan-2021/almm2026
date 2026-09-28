<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\Mnre;
use App\Models\User;
use App\Models\Nise;
// use App\Models\Installation;
// use App\Models\Inspection;
// use App\Models\MaintenanceRegistry;
use App\Models\StateImplementingAgencyUser;
use App\Models\ApplicationDetail;

use Auth, Log;

class EmailSmsNotifications
{
    use General;
    public function __construct(){}
    public function notifyManufacturerRegistration($email, $password, $name)
    {
        try{
            $data['password'] = $password;
            $data['name'] = $name;
            $this->sendMail('notifyAlmmRegistration', $data, $email, 'ALMM Application Portal: Manufacturer Registration Successful');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }

    public function notifyUserApplicationSubmission($data,$applicationNo,$userid=NULL)
    {
        try {
            //code...
            $user = User::select('name','email')->where('id',$userid)->first();
            $data['name']=$user->name;
            $data['email']=$user->email;
            $data['applicationNo']=$applicationNo;
            $this->sendMail('notifyUserApplicationSubmission', $data, $data['email'], 'Application Submitted successfuly. Your Application No. : '.$applicationNo);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }

    }
    public function notifyMNREApplicationSubmission($data,$applicationNo)
    {
        try {
            //code...
            $mnre = Mnre::select('name','email')->where('id',1)->first();
            $data['name']=$mnre->name;
            $data['email']=$mnre->email;
            $data['applicationNo']=$applicationNo;
            $this->sendMail('notifyMNREApplicationSubmission', $data, $data['email'], 'Received New Application. Application No. : '.$applicationNo);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }

    }

    public function notifyGeneralizedEmail($type,$data,$userid=NULL)
    {
        try {
            //code...
            if($type=='User'){
                $user = User::select('name','email')->where('id',$userid)->first();
                $data['name']=$user->name;
                $data['email']=$user->email;
                $emailFile='notifyGeneralizedEmail';
            }elseif ($type=='Nise') {
                $nise = Nise::select('name','email')->where('id',1)->first();
                $data['name']=$nise->name;
                $data['email']=$nise->email;
                $emailFile='notifyGeneralizedEmail';
                # code...
            }else{
                $mnre = Mnre::select('name','email')->where('id',1)->first();
                $data['name']=$mnre->name;
                $data['email']=$mnre->email;
                $emailFile='notifyGeneralizedEmail';
            }
            //dd($data);
            $this->sendMail($emailFile, $data, $data['email'], $data['subject']);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }

    }
    
}