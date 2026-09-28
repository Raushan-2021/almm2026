<?php

namespace App\Policies;

use App\Models\StateImplementingAgencyUser;
use App\Models\Consumer;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConsumerAccessPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {}

    public function siaconsumers(StateImplementingAgencyUser $sia, Consumer $consumer)
    {
        return $sia->state_id === $consumer->state_id;
    }
}
