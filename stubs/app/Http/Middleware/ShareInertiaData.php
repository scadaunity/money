<?php

namespace ScadaUnity\Money\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use ScadaUnity\Money\Models\Account;
use ScadaUnity\Money\Models\Category;

class ShareInertiaData
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return \Illuminate\Http\Response
     */

    public function handle($request, $next)
    {
        Inertia::share(array_filter([
              'money' => function () use ($request) {
                return [
                    'account'=>Account::where('user',Auth::id())->orderBy('name')->get(),
                    'category'=>Category::where('user',Auth::id())->orderBy('name')->get(),
                ];
            },

        ]));

        return $next($request);
    }
}
