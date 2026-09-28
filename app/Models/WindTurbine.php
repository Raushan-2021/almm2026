<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Module;

class WindTurbine extends Model
{
    //
    protected $table="wind_turbine_parts";

    protected $fillable = [
    'application_id',
    'user_id',
    'wind_turbine_part',
    'wind_turbine_model',
    'mfg_facility_no',
    'nacelle_address', // or 'location_details' depending on DB column
];




}