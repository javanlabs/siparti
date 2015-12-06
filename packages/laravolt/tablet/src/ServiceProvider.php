<?php

namespace Laravolt\Tablet;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class PackageServiceProvider
 *
 * @package Laravolt\Tablet
 * @see http://laravel.com/docs/5.1/packages#service-providers
 * @see http://laravel.com/docs/5.1/providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/5.1/providers#deferred-providers
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @see http://laravel.com/docs/5.1/providers#the-register-method
     * @return void
     */
    public function register()
    {
        $this->app->bind('tablet', function ($app) {
            return new Builder();
        });
    }

    /**
     * Application is booting
     *
     * @see http://laravel.com/docs/5.1/providers#the-boot-method
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerConfigurations();
    }

    /**
     * Register the package views
     *
     * @see http://laravel.com/docs/5.1/packages#views
     * @return void
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('resources/views'), 'tablet');
        // allow views to be published to the storage directory
        $this->publishes([
            $this->packagePath('resources/views') => base_path('resources/views/laravolt/tablet'),
        ], 'views');
    }

    /**
     * Register the package configurations
     *
     * @see http://laravel.com/docs/5.1/packages#configuration
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/config.php'), 'tablet'
        );
        $this->publishes([
            $this->packagePath('config/config.php') => config_path('tablet.php'),
        ], 'config');
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__, $path);
    }
}
