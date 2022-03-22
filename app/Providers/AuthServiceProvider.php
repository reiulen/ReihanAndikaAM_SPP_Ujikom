<?php

namespace App\Providers;

use App\Models\Petugas;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('admin', function (Petugas $petugas) {
            return $petugas->level === 'Admin';
        });
        Gate::define('petugas', function (Petugas $petugas) {
            return $petugas->level === 'Petugas';
        });
    }
}
