<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->admin) {
            return abort(403, 'You must be an administrator.');
        }
        return $next($request);
    }
}
