<?php declare(strict_types=1);

namespace Formularium\Laravel;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Formularium\Laravel\Console\Commands\CommandDatatype::class
            ]);
        }
    }
}
