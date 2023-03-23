<?php

namespace Todocoding\Orgamax;

use Illuminate\Support\ServiceProvider;

class OrgamaxServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/orgamax.php' => config_path('orgamax.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('orgamax', function () {
            return new Orgamax();
        });
    }
}
