<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Users;

class Apiauth
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
    	$token = $request->token;
    	$users = Users::where('token',$token)->first();
        if(!empty($users)){
        	return $next($request);
        }else{
        	return response()->json(['status'=>'error','code'=>'250','message'=>'Unauthorized token','data'=>'']);
        }
    }
}
