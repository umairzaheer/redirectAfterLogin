<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

          Gate::define('isBasic', function($user) {
            return $user->plan_id == 1;
        });
        Gate::define('isBasicAnnual', function($user) {
            return $user->plan_id == 2;
        });
        Gate::define('isStandard', function($user) {
            return $user->plan_id == 3;
        });

        Gate::define('isStandardAnnual', function($user) {
            return $user->plan_id == 4;
        });
    }
}
