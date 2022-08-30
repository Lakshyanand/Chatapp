<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class agentpanel
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
        // if(session('role') != 'Agent' || session('role') == null)
        //     {
        //         return redirect('login');
        //     }
        if(session('role') == null)
        {
            return redirect('login');
        }
            else if(session('role')=="Admin")
            {
                return redirect("/adminpanel");
            }
        return $next($request);
    }
}
