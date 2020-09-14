<?php

namespace App\Providers;

use App\Contracts\CardCheckerInterface;
use App\Contracts\CountryCheckerInterface;
use App\Contracts\FileParserInterface;
use App\Contracts\RateCheckerInterface;
use App\Services\CardChecker;
use App\Services\CountryChecker;
use App\Services\FileParser;
use App\Services\RateChecker;
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
        $this->app->bind(
            CardCheckerInterface::class,
            CardChecker::class
        );
        $this->app->bind(
            RateCheckerInterface::class,
            RateChecker::class
        );
        $this->app->bind(
            CountryCheckerInterface::class,
            CountryChecker::class
        );
        $this->app->bind(FileParserInterface::class, FileParser::class);
    }
}
