<?php

namespace Tequilarapido\Okta;

use Illuminate\Support\ServiceProvider;

class OktaServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Laravel\Socialite\Contracts\Factory', function ($app) {
            return new SocialiteManager($app);
        });
    }

    /**
     * Boot the service provider
     * Call this method in the boot method in AppServiceProvider.php
     */
    public static function boot()
    {
        Socialite::extend('okta', function ($app) {
            $config = $app['config']['services.okta'];
            $provider = Socialite::buildProvider('Tequilarapido\Okta\OktaProvider', $config);
            $provider->setOktaUrl($config['url']);
            return $provider;
        });
    }
}
