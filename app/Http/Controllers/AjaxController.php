<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Traits\General;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\Consumer;
use App\Models\ConsumerBankDetails;
use Illuminate\Http\Request;
use App\Models\ApplicationDetail;

use Session, DB, Storage;

class AjaxController extends Controller
{
    use General;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Session::token() !== $request->header('X-CSRF-TOKEN'))
                abort(419);
            return $next($request);
        });
    }
    
    public function getDistrictsByState($state)
    {
        $districts = District::getDistictByState($state);
        return $districts;
    }

    public function getSubDistrictsByDistrict($district)
    {
        $subdistricts = SubDistrict::getSubDistictByDistrict($district);
        return $subdistricts;
    }

    public function fetchSubDistrictsByVillage($village)
    {
        $subdistricts = SubDistrict::getSubDistictByVillage($village);
        return $subdistricts;
    }

    public function fetchDistrictBySubDiscrict($subDistrict)
    {
        $districts = District::getDistictBySubDistrict($subDistrict);
        return $districts;
    }

    public function fetchStateByDiscrict($district)
    {
        $states = State::getStateByDistrict($district);
        return $states;
    }

    public function setOrEditPriority($systemId, $priority)
    {
        try {
            $isUpdated = Installation::where('id', $systemId)->update(['priority' => $priority]);
            if($isUpdated)
                return 'SUCCESS';
            else
                return 'FAILED';
        } 
        catch (\Throwable $th) {
            return $th;
        }
    }
    public function getLocation($address){
        $address = str_replace(' ', '+', $address);
        $latLong = $this->getGeoCode($address);
        echo $latLong;die;
    }
    public function fetchApplicationDetailsById($appid){
        $appdata = ApplicationDetail::select('application_no','plant_address','plant_latitude','plant_longitude','manufacturer_name',
        'manufacturing_capacity','authorize_name','authorize_designation')
        ->where('id',$this->decodeid($appid))->first();
        return $appdata;
    }
    public function addEditSystem(Request $request)
    {
        try {
            Installation::where('id', $request->systemId)->update([
                'installation_status' => 3,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'construction_start_date' => date('Y-m-d', strtotime($request->construction_start_date)),
                'completion_date' => date('Y-m-d', strtotime($request->completion_date)),
                'biogas_model' => $request->biogas_model,
                'capacity' => $request->capacity,
                'onm_routines_schedule' => date('Y-m-d', strtotime($request->onm_routines_schedule)),
                'agreement_date' => date('Y-m-d', strtotime($request->agreement_date)),
                'toilet_status' => $request->toilet_status,
            ]);

            $dir_path = 'systems\\'.$request->consumerId.'\\installation\\';
            Storage::disk('filestore')->makeDirectory($dir_path);

            $bankDetails = [
                'bank_name' => $request->bank_name,
                'branch_address' => $request->branch_address,
                'account_no' => $request->account_no,
                'account_type' => $request->account_type,
                'ifsc_code' => $request->ifsc_code,
                'branch_code' => $request->branch_code,
                'micr_code' => $request->micr_code,
            ];

            if($request->hasFile('bank_passbook')){
                $bankDetails['bank_passbook'] = json_encode($this->uploadFile($request->file('bank_passbook'), $dir_path));
            }

            $consumerId = Consumer::where('consumer_id', $request->consumerId)->value('id');
            if(ConsumerBankDetails::where('consumer_id', $consumerId)->first())
                ConsumerBankDetails::where('consumer_id', $consumerId)->update($bankDetails);
            else {
                $bankDetails['consumer_id'] = $consumerId;
                ConsumerBankDetails::create($bankDetails);
            }

            return $request->systemId;
        } 
        catch (\Exception $e) {
            return $e;
        }
    }
    public function tokencsrf_token_regerate(){
		session()->regenerate();
		return response()->json(["token"=>csrf_token()], 200);
	}
    public function generateToken($token){
        try {
            //code...
            Session::put('token', $token);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        
    }


    




}