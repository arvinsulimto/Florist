<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class AdminMiddleware
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
        $users = User::where('id',Auth::id())->first();
        if($users->role != 'Admin'){
            return redirect('/error');
        }
        return $next($request);
    }
}
