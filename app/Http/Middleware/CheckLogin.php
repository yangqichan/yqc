<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        $adminuser=$request->session()->get('adminuser');
        if(!$adminuser){
            return redirect('/login');
        }
        return $next($request);
    }
}
