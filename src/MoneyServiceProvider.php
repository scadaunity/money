<?php
// scadaunity\money\src\MoneyServiceProvider.php
namespace ScadaUnity\Money;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class MoneyServiceProvider extends ServiceProvider
{
    public function boot()
    {
      //diz ao laravel onde ficam as visualizações do pacote
      $this->loadViewsFrom(__DIR__.'/../resources/views', 'money');

      // config.
      $this->configurePermissions();
      $this->configurePublishing();
      $this->configureRoutes();
      $this->configureCommands();
      //

      $this->loadMigrationsFrom(__DIR__.'./../database/migrations');
    }
    public function register()
    {
      $this->mergeConfigFrom(__DIR__.'/../config/money.php', 'money');

    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/money.php' => config_path('money.php'),
        ], 'money-config');
    }

    /**
     * Configure the routes offered by the application.
     *
     * @return void
     */
    protected function configureRoutes()
    {
        if (Money::$registersRoutes) {
            Route::group([
                'namespace' => 'ScadaUnity\Money\Http\Controllers',
                'domain' => config('money.domain', null),
                'prefix' => config('money.prefix', config('money.path')),
            ], function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/'.config('money.stack').'.php');
            });
        }
    }

    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }

    /**
     * Boot any Inertia related services.
     *
     * @return void
     */
    protected function bootInertia()
    {
        $kernel = $this->app->make(Kernel::class);

        $kernel->appendMiddlewareToGroup('web', ShareInertiaData::class);
        $kernel->appendToMiddlewarePriority(ShareInertiaData::class);

        if (class_exists(HandleInertiaRequests::class)) {
            $kernel->appendToMiddlewarePriority(HandleInertiaRequests::class);
        }
    }

    /**
     * Configure the roles and permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Money::defaultApiTokenPermissions(['read']);

        Money::role('admin', __('Administrador'), [
            'create',
            'read',
            'update',
            'delete',
        ])->description(__('Usuario administrador, podera realizar qualquer função.'));

        Money::role('editor', __('Editor'), [
            'read',
            'create',
            'update',
        ])->description(__('Editor users have the ability to read, create, and update.'));
    }
}
