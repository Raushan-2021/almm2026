<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
        $allowed_host = array('almm.mnre.gov.in','https://almm.mnre.gov.in','164.100.55.59');

        if (!isset($_SERVER['HTTP_HOST']) || !in_array($_SERVER['HTTP_HOST'], $allowed_host))
        {
          /*   header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
             exit; */
        }
             
    }
}
