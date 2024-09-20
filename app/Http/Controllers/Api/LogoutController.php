<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {        
        try {
            // Membatalkan token
            $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

            // Jika token berhasil dihapus
            return response()->json([
                'success' => true,
                'message' => 'Logout Berhasil!',
            ]);
        } catch (TokenExpiredException $e) {
            // Jika token sudah kadaluarsa
            return response()->json([
                'success' => false,
                'message' => 'Token sudah kadaluarsa!',
            ], 401);
        } catch (TokenInvalidException $e) {
            // Jika token tidak valid
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid!',
            ], 401);
        } catch (JWTException $e) {
            // Jika terjadi error lain
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat logout!',
            ], 500);
        }
    }
}
