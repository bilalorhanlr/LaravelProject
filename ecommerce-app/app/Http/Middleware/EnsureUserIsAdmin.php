<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login to access the admin panel.');
        }

        if (! $request->user()->isAdmin()) {
            abort(403, 'You do not have permission to access the admin panel.');
        }

        return $next($request);
    }
}
