<?php

namespace App\Providers;

use Godruoyi\Snowflake\LaravelSequenceResolver;
use Godruoyi\Snowflake\Snowflake;
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
        $this->app->singleton('snowflake', function ($app) {
            return (new Snowflake(1, 1))
                ->setStartTimeStamp(strtotime('2023-05-24') * 1000)
                ->setSequenceResolver(new LaravelSequenceResolver($app->get('cache.store')));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
