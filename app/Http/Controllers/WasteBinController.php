<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WasteBin;

class WasteBinController extends Controller
{
    // GET /api/waste-bins
    public function index()
    {
        return response()->json(
            WasteBin::with('category')->get()
        );
    }

    // POST /api/waste-bins
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'fill_level' => 'required|integer|between:0,100',
            'status' => 'required|string',
            'waste_category_id' => 'required|integer'
        ]);

        $bin = WasteBin::create($validated);

        return response()->json([
            'message' => 'Waste Bin berhasil ditambahkan',
            'data' => $bin
        ], 201);
    }

    // GET /api/waste-bins/{id}
    public function show($id)
    {
        $bin = WasteBin::with('category')->findOrFail($id);

        return response()->json($bin);
    }

    // PUT /api/waste-bins/{id}
    public function update(Request $request, $id)
    {
        $bin = WasteBin::findOrFail($id);

        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'fill_level' => 'required|integer|between:0,100',
            'status' => 'required|string',
            'waste_category_id' => 'required|integer'
        ]);

        $bin->update($validated);

        return response()->json([
            'message' => 'Waste Bin berhasil diupdate',
            'data' => $bin
        ]);
    }

    // DELETE /api/waste-bins/{id}
    public function destroy($id)
    {
        $bin = WasteBin::findOrFail($id);

        $bin->delete();

        return response()->json([
            'message' => 'Waste Bin berhasil dihapus'
        ]);
    }

    // Endpoint simulasi IoT
    public function updateFillLevel(Request $request, $id)
    {
        $request->validate([
            'fill_level' => 'required|integer|between:0,100'
        ]);

        $bin = WasteBin::findOrFail($id);

        $bin->fill_level = $request->fill_level;

        $bin->status =
            ($bin->fill_level >= 90)
            ? 'full'
            : 'normal';

        $bin->save();

        return response()->json([
            'message' => 'Data IoT berhasil diperbarui',
            'data' => $bin
        ]);
    }
}