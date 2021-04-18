<?php

namespace ScadaUnity\Money\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ScadaUnity\Money\Money;


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
      return Money::inertia()->render($request, 'Money/dashboard');
  }
}
