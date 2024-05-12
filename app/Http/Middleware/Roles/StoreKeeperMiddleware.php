<?php

namespace App\Http\Middleware\Roles;

use Closure;

class StoreKeeperMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request, mixed)  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (isStoreKeeper()) {
                return $next($request);
            }

            abort(403);
        }

        return redirect()->route('login');
    }
}
