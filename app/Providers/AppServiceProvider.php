<?php

namespace App\Providers;

use App\Models\Management;
use App\Models\Subscription;
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
      $energia =   Management::whereName('CONSTRUCCION ENERGIA')->with('tasks')->first();
      $energia_tasks = [

      ];

    }
}
