<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('security', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('user', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('user.add', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('user.edit', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('user.delete', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('user.detail', function ($user) {
            return in_array($user->role, ['Developer']);
        });

        Gate::define('master', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('city', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('city.add', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('city.edit', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('city.delete', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('city.detail', function ($user) {
            return in_array($user->role, ['Developer']);
        });

        Gate::define('laporan', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('laporan.add', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('laporan.edit', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('laporan.delete', function ($user) {
            return in_array($user->role, ['Developer']);
        });
        Gate::define('laporan.detail', function ($user) {
            return in_array($user->role, ['Developer']);
        });
    }
}
