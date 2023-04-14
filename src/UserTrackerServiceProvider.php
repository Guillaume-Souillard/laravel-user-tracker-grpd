<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class UserTrackerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->app['router']->aliasMiddleware('source.user_tracker_grpd', SourceMiddleware::class);
        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::prefix('ut')
            ->middleware(['web', 'auth'])
            ->namespace('Guillaumesouillard\UserTrackerGrpd\Http\Controllers')
            ->group(function () {
                Route::post('/increment/buy', 'UserTrackerCampaignController@incrementBuyTotal')->name('ut.increment.buy');
            });
    }

    public function register()
    {
    }
}