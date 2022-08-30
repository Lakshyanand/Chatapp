<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminpanel
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
        // dump('Admin Panel');
        // if(session('role')!='Admin' || session('role') == null)
        // {
        //     return redirect('login');
        // }

        if(session('role')==null)
        {
            return redirect('login');
        }
        else if(session('role')=="Agent")
        {
            return redirect('/agentpanel');
        }
        return $next($request);
    }
}
