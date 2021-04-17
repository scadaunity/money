<?php

namespace ScadaUnity\Money\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;


/**
 *
 */
class DashboardController extends Controller
{

  /**
   * Show Money dashboard page
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function show(Request $request)
  {
      //echo "DasboardController::show";
      return Inertia::render('Money/dashboard');
  }
}
