<?php

namespace App\Providers;

use App\Models\LocalbodyUser;
use App\Models\Installer;
use App\Models\Inspector;
use App\Models\Consumer;
use App\Models\Installation;
use App\Models\MaintenanceRegistry;
use App\Policies\MaintenancePolicy;
use App\Policies\InstallerAccessPolicy;
use App\Policies\InspectorAccessPolicy;
use App\Policies\LocalbodyUserAccessPolicy;
use App\Policies\ConsumerAccessPolicy;
use App\Policies\InstallationAccessPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        LocalbodyUser::class => LocalbodyUserAccessPolicy::class,
        Installer::class => InstallerAccessPolicy::class,
        Inspector::class => InspectorAccessPolicy::class,
        Consumer::class => ConsumerAccessPolicy::class,
        Installation::class => InstallationAccessPolicy::class,
        MaintenanceRegistry::class => MaintenancePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }
}
