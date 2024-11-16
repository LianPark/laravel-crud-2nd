<?php

namespace Lianpark\Board;

use Illuminate\Support\ServiceProvider;
use Lianpark\Board\Http\Middleware\Test;
use Lianpark\Board\Http\Middleware\Localization;

class BoardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
          __DIR__.'/config/lalaboard.php' => config_path('lalaboard.php'),
        ]);

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'board');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // middleware 추가
        // https://eoghanobrien.com/posts/defining-laravel-middleware-from-inside-a-composer-package
        $router = $this->app['router'];
        //$router->pushMiddlewareToGroup('web', Test::class);
        $router->pushMiddlewareToGroup('web', Localization::class);

        // 다국어관련
        $this->loadTranslationsFrom(__DIR__.'/lang', 'board');
        // $this->publishes([
        //     __DIR__.'/../lang' => $this->app->langPath('vendor/courier'),
        // ]);
    }
}
