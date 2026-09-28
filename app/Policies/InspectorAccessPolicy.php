<?php

namespace App\Policies;

use App\Models\StateImplementingAgencyUser;
use App\Models\Inspector;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectorAccessPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {}

    public function inspectordetail(StateImplementingAgencyUser $sia, Inspector $inspector)
    {
        return $sia->state_id === $inspector->state_id;
    }
}
