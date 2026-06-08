<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User; // Pastikan memanggil Model User

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Ambil token dari header 'X-API-KEY'. Jika tidak ada, coba cek dari query string (?api_key=...)
        $apiKey = $request->header('X-API-KEY') ?: $request->query('api_key');

        // 2. Validasi: Jika api_key kosong ATAU tidak ditemukan di database tabel users
        if (!$apiKey || !User::where('api_key', $apiKey)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Autentikasi Gagal: API Key tidak valid atau tidak disertakan.'
            ], 401); // 401 Unauthorized
        }

        // 3. Jika API Key cocok dan terdaftar, loloskan request ke Controller
        return $next($request);
    }
}