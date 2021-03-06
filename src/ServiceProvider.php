<?php
/**
 * @copyright Copyright (c) 2016 Canis.io
 * @license   MIT
 */

namespace Canis\Lumen\Jwt;

use Auth;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    private $jwt;

    public function boot()
    {
        $this->app->configure('jwt');
        Auth::extend('jwt', function($app, $name, array $config) {
            $guard = new Guard($name, Auth::createUserProvider($config['provider']), $app['request'], $config);
            $app->refresh('request', $guard, 'setRequest');
            return $guard;
        });
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
