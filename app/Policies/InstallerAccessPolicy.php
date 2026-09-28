<?php

namespace App\Policies;

use App\Models\StateImplementingAgencyUser;
use App\Models\Installer;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallerAccessPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {}

    public function installerdetail(StateImplementingAgencyUser $sia, Installer $installer)
    {
        return $sia->state_id === $installer->state_id;
    }
}
