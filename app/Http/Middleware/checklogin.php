<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
            // if( session('role') == null )
            // {
            //     return $next($request);
            // }

            // else{
            //     redirect('/');
            // }

            // if( session('role') != null )
            // {
            //     redirect('/');
            // }

            // else{
            //     return $next($request);
            // }
            if(session('role')=="Admin")
            {
                return redirect("/adminpanel");
            }
            else if(session('role')=="Agent")
            {
                return redirect("/agentpanel");
            }
            return $next($request);
        
    }
}