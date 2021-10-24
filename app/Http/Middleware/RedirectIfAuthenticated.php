<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*if (Auth::guard($guard)->check()) {
            return redirect('/administration/dashboard');
        }

        return $next($request);*/
		
		 switch ($guard) {
			case 'hospital':
			  if (Auth::guard($guard)->check()) {
				return redirect()->route('hospital.profile');
			  }	
			 case 'dghs':
			  if (Auth::guard($guard)->check()) {
				return redirect()->route('dghs.profile');
			  }			 
			default:
			  if (Auth::guard($guard)->check()) {
				  return redirect('/administration/dashboard');
			  }
			  break;
		  }	
		  return $next($request);
    }
}
