<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationStatus extends Model
{
    public static function getAllStatuses()
    {
        return self::all();
    }
}
