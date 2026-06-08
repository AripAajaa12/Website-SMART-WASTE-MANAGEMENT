<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WasteBin; // Pastikan memanggil Model tempat sampah Anda

class WasteBinController extends Controller
{
    /**
     * Menampilkan semua data titik tempat sampah beserta kategori sampahnya
     */
    public function index()
    {
        // Mengambil semua data dari tabel waste_bins berserta relasi kategorinya
        $bins = WasteBin::with('category')->get();

        // Mengembalikan response sukses berupa data JSON
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data tempat sampah pintar.',
            'data' => $bins
        ], 200);
    }
}