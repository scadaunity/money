<?php
// scadaunity\money\src\MoneyServiceProvider.php
namespace ScadaUnity\Money;
use Illuminate\Support\ServiceProvider;
class MoneyServiceProvider extends ServiceProvider
{
    public function boot()
    {
      $this->configureCommands();
    }
    public function register()
    {
      //$this->mergeConfigFrom(__DIR__.'./../config/money.php', 'money');
      $this->loadRoutesFrom(__DIR__.'./../routes/web.php');
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
}
