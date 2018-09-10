<?php

namespace App\Http\Middleware;

use Closure;

class EnableLock
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
        try{ 
            $path = base_path();
            $sbus_path = "/SILOP/";
            $keyfile_name = "HA_Bridge.key";
            $path = $path.$sbus_path.$keyfile_name;
            if(!file_exists($path)){
                return redirect('/');
            }
            $data = file($path);
            if(empty($data)){
                return redirect('/');
            }
        }
        catch(Exception $e){

        }
        return $next($request);
    }
}
