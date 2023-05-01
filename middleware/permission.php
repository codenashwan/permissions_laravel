<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class permission
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->routes == null || !in_array($request->route()->getName(), Auth::user()->routes)) {
            return abort(404);
        }
        return $next($request);
    }
}
