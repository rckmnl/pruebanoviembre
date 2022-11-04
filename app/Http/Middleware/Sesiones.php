<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sesiones
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $first = Carbon::create(Auth()->user()->last_login->format('d/m/y'));
        $second = Carbon::create(now()->format('d/m/y'));
        $boolean = $first->lessThan($second);
        //dd($boolean, $first, $second);
        if ($boolean)  {
            return redirect('/sesiones');
        }
        return $next($request);
    }
}
