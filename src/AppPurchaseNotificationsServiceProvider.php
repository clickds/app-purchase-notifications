<?php

namespace ClickDs\AppPurchaseNotifications;

use Illuminate\Support\ServiceProvider;

class AppPurchaseNotificationsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'app-purchase-notifications');
    }

    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('app-purchase-notifications.php'),
            ], 'config');
        }
    }
}
