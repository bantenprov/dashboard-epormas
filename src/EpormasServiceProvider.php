<?php namespace Bantenprov\DashboardEpormas;

use Illuminate\Support\ServiceProvider;
use Bantenprov\DashboardEpormas\Console\Commands\EpormasCommand;

/**
 * The EpormasServiceProvider class
 *
 * @package Bantenprov\DashboardEpormas
 * @author  Esza Herdi <unme.loved@gmail.com>
 */
class EpormasServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Bootstrap handles
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->migrationHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('epormas', function ($app) {
            return new Epormas;
        });

        $this->app->singleton('command.epormas', function ($app) {
            return new EpormasCommand;
        });

        $this->commands('command.epormas');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'epormas',
            'command.epormas',
        ];
    }

    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
    }

    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/config/config.php';
        $appConfigPath     = config_path('epormas.php');

        $this->mergeConfigFrom($packageConfigPath, 'epormas');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');
    }

    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'epormas');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/epormas'),
        ], 'lang');
    }

    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/resources/assets/components';
        $this->publishes([
            $packageViewsPath => resource_path('assets/components'),
        ], 'views');
    }

    protected function migrationHandle()
    {
        $packageMigrationsPath = __DIR__.'/database/migrations';
        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], 'migrations');
    }
}
