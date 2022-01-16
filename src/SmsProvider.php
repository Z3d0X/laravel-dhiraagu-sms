<?php

namespace Zedox\LaravelDhiraaguSms;

use Illuminate\Support\ServiceProvider;
use Zedox\LaravelDhiraaguSms\Services\DhiraaguSmsService;


class SmsProvider extends ServiceProvider {

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('dhiraagu-sms', function ($app) {
            return new DhiraaguSmsService(
                $app['config']['services.dhiraagu-sms.userid'],
                $app['config']['services.dhiraagu-sms.password'],
                $app['config']['services.dhiraagu-sms.url']
            );
        });
    }


    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
    }
    
}