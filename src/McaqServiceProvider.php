<?php

namespace edgewizz\mcaq;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class McaqServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Edgewizz\Mcaq\Controllers\McaqController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // dd($this);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadViewsFrom(__DIR__ . '/components', 'mcaq');
        Blade::component('mcaq::mcaq.open', 'mcaq.open');
        Blade::component('mcaq::mcaq.edit', 'mcaq.edit');
        Blade::component('mcaq::mcaq.index', 'mcaq.index');
    }
}
