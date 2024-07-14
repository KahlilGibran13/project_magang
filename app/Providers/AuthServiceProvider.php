<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\t_tentang;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('operator', function () {
            return auth()->user()->user_role_id == '1';
        });
        Gate::define('verifikator', function () {
            return auth()->user()->user_role_id == '2';
        });
        Gate::define('birohukum', function () {
            return auth()->user()->user_role_id == '3';
        });
    }
}
