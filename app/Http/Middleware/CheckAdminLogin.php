<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
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
        //通过Auth::guard('admin')->user() 来判断当前访问用户是否已经登陆
        if (!Auth::guard('admin')->user()) {
            return redirect()->to('admin/login')
                             ->withError('您尚未登陆!请登录!');
        }
        return $next($request);
    }
}
