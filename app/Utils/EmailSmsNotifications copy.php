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

    public function notifyAgencyRegistration($email, $password, $uniqueId, $agencyName)
    {
        try{
            $data['password'] = $password;
            $data['unique_id'] = $uniqueId;
            $data['agency_name'] = $agencyName;
            $this->sendMail('notifySNARegistration', $data, $email, 'Biogas Application Portal: Implementing Agency Registration Successful');
        }
            catch(\Exception $e){
            Log::info($e);
        }
    }
    
    
    //For ALMM
    public function notifyManufacturerRegistration($email, $password, $uniqueId, $name)
    {
        try{
            $data['password'] = $password;
            //$data['unique_id'] = $uniqueId;
            $data['name'] = $name;
            $this->sendMail('notifyAlmmRegistration', $data, $email, 'ALMM Application Portal: Manufacturer Registration Successful');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyManufacturerFinalSubmission($applicationId)
    {
        try{
            $applicationdata = ApplicationDetail::select('application_no','manufacturing_capacity','manufacturer_users.name as manufatur_name','manufacturer_users.email')
                                        ->where('application_details.id', $applicationId)
                                        ->leftjoin('manufacturer_users','manufacturer_users.id','application_details.user_id')
                                        ->first();
            
            $data['manufatur_name'] = $applicationdata['manufatur_name'];
            $data['application_no'] = $applicationdata['application_no'];
            $data['manufacturing_capacity'] = $applicationdata['manufacturing_capacity'];
            $this->sendMail('notifyManufacturerFinalSubmission', $data, $applicationdata['email'], 'ALMM Application Portal: Final Submission ['.$applicationdata['application_no'].']');
        }
        catch(\Exception $e){
            Log::info($e);
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
            }elseif ($type=='Nise') {
                $nise = Nise::select('name','email')->where('id',1)->first();
                $data['name']=$nise->name;
                $data['email']=$nise->email;
                # code...
            }else{
                $mnre = Mnre::select('name','email')->where('id',1)->first();
                $data['name']=$mnre->name;
                $data['email']=$mnre->email;
            }
            //dd($data);
            $this->sendMail('notifyGeneralizedEmail', $data, $data['email'], $data['subject']);
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th);
        }

    }
}