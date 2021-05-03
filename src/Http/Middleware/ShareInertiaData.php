<?php

namespace ScadaUnity\Money\Http\Middleware;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use ScadaUnity\Money\Models\Account;

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
                    'account'=>Account::all(),
                ];
            },
            'user' => function () use ($request) {
                if (! $request->user()) {
                    return;
                }

                if (Jetstream::hasTeamFeatures() && $request->user()) {
                    $request->user()->currentTeam;
                }

                return array_merge($request->user()->toArray(), array_filter([
                    'all_teams' => Jetstream::hasTeamFeatures() ? $request->user()->allTeams() : null,
                ]), [
                    'two_factor_enabled' => ! is_null($request->user()->two_factor_secret),
                ]);
            },
            'errorBags' => function () {
                return collect(optional(Session::get('errors'))->getBags() ?: [])->mapWithKeys(function ($bag, $key) {
                    return [$key => $bag->messages()];
                })->all();
            },
        ]));

        return $next($request);
    }
}
