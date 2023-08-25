<?php

namespace VermontDevelopment\Auth\Http\Middleware;

use Closure;

class DetectCentre
{
    public function handle($request, Closure $next)
    {
        session()->forget('detected_store');

        // TODO: Filter by API call
        // TODO: and also check only active stores
        $ip = $request->ip();
        $stores = \App\Models\Warehouse\Store::query()
            ->where('public_ip', 'REGEXP', '(,|^)('.$ip.')(,|$)')
            ->get();
        if ($stores->isNotEmpty()) {
            $request->session()->put('detected_store', $stores);
        }

        return $next($request);
    }
}
