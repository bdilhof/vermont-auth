<?php

namespace VermontDevelopment\Auth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->has('locale')) {
            App::setLocale($request->locale);
        }

        return $next($request);
    }
}
