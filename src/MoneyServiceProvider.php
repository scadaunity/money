<?php
// scadaunity\money\src\MoneyServiceProvider.php
namespace ScadaUnity\Money;
use Illuminate\Support\ServiceProvider;
class MoneyServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }
    public function register()
    {
      $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }
}
