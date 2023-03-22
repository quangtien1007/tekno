<?php

namespace App\Providers;

use App\View\Composers\NavComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        View::composer('layouts.client', NavComposer::class);
        View::composer('client.sanpham', NavComposer::class);
    }
}
