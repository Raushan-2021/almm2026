<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Consumer extends Authenticatable
{
    use Notifiable;
    protected $table='users';
    protected $fillable = [
                    'name',
                    'consumer_id',
                    'installer_id',
                    'email',
                    'phone',
                    'aadhar_no',
                    'house_no',
                    'village',
                    'post',
                    'panchayat',
                    'block',
                    'ward_no',
                    'sub_district_id',
                    'state_id',
                    'district_id',
                    'toilet_linked',
                    'existing_biogas_plant',
                    'subsidy_availed',
                    'number_of_cattle',
                    'comment',
                    'date_of_reg',
                    'category'
                ];

    public static function getAll($state = null, $status = null, $priority = null)
    {
        $query = self::select('consumers.*', 'states.name as state', 'installers.name as installer', 'installations.priority', 'installations.id as installationId')
                        ->join('states', 'states.code', 'consumers.state_id')            
                        ->leftjoin('installers', 'installers.id', 'consumers.installer_id')
                        ->leftjoin('installations', 'installations.consumer_id', 'consumers.id');
            //  dd($query);
        switch($status){
            case 'approved': $query->where('consumers.is_approved', 1); break;
            case 'rejected': $query->where('consumers.is_approved', 0); break;
            case 'pending': $query->whereNull('consumers.is_approved'); break;
        }
        

        if($priority)
            $query->where('installations.priority', $priority);

        if($state !== null)
            $query->where('consumers.state_id', $state);


        $query->orderby('consumers.updated_at', 'DESC');

        return $query->get();
        
    }

    public static function getById($state = null, $status = null, $id)
    {
        $query = self::join('sub_districts', 'sub_districts.code', 'consumers.sub_district_id')
                    ->join('districts', 'districts.code', 'consumers.district_id')
                    ->join('states', 'states.code', 'consumers.state_id')
                    ->leftjoin('installers', 'installers.id', 'consumers.installer_id')
                    ->leftjoin('installations', 'installations.consumer_id', 'consumers.id')
                    ->select(
                        'consumers.*',
                        'sub_districts.name as sub_district',
                        'districts.name as district',
                        'states.name as state',
                        'installers.name as installer',
                        'installations.installer_id as installerId',
                        'installations.priority',
                        'installations.id as installationId'
                    )
                    ->where('consumers.id', $id);
        if($status == 'approved'){
            $query->where('consumers.is_approved', 1);
        }

        if($state !== null){
            $query->where('consumers.state_id', $state);
        }

        return $query->first();
    }
}
