<?php

namespace DogTeam\SendinBlue\Providers;

use Illuminate\Support\ServiceProvider;

class SendinBlueServiceProvider extends ServiceProvider{
    public function boot()
    {
        $this->app->bind('zammad', function(){
            return new Dogteam\Sendinblue\SMTP;
        });
    }

    public function register()
    {

    }
}