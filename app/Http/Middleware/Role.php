<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, $role = null)
    {
        // return Auth::user();
        if ($role) {
            # code...
            if (Auth::user()->role->name == $role) {
                return null;
            }
            abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
        }
 
    }
}
