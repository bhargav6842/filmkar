<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrganisationUserAuth
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
        if($request->session()->has('organisation_ID')){
            
        }else{
            $request->session()->flash('error','You Need To Login First');
            return redirect('login');
        }
        return $next($request);
    }
}
