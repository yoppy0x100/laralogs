<?php 

namespace Yoppy0x100\LaraLogs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class LaraLogsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('laralogs', function ($app) {
            return new LaraLogs($app['request']->server());
        });

        $this->app->alias('laralogs', LaraLogs::class);
    }

    public function boot()
    {
        $this->publishes([__DIR__ . '/logs.php' => config_path('logs.php')], 'config');

        if (!class_exists('Logs')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__ . '/migration/2023_07_11_181923_laralogs.php.stub' => database_path("/migrations/{$timestamp}_create_laralogs_table.php")
            ], 'migrations');
        }
    }

    public function provides()
    {
        return [LaraLogs::class];
    }
}