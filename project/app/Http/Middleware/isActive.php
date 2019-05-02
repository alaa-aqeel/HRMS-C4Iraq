<?php

namespace App\Http\Middleware;

use Closure;

class isActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        if (!auth()->user()->active){
            return response()->json([ 'Errors' => "not_active" ,'user' => auth()->user() ] );    
        }
        
        return $next($request);
    }
}
