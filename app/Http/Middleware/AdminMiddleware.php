<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(! Auth::check()) {
			$alert['class']   = 'alert alert-danger'; 
			$alert['heading'] = Lang::get('akerts.danger'); 
			$alert['message'] = Lang::get('middleware.AdminNotLogginIn'); 

			return Redirect::back()->with($alert);
		}

		if (! Auth::user()->role == 'A') {
			$alert['class']   = 'alert alert-danger';
			$alert['heading'] = Lang::get('alerts.danger'); 
			$alert['message'] = Lang::get('middleware.AdminNoAdmin');  

			return Redirect::back()->with($alert); 
		} 

		// The user is logged in and has admin rights. 
		// So fire that bitch up for the next request.
		return $next($request);
	}

}