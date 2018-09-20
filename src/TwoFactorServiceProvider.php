<?php
/**
 *
 * User: aitspeko
 * Date: 19/09/2018
 * Time: 17:17
 *
 * Project: lumen-2fa
 */

namespace Lshtmweb\Lumen2FA;


use GuzzleHttp\Middleware;
use Illuminate\Support\ServiceProvider;

class TwoFactorServiceProvider extends ServiceProvider
{
        public function boot()
        {
                $this->loadMigrationsFrom(__DIR__ . '/migrations');
                $this->publishes([
                    __DIR__ . '/config/lumen2fa.php' => config_path('lumen2fa.php'),
                ]);

                $router = $this->app['router']->pushMiddlewareToGroup('lumen2fa', Middleware::class);

        }
}