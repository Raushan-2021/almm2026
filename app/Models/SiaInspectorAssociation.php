<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiaInspectorAssociation extends Model
{
    protected $table = 'sia_inspectors_association';

    public static function getAssociatedInspectors($siaID)
    {
        $inspectors = self::select('inspectors.id','inspectors.name')
                            ->where([['sia_inspectors_association.state_implementing_agency_user_id', $siaID],['inspectors.blacklist', 0]])
                            ->join('inspectors','inspectors.id','sia_inspectors_association.inspector_id')
                            ->get();

        return $inspectors;
    }
}