<?php namespace JildertMiedema\LaravelPlupload;

use Illuminate\Support\ServiceProvider;

class LaravelPluploadServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['plupload'] = $this->app->share(function($app)
        {
            return $app->make('JildertMiedema\LaravelPlupload\Manager', array('request' => $app['request']));
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../public/assets' => public_path('vendor/jildertmiedema/laravel-plupload/'),
        ], 'public');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}