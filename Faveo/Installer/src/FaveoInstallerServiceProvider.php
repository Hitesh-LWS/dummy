<?php

namespace Faveo\Installer;

use Faveo\Installer\Http\Middleware\CanInstall;
use Faveo\Installer\Http\Middleware\CanUpdate;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class FaveoInstallerServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'installer');
        $this->loadMigrationsFrom(__DIR__ . 'Database/migrations');
        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function register()
    {
        $this->publishFiles();

        foreach (glob(app_path('Helpers') . '/*.php') as $file) {
            require_once($file);
        }

        parent::register(); // TODO: Change the autogenerated stub
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/Config/installer.php' => base_path('config/installer.php'),
        ], 'faveo-installer');

        $this->publishes([
            __DIR__ . '/Config/languages.php' => base_path('config/language.php'),
        ], 'faveo-installer');

        $this->publishes([
            __DIR__ . '/assets' => public_path('installer'),
        ], 'faveo-installer');

        $this->publishes([
            __DIR__ . '/resources/views' => base_path('resources/views/vendor/installer'),
        ], 'faveo-installer');

        $this->publishes([
            __DIR__ . '/Lang' => base_path('resources/lang'),
        ], 'faveo-installer');

        $this->publishes([
            __DIR__ . '/Storage' => base_path('storage'),
        ],'faveo-installer');

        $this->publishes([
            __DIR__ . '/Helpers/functions.php' => base_path('Helpers/functions.php'),
        ],'faveo-installer');

    }
}
