<?php

namespace InfyOm\ArgonTemplates;

use Illuminate\Support\ServiceProvider;

class ArgonTemplatesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../install/theme/' => public_path('theme'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../install/resources/' => resource_path('resources'),
        ], 'resources');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
