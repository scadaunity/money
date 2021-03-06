<?php

namespace ScadaUnity\Money\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ScadaUnity\Money\Money;
use ScadaUnity\Money\Models\Account;
use Laravel\Jetstream\Jetstream;
use App\Models\User;


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
  public function show(Request $request, Money $money)
  {
      $data = array(
        //'user' => $money::$registersRoutes,
      );
      return Money::inertia()->render($request, 'Money/Dashboard',$data);
  }

  /**
   * Show Money account page
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function account(Request $request)
  {
      $data = array(

      );
      return Money::inertia()->render($request, 'Money/Account', $data);
  }

  /**
   * Show Money Category page
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function category(Request $request)
  {
      return Money::inertia()->render($request, 'Money/Category');
  }
}
