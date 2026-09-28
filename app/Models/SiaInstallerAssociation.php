<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiaInstallerAssociation extends Model
{
    protected $table = 'sia_installers_association';
    public $timestamps = false;
    protected $fillable = [
        'installer_id',
        'state_implementing_agency_user_id',
        'status'
    ];

    public static function getAssociatedInstallers($siaID)
    {
        $inspectors = self::select('installers.id','installers.name')
                            ->where([['sia_installers_association.state_implementing_agency_user_id', $siaID],['sia_installers_association.status', 1]])
                            ->join('installers','installers.id','sia_installers_association.installer_id')
                            ->get();

        return $inspectors;
    }
}