<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType=null)
    {
        $a = config('services.userRole.SUPERADMIN');
        $b = config('services.userRole.SUBADMIN');
        $c = config('services.userRole.MASTER');
        $d = config('services.userRole.SUPERAGENT');
        $e = config('services.userRole.AGENT');
        $f = config('services.userRole.CLIENT');

        $s1 = $request->segment(1);
        $role = auth()->user()->userRole;
        if($s1=='inSubAdmin'){
            if(in_array($role,[$a])){
                return $next($request);    
            }
        }
        if($s1=='inMasters'){
            if(in_array($role,[$a,$b])){
                return $next($request);    
            }
        }
        if($s1=='inSuperAgent'){
            if(in_array($role,[$a,$b,$c])){
                return $next($request);    
            }
        }
        if($s1=='inAgent'){
            if(in_array($role,[$a,$b,$c,$d])){
                return $next($request);    
            }
        }
        /* if(auth()->user()->userRole == $userType){
            return $next($request);
        } */
        // return response()->json(['You do not have permission to access for this page.']);
        Auth::logout();
        return response()->view('errors.check-permission');        
    }
}
