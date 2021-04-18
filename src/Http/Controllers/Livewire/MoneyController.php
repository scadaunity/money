<?php

namespace ScadaUnity\Money\Http\Controllers\Livewire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;


/**
 *
 */
class MoneyController extends Controller
{

  /**
   * Show Money dashboard page
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function show(Request $request)
  {
      echo "DasboardController::Livewire";
  }
}
