<?php

namespace Guillaumesouillard\UserTrackerGrpd;

use Closure;
use Illuminate\Http\Request;

class SourceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('from_ut')) {
            $source = $request->input('from_ut');
            return $next($request)->withCookie(cookie('from_ut_source', $source, 60 * 24 * 30));
        }

        return $next($request);
    }
}