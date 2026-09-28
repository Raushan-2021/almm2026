<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallationCapacity extends Model
{
    protected $table = 'installation_capacities';

    public static function getAllInstallationCapacities()
    {
        return self::all();
    }
}
