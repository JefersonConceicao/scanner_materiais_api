<?php

namespace App\Http\Middleware;

//OTHER'S NAMESPACES
use Closure;
use Auth;
use Illuminate\Support\Facades\Route;

//MODELS
use App\Models\Permission;

class VerifyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * 
     */
    public function handle($request, Closure $next)
    {   
        $permissao = new Permission;    
        
        // if(!$permissao->permissionAuthorized(Route::currentRouteName())){
        //     if(!$request->ajax()){
        //         abort(401);
        //     }else{
        //         return response()->json(['msg' => 'Unauthorized'], 401);
        //     }
        // }

        return $next($request);
    }
}
