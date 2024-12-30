<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $role = null): Response
    {
       
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

       
        if ($role !== null && $user->role != $role) {
            return redirect('/unauthorized'); 
        }

        return $next($request); 
    }
}
