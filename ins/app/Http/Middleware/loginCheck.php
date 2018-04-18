<?php
namespace App\Http\Middleware;
use Closure;

class loginCheck{
	public function handle($request,Closure $next){
		if($request->session()->has("userName"))
			return $next($request);
		else
			return redirect("/login");
	}
}

?>