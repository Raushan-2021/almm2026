<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiogasModel extends Model
{
    protected $table = 'biogas_models';

    public static function getAllBiogasModels()
    {
        return self::all();
    }
}
