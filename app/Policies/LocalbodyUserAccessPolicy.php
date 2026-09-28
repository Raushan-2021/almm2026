<?php

namespace App\Policies;

use App\Models\StateImplementingAgencyUser;
use App\Models\LocalbodyUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocalbodyUserAccessPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {}

    public function localbodydetail(StateImplementingAgencyUser $sia, LocalbodyUser $localbody)
    {
        return $sia->id === $localbody->superior_agency;
    }
}
