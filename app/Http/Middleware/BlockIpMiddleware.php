<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockIpMiddleware
{
    // set IP addresses
    public $blockIps = '127.0.0.1';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->ip() != $this->blockIps)
        {
            return response()->json(['message' => "You don't have permission to access this website."]);
        }

        return $next($request);
    }
}
