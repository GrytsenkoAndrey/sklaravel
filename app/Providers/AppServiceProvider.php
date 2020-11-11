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
        #\View::composer();
        view()->composer('layout.aside', function ($view) {
            $view->with('tagsCloud', \App\Tag::tagsCloud());
        });
    }
}
