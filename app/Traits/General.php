<?php
namespace App\Traits;

use Carbon\Carbon;
use App\Models\State;
use App\Models\AuditTrail;
use App\Models\ForwardDetail;
use App\Models\RlmmForwardDetail;
use App\Models\User;
use App\Models\Mnre;
use App\Models\Nise;
use App\Models\ModuleType;
use App\Models\Notification;
use Hashids\Hashids;
use Illuminate\Support\Facades\Crypt;
use DB, File, Mail, Log, Auth;
use Illuminate\Support\Facades\Storage;

trait General
{
    public function log($message, $data)
    {
        Log::info($message." ".$data);
        Log::info("****************************************************************************************************");
    }
    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function print($array=null)
    {
        echo "<pre>";print_r($array);die;
    }

    public function execSP($SP, $params)
    {
        $data = json_decode(json_encode(DB::select('CALL '.$SP, $params)), true);
        return $data;
    }
    
    public function sendMail($emailFile, $data, $email, $subject)
    {
        //dd($data);
        $data['mail_to'] = $email;
        $data['subject'] = $subject;
        Mail::send('emails.'.$emailFile, $data, function($mail) use ($data) {
            $mail->to($data['mail_to'])->subject($data['subject']);
            //if($data['document']){
                // $path =public_path($data['document']);
                // //dd($path);
                // $mail->attach($path, [
                //     'as' => 'abc.pdf',
                //     'mime' => 'application/pdf',
                // ]);
                //$mail->attach($data['document'],'file_'.time().'.pdf');
            //}
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
    }
    public function sendSms($message, $number)
    {
        $message = rawurlencode($message);
        $server = env('SMS_SERVER');
        $username = env('SMS_USERNAME');
        $pin = rawurlencode(env('SMS_PIN'));
        $signature = env('SMS_SIGNATURE');

        $url = 'https://'.$server.'/failsafe/HttpLink?username='.$username.'&pin='.$pin.'&message='.$message.'&mnumber=91'.$number.'&signature='.$signature;

        $connection = curl_init();

        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($connection);
        curl_close($connection);

        if($data)
            return TRUE;
        else
            return FALSE;
    }
    public function passwordPolicyTest($string)
    {
        if(
            preg_match('/(?=[A-Z][^A-Z]*)/', $string) && // Atleast 2 uppercase
            preg_match('/(?=[a-z][^a-z]*)/', $string) && // Atleast 1 lowercase
            preg_match('/(?=[0-9][^0-9]*)/', $string) && // Atleast 1 digit
            preg_match('/(?=[\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E\x80-\xFF][^\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E\x80-\xFF]*)/', $string) // Atleast 2 special characters
        )
            return TRUE;
        else
            return FALSE;
    }

    
    public function encodeid($id){
        if($id!=''){
            $encrypted = Crypt::encryptString($id);
            return $encrypted;
            $hashids = new Hashids('almmnisemnre',10);
            return $hashids->encode($id);
        }
        
    }
    public function decodeid($id){
        if($id!=''){
            $decrypted = Crypt::decryptString($id);
            
            return $decrypted;
            $hashids = new Hashids('almmnisemnre',10);
            if(!empty($hashids->decode($id))){
                return $hashids->decode($id)[0];
            }
            abort('404');
        }
    }
    function getUsernameById($id,$type){
        if($id==0){
            return 'Guest';
        }
        if($type=='MFT'){
            return User::select('name')->where('id',$id)->first()['name'];
        }else if($type=='MNRE'){
            return Mnre::select('name')->where('id',$id)->first()['name'];
        }else if($type=='NISE'){
            return Nise::select('name')->where('id',$id)->first()['name'];
        }else{
            return 'Guest';
        }

    }
    function getTechnologyTitle($id){
        $module=ModuleType::select('module_name')->where('id',$id)->first();
        if($module!=null){
            return $module->module_name;
        }
        return 'NULL';
    }

    public function getApplicationType($type){
        $applicationType='';
        if($type==1){
            $applicationType= 'New Application';
        }else if($type==2){
            $applicationType= 'Addition of Existing Model';
        }else if($type==3){
            $applicationType= 'Application for new manufacturing facility';
        }else if($type==4){
            $applicationType= 'Renewal';
        }elseif($type==5){
            $applicationType= 'Co-ALMM';
        }
        echo $applicationType;
        
    }
    public function uploadFile($file, $dir_path, $prefix='')
    {
        $randomNumber = time();
        $customName = $prefix."_".Auth::user()->id.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
        $imagename = empty($prefix) ? ($this->generateRandomString().'.'.$file->getClientOriginalExtension()) : $customName;
        Storage::disk('filestore')->putFileAs($dir_path, $file, $imagename);
        return !empty($prefix) ? ['name' => $imagename, 'date' => date('Y-m-d')] : $imagename;
    }

    public function uploadFile_bk($file, $dir_path, $withDate = '',$prefix='')
    {
        $randomNumber = rand(1,1990);
        $customName = $prefix."_".Auth::user()->id.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
        $imagename = empty($prefix) ? ($this->generateRandomString().'.'.$file->getClientOriginalExtension()) : $customName;
        dd($imagename);
        Storage::disk('filestore')->putFileAs($dir_path, $file, $imagename);
        return empty($withDate) ? ['name' => $imagename, 'date' => date('Y-m-d')] : $imagename;
    }

    public function generateIdForStakeholders($prefix, $stateCode)
    {
        $state = State::where('code', $stateCode)->value('short_name');
        return $prefix.'-'.$state.'-'.date('Ymd').'-'.rand(10,100);
    }
    function sendSandesOTP($mobile,$message){
        //return array("status" => "error","message" => 'Test Function');
        //return array("status" => "success","message" => 'OTP message has been sent. Please check the Sandes App in the mobile.');
        $message= urlencode($message);
        $agent='Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';
        $url='http://localhost:8021/send?receiverid='.$mobile.'&msg='.$message .'';
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false); //765abcde98
        $curl_output = curl_exec($ch);
        if(curl_errno($ch))
        {
            $status = array("status" => "error","message" => 'Sandes OTP failed to sent message to '.$mobile.' Error:' . curl_error($ch));
        }
        
        curl_close($ch);
        $output = json_decode($curl_output, true);
        if($output['status'] == "success"){
            $status = array("status" => "success","message" => 'OTP message has been sent. Please check the Sandes App in the mobile.');
        }else if($output['status'] == "error"){
            if($output['code'] == "GEN016"){ 
                $status = array("status" => "error","message" => 'Message could not be sent as User is not registered in the Sandes Mobile App. Kindly installed Sandes App in the mobile.');
            }else{
                $status = array("status" => "success","message" => $output['message']);
            }
        }else{
            $status = array("status" => "success","message" => "Message could not sent. Please contact itsupport-mnre@nic.in");
        }
        return $status;     
    }
    //Added By Ekta Mewade on 14 July 2022, 9:51 AM
    public function auditTrail($data){
        $login_user_id = 0;
        $user_id = Auth::id();
        // dd($user_id);
        if(!empty($user_id)){  $login_user_id = $user_id; }
        if(!empty($data['userid'])){  $login_user_id = $data['userid']; }
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
            $browser =  'Internet explorer';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') !== FALSE) //For Supporting IE 11
            $browser =  'Microsoft Edge';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
            $browser =  'Internet explorer';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
            $browser =  'Mozilla Firefox';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
            $browser =  'Google Chrome';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
            $browser =  "Opera Mini";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
            $browser =  "Opera";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
            $browser =  "Safari";
        else
            $browser =  'Something else';
            $auditTrail= new AuditTrail;
            $auditTrail->user_id=$login_user_id;
            $auditTrail->module_name=$_SERVER['REQUEST_URI'];
            $auditTrail->device=$browser;
            $auditTrail->ip_address=$_SERVER['REMOTE_ADDR'];
            $auditTrail->entry_date=date('Y-m-d H:i:s');
            $auditTrail->action_type=$data['action_type'];
            $auditTrail->description=$data['description'];
            $auditTrail->user_type=$data['user_type'];
            $auditTrail->save();
    }
    public function getCurrentDate(){
        date_default_timezone_set('Asia/Kolkata');
        return date('Y-m-d H:i:s');
    }
    public function getDateFormat($date){
        return date('d-m-Y',strtotime($date));
        //return strtotime(date('m-d-Y'),$date);
    }
    
    private function forwardDetail($dataArr)
    {
        
        $applicationdetail = new ForwardDetail();
        $applicationdetail->user_id = Auth::user()->id;
        $applicationdetail->user_type = $dataArr['user_type'];
        $applicationdetail->application_id = $dataArr['application_id'];
        $applicationdetail->action = $dataArr['action'];
        $applicationdetail->description = $dataArr['description'];
        $applicationdetail->save();
    }
    
    private function userNotification($arraydata){
        $notification = new Notification;
        $notification->from_user = Auth::user()->id;
        $notification->from_user_type = Auth::getDefaultDriver();
        $notification->to_user = $arraydata['id'];
        $notification->to_user_type = $arraydata['to_user_type'];
        $notification->notification = $arraydata['message'];
        $notification->status = 0;
        $notification->updated_at = $this->getCurrentDate();
        $notification->created_at = $this->getCurrentDate();
        $notification->save();
    }
    
     
}