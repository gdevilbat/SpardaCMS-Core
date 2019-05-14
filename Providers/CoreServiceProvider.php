<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Schema;
use Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware\RedirectIfAuthenticated;
use Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware\Authenticate;
use Gdevilbat\SpardaCMS\Modules\Core\Http\Middleware\MenuGenerator;
use Gdevilbat\SpardaCMS\Modules\Core\Repositories\Repository;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app['router']->aliasMiddleware('core.guest', RedirectIfAuthenticated::class);
        $this->app['router']->aliasMiddleware('core.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('core.menu', MenuGenerator::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton(Repository::class, function ($app) {
            return new Repository;
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('core.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'core'
        );

        $this->publishes([
            __DIR__.'/../Config/lfm.php' => config_path('lfm.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/lfm.php', 'core'
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerPublic()
    {
        $this->publishes([
            __DIR__.'/../assets' => resource_path('views/modules/SpardaCMS/core/assets'),
        ], 'public');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/SpardaCMS/core');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/SpardaCMS/core';
        }, \Config::get('view.paths')), [$sourcePath]), 'core');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/SpardaCMS/core');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'core');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'core');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
