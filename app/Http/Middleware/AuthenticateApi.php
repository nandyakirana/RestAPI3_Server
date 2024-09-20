<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Memeriksa dan memvalidasi token JWT
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
            }
        } catch (TokenExpiredException $e) {
            // Token sudah kadaluarsa
            return response()->json(['message' => 'Token sudah kadaluarsa'], 401);
        } catch (TokenInvalidException $e) {
            // Token tidak valid
            return response()->json(['message' => 'Token tidak valid'], 401);
        } catch (JWTException $e) {
            // Tidak ada token dalam request
            return response()->json(['message' => 'Token tidak ditemukan'], 400);
        }

        return $next($request);
    }
}
