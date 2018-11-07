<?php

namespace Jervenclark\Roles;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Jervenclark\Roles\Models\Permission;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) $this->bootForConsole();
        Permission::get()->map(function($permission){
            Gate::define($permission->slug, function($user) use ($permission){
                return $user->hasPermissionTo($permission);
            });
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/roles.php', 'roles');
        $this->app->singleton('roles', function ($app) {
            return new Roles;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['roles'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/roles.php' => config_path('roles.php'),
        ], 'roles.config');
    }
}
