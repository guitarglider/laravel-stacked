<?php

namespace Acme\\Stacked;

use Illuminate\\Support\\ServiceProvider;
use Acme\\Stacked\\Console\\InstallCommand;

class LaravelStackedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
