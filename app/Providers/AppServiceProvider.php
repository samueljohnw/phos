<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('*', function($view){
          View::share('viewName', $view->getName());
      });
      if ($this->app->environment('production')) {
          $this->app->register(\Jenssegers\Rollbar\RollbarServiceProvider::class);
      }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
