<?php

namespace App\Http\Middleware;

use App\Services\ResponseFormats;
use Closure;

class KycMiddleware
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
        $user = auth()->user()->vendor->complied;
        if($user == 1) {
            return $next($request);
        }
        return self::returnFailed("complete your business profile");
    }
}
