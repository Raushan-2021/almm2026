<?php

namespace App\Policies;

use App\Models\Installation;
use App\Models\Installer;
use App\Models\Inspector;
use App\Models\MaintenanceRegistry;
use App\Models\Inspection;

class ApiPolicy
{
    public function __construct()
    {}

    public function verifyInstallationOwner($installerId, $installationId)
    {
        if(Installation::where([['id', $installationId],['installer_id', $installerId]])->first()) return FALSE;
        else return TRUE;
    }
    public function verifyMaintenanceOwner($installerId, $maintenanaceId)
    {
        if(MaintenanceRegistry::where([['id', $maintenanaceId],['installer_id', $installerId]])->first()) return FALSE;
        else return TRUE;
    }
    public function verifyInspectionOwner($inspectorId, $inspectionId)
    {
        if(Inspection::where([['id', $inspectionId],['inspector_id', $inspectorId]])->first()) return FALSE;
        else return TRUE;
    }
}
