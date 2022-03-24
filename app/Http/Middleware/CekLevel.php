<?php

namespace App\Http\Middleware;

use Closure;
// use Auth;
use Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
      if($request->user()->level == $level){
        return $next($request);
      }

      $level = Auth::user()->level;
      if($level == 'pimpinan'){
        // return 'beranda';
        return redirect('backend_pimpinan_dashboard');
      }else if($level == 'admin'){
        // return 'beranda_owner';
        return redirect('backend_admin_dashboard');
      }else if($level == 'operator'){
        // return 'beranda_web';
        return redirect('backend_operator_dashboard');
      }
    }
}
