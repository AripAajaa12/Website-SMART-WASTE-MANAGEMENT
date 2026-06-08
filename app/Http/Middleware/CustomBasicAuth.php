<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Pastikan memanggil Fasad Auth

class CustomBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Auth::onceBasic() otomatis memeriksa header 'Authorization: Basic ...'
         * Secara default, Laravel akan mencocokkan kolom 'email' dan 'password'.
         * Jika kredensial salah atau tidak ada, ia akan mengembalikan nilai TRUE.
         */
        if (Auth::onceBasic()) {
            return response()->json([
                'success' => false,
                'message' => 'Autentikasi Gagal: Email atau Password Basic Auth tidak valid.'
            ], 401); // 401 Unauthorized
        }

        // Jika email & password cocok, lanjutkan request ke Controller
        return $next($request);
    }
}