<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller {
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'api_key' => Str::random(32) // Otomatis membuatkan API Key unik
        ]);

        return response()->json(['message' => 'Registrasi Berhasil', 'user' => $user], 201);
    }

    public function loginJWT(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = auth()->guard('api')->attempt($credentials)) {
        return response()->json([
            'error' => 'Email atau password salah'
        ], 401);
    }

    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer'
    ]);
}

    public function profileBasic() {
        return response()->json(['message' => 'Sukses via Basic Auth', 'user' => auth()->user()]);
    }
}