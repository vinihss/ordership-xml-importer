<?php

namespace App\Providers;

use App\Jobs\ProcessPeopleFile;
use App\Services\PeopleFileProcessor;
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
        $this->app->bindMethod([ProcessPeopleFile::class, 'handle'], function ($job, $app) {
            return $job->handle($app->make(PeopleFileProcessor::class));
        });
    }
}
