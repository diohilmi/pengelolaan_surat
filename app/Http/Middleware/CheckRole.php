<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // dump(auth()->user()->position);
        // dump($roles);
        // dd(in_array(auth()->user()->position, $roles));

        if(in_array(auth()->user()->positions_id, $roles))
        {
            return $next($request);
        }

        return redirect('/admin/dashboard')->with('error', "You don't have admin access.");

    }
}
