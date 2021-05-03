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
class AccountController extends Controller
{

  /**
   * Show account screen
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function index(Request $request, Money $money)
  {
      return Money::inertia()->render($request, 'Money/Account');
  }

  /**
   * Store a new account in the database.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request, Account $account)
    {
        // Validate the request...
        $request->validate([
            'name' => ['required', 'string', 'max:10', 'min:3', 'unique:money_accounts,name'],
            'opening_balance' => ['required']
        ]);

        // converte nome
        $name = $request->name;
        $account->name = $name;
        $account->opening_balance = $request->opening_balance;
        $account->save();

        //return Money::inertia()->render($request, 'Money/Account');
        return back()->with('flash', [
            //'token' => explode('|', $token->plainTextToken, 2)[1],
        ]);
    }

    /**
     * Update the given API token's permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $account
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,Account $account, $accountId)
    {

    }

    /**
     * Delete the given API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $accountId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request,$account)
    {

      Account::destroy($account);

      return back()->with('flash', [
          //'token' => explode('|', $token->plainTextToken, 2)[1],
      ]);
    }
}
