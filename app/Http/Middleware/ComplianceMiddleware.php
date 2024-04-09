<?php

namespace App\Http\Middleware;

use App\Models\Vendor;
use App\Traits\Response;
use Closure;
use Illuminate\Support\Facades\Auth;

class ComplianceMiddleware
{
    use Response;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $vendor = Vendor::where("user_id", auth()->user()->id)->first();
        
        if (!$vendor) return self::returnFailed("oops! not a vendor");
        
        if (!$vendor->complied) return self::returnFailed("incomplete compliance information");

        return $next($request);
    }
}
