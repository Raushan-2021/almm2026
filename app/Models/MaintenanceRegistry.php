<?php

namespace App\Models;

use App\Models\Installation;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\StateImplementingAgencyUser;

class MaintenanceRegistry extends Model
{
    protected $fillable = [
        'request_code',
        'scheduled_date',
        'maintenance_date',
        'system_id',
        'installer_id',
        'type',
        'request_note',
        'maintenance_code',
        'images',
        'description',
        'status'
    ];
    public static function createONMRegistry($systemId, $type, $scheduled, $note = NULL)
    {
        $installation  = Installation::select([
                                            'states.short_name as state_code',
                                            'installations.onm_routines_schedule',
                                            'installations.installer_id'
                                        ])->where('installations.id', $systemId)
                                        ->join('consumers','consumers.id','installations.consumer_id')
                                        ->join('states','states.code','consumers.state_id')
                                        ->first();
        self::create([
            'request_code' => self::generateCode($installation->state_code, 'MREQ'),
            'scheduled_date' => date('Y-m-d', strtotime($scheduled)),
            'system_id' => $systemId,
            'installer_id' => $installation->installer_id,
            'type' => $type,
            'request_note' => $note,
            'maintenance_code' => NULL,
            'images' => NULL,
            'description' => NULL
        ]);
    }
    protected static function generateCode($state, $prefix)
    {
        return $prefix.'-'.$state.'-'.date('Ymd').'-'.rand(10,100);
    }
    public static function getMaintenanceRegistries($installerId = NULL, $siaId = NULL)
    {
        $records = [];
        $query = Installation::where('installations.installation_status', 10)
                                ->join('consumers','consumers.id','installations.consumer_id');

        if($installerId)
            $query->where('installations.installer_id', $installerId);

        if($siaId){
            $stateId = StateImplementingAgencyUser::where('id', $siaId)->value('state_id');
            $query->where('consumers.state_id', $stateId);
        }

        $records = $query->get();

        return $records;
    }
    public static function getMaintenanceLists($request, $status)
    {
        $query = self::select([
                                'maintenance_registries.id AS maintenance_id',
                                'maintenance_registries.request_code as maintenance_register_code',
                                'consumers.name AS consumer_name',
                                'consumers.village AS village',
                                'states.name AS state_name',
                                'districts.name AS district_name',
                                'sub_districts.name AS sub_district_name',
                                'maintenance_registries.scheduled_date',
                                'maintenance_registries.maintenance_date',
                                'installers.installer_id'
                            ])
                            ->where('maintenance_registries.installer_id', $request->user['id'])
                            ->where('maintenance_registries.status', $status)
                            ->leftjoin('installations', 'installations.id', 'maintenance_registries.system_id')
                            ->leftjoin('consumers', 'consumers.id', 'installations.consumer_id')
                            ->leftjoin('installers','installers.id','maintenance_registries.installer_id')
                            ->leftjoin('states','states.code','consumers.state_id')
                            ->leftjoin('districts','districts.code','consumers.district_id')
                            ->leftjoin('sub_districts','sub_districts.code','consumers.sub_district_id');

        $count = $query->count();
        if(!empty($params->limit))
            $query->limit($params->limit)->offset($params->offset);

        $query->orderBy('maintenance_registries.updated_at','DESC');

        $installations = $query->get()->map(function($installation){
            $installation->scheduled_date = !empty($installation->scheduled_date) ? date('d M Y', strtotime($installation->scheduled_date)) : NULL;
            $installation->maintenance_date = !empty($installation->maintenance_date) ? date('d M Y', strtotime($installation->maintenance_date)) : NULL;
            return $installation;
        });

        return ['count' => $count, 'maintenances' => $installations];
    }
    
    public static function getMaintenanceSystems($installerId = null, $siaId = null, $state = null)
    {
        $query = Installation::where('installations.installation_status', 10)
                            ->join('installers','installers.id','installations.installer_id')
                            ->join('consumers','consumers.id','installations.consumer_id')
                            ->join('states','states.code','consumers.state_id')
                            ->select(
                                'installations.id',
                                'installations.bpmr_no',
                                'installers.installer_id',
                                'consumers.name as consumer_name',
                                'states.name as state_name'
                            );

        if($installerId)
            $query->where('installations.installer_id', $installerId);
            
        if($siaId){
            $stateId = StateImplementingAgencyUser::where('id', $siaId)->value('state_id');
            $query->where('consumers.state_id', $stateId);
        }

        if($state)
            $query->where('consumers.state_id', $state);

        return $query->get()->map(function($installation){
            $installation->pending = self::where([['system_id', $installation->id],['status', 0]])->count();
            $installation->complete = self::where([['system_id', $installation->id],['status', 1]])->count();
            return $installation;
        });
    }

    public static function getMaintenanceBySystemId($id){
        $query = self::where('maintenance_registries.system_id', $id)
                        ->join('installations','installations.id','maintenance_registries.system_id')
                        ->join('installers','installers.id','maintenance_registries.installer_id')
                        ->select([
                            'maintenance_registries.id AS maintenance_id',
                            'maintenance_registries.request_code',
                            'maintenance_registries.scheduled_date',
                            'maintenance_registries.maintenance_date',
                            'maintenance_registries.type as maintenance_type',
                            'maintenance_registries.status',
                            'installations.id as systemId',
                            'installations.bpmr_no',
                            'installers.installer_id as installer_id',
                        ]);

        $query->orderby('maintenance_registries.updated_at', 'DESC');
        return $query->get();
    }

    public static function getMaintenanceById($id){
        $query = self::where('maintenance_registries.id', $id)
                ->join('installations','installations.id','maintenance_registries.system_id')
                ->join('installers','installers.id','maintenance_registries.installer_id')
                ->join('consumers','consumers.id','installations.consumer_id')
                ->join('states','states.code','consumers.state_id')
                ->select([
                    'maintenance_registries.*',
                    'installations.id as systemId',
                    'installations.bpmr_no',
                    'installers.installer_id as installer_id',
                    'consumers.consumer_id as consumer_code',
                    'consumers.state_id',
                    'states.short_name as state_code',
                    'installers.id as installer_prim_key'
                ]);

        return $query->first();
    }
}
