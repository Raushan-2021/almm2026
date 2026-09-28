<?php

namespace App\Policies;

use App\Models\StateImplementingAgencyUser;
use App\Models\MaintenanceRegistry;
use App\Models\Installer;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintenancePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {}

    public function siamaintenances(StateImplementingAgencyUser $sia, MaintenanceRegistry $maintenance)
    {
        return $sia->state_id === $maintenance->state_id;
    }

    public function installerMaintenance(Installer $installer, MaintenanceRegistry $maintenance)
    {
        return $installer->id === $maintenance->installer_prim_key;
    }
}
