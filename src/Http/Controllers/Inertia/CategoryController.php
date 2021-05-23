<?php

namespace ScadaUnity\Money\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use ScadaUnity\Money\Money;
use ScadaUnity\Money\Models\Category;
use Laravel\Jetstream\Jetstream;
use App\Models\User;


/**
 *
 */
class CategoryController extends Controller
{

  /**
   * Show account screen
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Inertia\Response
   */
  public function index(Request $request, Money $money)
  {
      return Money::inertia()->render($request, 'Money/Category');
  }

  /**
   * Store a new account in the database.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request, Category $category)
    {
        // Validate the request...
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:3'],
        ]);



        // converte nome
        $category->name = ucfirst($request->name);
        $category->parent_id = $request->parent_id;
        $category->user = Auth::id();
        $category->color = $request->color;
        $category->icon = '';
        $category->type = 0;
        $category->state = 0;
        $category->save();

        return back()->with('flash', [
            'success' => 'Conta criada com sucesso',
        ]);
    }

    /**
     * Update the given API token's permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$categoryId)
    {

      // Validate the request...
      $request->validate([
          'name' => ['required', 'string', 'max:50', 'min:3'],
      ]);
      $category = Category::find($categoryId);
      $category->name = $request->name;
      $category->color = $request->color;
      $category->save();


      return back();


    }

    /**
     * Delete the given API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $categoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request,$category)
    {

      Category::destroy($category);

      return back()->with('flash', [
          //'token' => explode('|', $token->plainTextToken, 2)[1],
      ]);
    }
}
