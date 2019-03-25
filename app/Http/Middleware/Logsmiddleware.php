<?php

namespace App\Http\Middleware;

use Closure;

class Logsmiddleware
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
        $id=session("user_id");
        if(empty($id)){
            echo "请先登录";
            return redirect('userpages');
        }
        return $next($request);
    }
}
