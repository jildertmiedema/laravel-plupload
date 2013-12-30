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
            return $app->make('JildertMiedema\LaravelPlupload\Manager', ['request' => $app['request']]);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}