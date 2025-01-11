<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $authtenticate = true;

        if (!$token) {
            $authtenticate = false;
        }

        $admin = Admin::where('token', $token)->first();
        if (!$admin) {
            $authtenticate = false;
        } else {
            Auth::login($admin);
        }

        if ($authtenticate) {
            return $next($request);
        } else {
            return ResponseHelper::buildResponse(401, 'error', 'Unauthorized');
        }

    }
}
