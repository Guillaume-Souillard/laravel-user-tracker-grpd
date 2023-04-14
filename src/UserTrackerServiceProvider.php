<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Illuminate\Support\ServiceProvider;

class UserTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app['router']->aliasMiddleware('source.user_tracker_grpd', SourceMiddleware::class);
    }

    public function register()
    {
    }
}