<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\InspectionHistory;
use App\Models\ApplicationDetail;
use App\Models\AwApplicationDetail;

use App\Models\RlmmUser;
use App\Models\RlmmNiwe;
use App\Models\RlmmMnre;

use App\Models\User;

use Auth;

class Dashboard
{
    use General;
    public function __construct(){}
    public function getMNREDashboardData()
    {
        $response = [
            'users' => User::select('id')->count(),
            'application_total' => ApplicationDetail::where('final_submission',1)->count(),
            'forwarded_nise' => ApplicationDetail::where('forward_status','nise')->count(),
            // 'inspection_initiated' => InspectionHistory::distinct()->count('application_id'), //
            'inspection_initiated' => ApplicationDetail::where('status','2')->count(),
            'pending_mnre' => ApplicationDetail::where('status','0')->where('forward_status','mnre')->where('final_submission',1)->count(),
            'pending_nise_verification' => ApplicationDetail::where('status','1')->where('forward_status','nise')->count(),
            'inspection_completed' => ApplicationDetail::where('status','5')->count(),
            'application_in_nise' => ApplicationDetail::where('status','1')->where('forward_status','nise')->count()
        ];
        return $response;
    }

    public function getNISEDashboardData()
    {
        $response = [
            'application_in_nise' => ApplicationDetail::where('status','1')->where('forward_status','nise')->count(),
            'application_total' => ApplicationDetail::where('final_submission',1)->count(),
            'inspection_initiated' => ApplicationDetail::where('status','2')->count(),
            'inspection_completed' => ApplicationDetail::where('status','5')->count(),
        ];
        return $response;
    }

    public function getUSERDashboardData()
    {
        $response = [
            'applications' => ApplicationDetail::where('user_id',Auth::user()->id)->count(),
            'application_submitted' => ApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->count(),
            'application_forwarded_nise' => ApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->where('forward_status','nise')->count(),
            'application_pending_mnre' => ApplicationDetail::where('user_id',Auth::user()->id)->where('status','0')->where('final_submission',1)->where('forward_status','mnre')->count(),
            'application_pending_nise' => ApplicationDetail::where('user_id',Auth::user()->id)->where('status','1')->where('final_submission',1)->where('forward_status','nise')->count(),
            // 'application_inspection_fixed' => InspectionHistory::distinct()->where('user_id',Auth::user()->id)->count('application_id'),
            'application_inspection_fixed' => ApplicationDetail::where('status','2')->where('user_id',Auth::user()->id)->count(),
            'inspection_completed' => ApplicationDetail::where('status','5')->where('user_id',Auth::user()->id)->count(),
        ];
        return $response;
    }
    
    public function getUSERDashboardDataByYear($fromData,$toDate){
        $response = [
            'applications' => ApplicationDetail::where('user_id',Auth::user()->id)->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_submitted' => ApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_forwarded_nise' => ApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->where('forward_status','nise')->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_pending_mnre' => ApplicationDetail::where('user_id',Auth::user()->id)->where('status','0')->where('final_submission',1)->where('forward_status','mnre')->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_pending_nise' => ApplicationDetail::where('user_id',Auth::user()->id)->where('status','1')->where('final_submission',1)->where('forward_status','nise')->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_inspection_fixed' => InspectionHistory::distinct()->where('user_id',Auth::user()->id)->whereBetween('entry_date', [$fromData, $toDate])->count('application_id'),
            'inspection_completed' => ApplicationDetail::where('status','5')->where('user_id',Auth::user()->id)->whereBetween('created_at', [$fromData, $toDate])->count(),
        ];
        return $response;
    }

    

    public function getRLMMUSERDashboardData()
    {
        $response = [
            'applications' => AwApplicationDetail::where('user_id',Auth::user()->id)->count(),
            'application_submitted' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->count(),
            'application_forwarded_niwe' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->where('forward_status','niwe')->count(),
            
            'application_pending_mnre' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('status','1')->where('final_submission',1)->where('forward_status','mnre')->count(),
            'application_pending_niwe' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('status','1')->where('final_submission',1)->where('forward_status','niwe')->count(),
            // 'application_inspection_fixed' => InspectionHistory::distinct()->where('user_id',Auth::user()->id)->count('application_id'),
            'application_inspection_fixed' => AwApplicationDetail::where('status','2')->where('user_id',Auth::user()->id)->count(),
            
            'inspection_completed' => AwApplicationDetail::where('status','5')->where('user_id',Auth::user()->id)->count(),
        ];
        return $response;
    }

    public function getRLMMUSERDashboardDataByYear($fromData,$toDate){
        $response = [
            'applications' => AwApplicationDetail::where('user_id',Auth::user()->id)->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_submitted' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_forwarded_nise' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('final_submission',1)->where('forward_status','niwe')->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_pending_mnre' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('status','0')->where('final_submission',1)->where('forward_status','mnre')->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_pending_nise' => AwApplicationDetail::where('user_id',Auth::user()->id)->where('status','1')->where('final_submission',1)->where('forward_status','niwe')->whereBetween('created_at', [$fromData, $toDate])->count(),
            'application_inspection_fixed' => RlmmInspectionHistory::distinct()->where('user_id',Auth::user()->id)->whereBetween('entry_date', [$fromData, $toDate])->count('application_id'),
            'inspection_completed' => AwApplicationDetail::where('status','5')->where('user_id',Auth::user()->id)->whereBetween('created_at', [$fromData, $toDate])->count(),
        ];
        return $response;
    }


    public function getMNRERLMMDashboardData()
    {
        $response = [
            'users' => RlmmUser::select('id')->count(),
            'application_total' => AwApplicationDetail::where('final_submission',1)->count(),
            'forwarded_niwe' => AwApplicationDetail::where('forward_status','niwe')->count(),
            // 'inspection_initiated' => InspectionHistory::distinct()->count('application_id'), //
            'inspection_initiated' => AwApplicationDetail::where('status','2')->count(),
            'pending_mnre' => AwApplicationDetail::where('status','1')->where('forward_status','mnre')->where('final_submission',1)->count(),
            'pending_niwe_verification' => AwApplicationDetail::where('status','1')->where('forward_status','niwe')->count(),
            'inspection_completed' => AwApplicationDetail::where('status','5')->count(),
            'application_in_niwe' => AwApplicationDetail::where('status','1')->where('forward_status','niwe')->count()
        ];
        return $response;
    }


    public function getNIWEDashboardData()
        {
            $response = [
                'application_in_niwe' => AwApplicationDetail::where('status','1')->where('forward_status','niwe')->count(),
                'application_total' => AwApplicationDetail::where('final_submission',1)->count(),
                'inspection_initiated' => AwApplicationDetail::where('status','2')->count(),
                'inspection_completed' => AwApplicationDetail::where('status','5')->count(),
            ];
            return $response;
        }

}