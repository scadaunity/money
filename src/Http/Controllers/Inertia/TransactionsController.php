<?php

namespace ScadaUnity\Money\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use ScadaUnity\Money\Money;
use ScadaUnity\Money\Models\Transactions;
use Laravel\Jetstream\Jetstream;
use App\Models\User;


/**
 *
 */
class TransactionsController extends Controller
{

  /**
   * Show account screen
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function index(Request $request, Money $money)
  {
      return Money::inertia()->render($request, 'Money/Transactions');
  }

  /**
   * Store a new account in the database.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request, Transactions $transactions)
    {
        //dd($request);
        //Validate the request...
        $request->validate([
            'amount' => ['required', 'numeric'],
            'type'=>['required','numeric'],
            'description' => ['required', 'string', 'max:50', 'min:3'],
            'category' =>['required', 'numeric'],
            'account'=>['required', 'numeric'],
            'date'=>['required']
        ]);


        // converte nome
        $transactions->amount = $request->amount;
        $transactions->type = $request->type;
        $transactions->description = ucfirst($request->description);
        $transactions->user = Auth::id();
        $transactions->category = $request->category;
        $transactions->account = $request->account;
        $transactions->date = $request->date;
        $transactions->save();

        return back()->with('flash', [
            'success' => 'Conta criada com sucesso',
        ]);

    }

    /**
     * Update the given API token's permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $account
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$accountId)
    {

      // Validate the request...
      $request->validate([
          'name' => ['required', 'string', 'max:50', 'min:3'],
          'opening_balance' => ['required', 'numeric']
      ]);
      $account = Account::find($accountId);
      $account->name = $request->name;
      $account->opening_balance = $request->opening_balance;
      $account->save();


      return back();


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
