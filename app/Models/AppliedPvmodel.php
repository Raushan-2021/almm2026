<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedPvmodel extends Model
{
    //
    //protected $table="applied_pvmodels";
    protected $fillable = [
        'application_id', 'user_id', 'technology','no_pv_models','pmax'
    ];
    
    
}
