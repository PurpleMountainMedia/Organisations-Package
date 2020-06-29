<?php

namespace PurpleMountain\Organisations;

use PurpleMountain\Organisations\Providers\EventServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\FileSystem\FileSystem;

class ServiceProvider extends BaseServiceProvider
{
    /** 
     * Put together the path to the config file.
     *
     * @return string
     */
    private function configPath(): string
    {
        return __DIR__.'/../config/' . $this->shortName() . '.php';
    }

    /** 
     * Get the short name for this package.
     *
     * @return string
     */
    private function shortName(): string
    {
        return 'organisations';
    }


    /**
     * Bootstrap the package.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleRoutes();
        $this->handleConfigs();

        if (env('APP_ENV') === 'local') {
            $this->handleMigrations();
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                //
            ]);
        }
    }

    /**
     * Register anything this package needs.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), $this->shortName());

        $this->app->register(EventServiceProvider::class);
    }

    /** 
     * Register any migrations.
     *
     * @return void
     */
    private function handleMigrations()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/2020_06_04_191936_create_organisations_table.php.stub' => database_path('migrations/2020_06_04_191936_create_organisations_table.php')
        ], $this->shortName() . '-migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/2020_06_04_195750_create_organisation_user_table.php.stub' => database_path('migrations/2020_06_04_195750_create_organisation_user_table.php')
        ], $this->shortName() . '-migrations');
    }

    /** 
     * Register any routes this package needs.
     *
     * @return void
     */
    private function handleRoutes()
    {
        Route::group([
            'name' => $this->shortName(),
            'namespace' => 'PurpleMountain\Organisations\Http\Controllers',
            'middleware' => ['web']
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /** 
     * Register any config files this package needs.
     *
     * @return void
     */
    private function handleConfigs()
    {
        $this->publishes([
            $this->configPath(),
            $this->shortName() . '-config'
        ], $this->shortName() . '-config');
    }

}