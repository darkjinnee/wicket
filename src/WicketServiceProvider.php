<?php

namespace Darkjinnee\Wicket;

use Illuminate\Support\ServiceProvider;
use Darkjinnee\Wicket\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

/**
 * Class WicketServiceProvider
 * @package Darkjinnee\Wicket
 */
class WicketServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'darkjinnee');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'darkjinnee');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/wicket.php', 'wicket');

        // Register the service the package provides.
        $this->app->singleton('wicket', function () {
            return new Wicket;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['wicket'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/wicket.php' => config_path('wicket.php'),
        ], 'wicket.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/darkjinnee'),
        ], 'wicket.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/darkjinnee'),
        ], 'wicket.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/darkjinnee'),
        ], 'wicket.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
