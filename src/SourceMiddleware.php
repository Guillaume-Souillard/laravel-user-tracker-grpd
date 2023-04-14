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
            return $next($request)->withCookie(cookie(UserTrackerCampaign::COOKIE_NAME, $source, 60 * 24 * 740));
        }

        return $next($request);
    }
}