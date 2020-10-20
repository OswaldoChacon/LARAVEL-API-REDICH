<?php

namespace App\Http\Middleware;

use Closure;
// use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Http\Request;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {        
        try {
            $usuario = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if (in_array('Invitado', $roles))
                return $next($request);
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
                return response()->json(['message' => 'Token expirado'], 401);
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
                return response()->json(['message' => 'Token invalido'], 401);
            else
                return response()->json(['mensaje' => 'Authorization Token not found'], 401);
        }
        foreach ($roles as $rol) {
            if ($usuario->hasRole($rol))
                return $next($request);
        }
        return response()->json(['message' => 'No autorizado'], 403);
    }
}
