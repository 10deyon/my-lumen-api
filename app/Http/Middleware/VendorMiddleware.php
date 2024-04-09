<?php

namespace App\Http\Middleware;

use App\Services\ResponseFormats;
use Closure;
use Illuminate\Support\Facades\Auth;

class VendorMiddleware
{
    use ResponseFormats;
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user()->type;
        if (Auth::user() && $user == "vendor") {
            return $next($request);
        }
        
        return self::returnFailed("complete compliance information");
    }
}
