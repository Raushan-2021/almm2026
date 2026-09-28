<?php

namespace App\Policies;

use App\Models\StateImplementingAgencyUser;
use App\Models\Installation;
use App\Models\Installer;
use App\Models\Inspector;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallationAccessPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {}

    public function siainstallations(StateImplementingAgencyUser $sia, Installation $installation)
    {
        return $sia->state_id === $installation->state_id;
    }

    public function installerInstallations(Installer $installer, Installation $installation)
    {
        return $installer->id === $installation->installer_id;
    }

    public function inspectorSystem(Inspector $inspector, Installation $installation)
    {
        return $inspector->id === $installation->inspector_id;
    }
}
