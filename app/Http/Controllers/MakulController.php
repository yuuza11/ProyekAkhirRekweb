<?php

namespace App\Http\Controllers;

use App\Models\Makul;
use Illuminate\Http\Request;

class MakulController extends Controller
{
    // CREATE: Menambahkan data mata kuliah
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|string|max:10|unique:makul',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|string|max:20',
        ]);

        $makul = Makul::create($validatedData);

        return response()->json([
            'message' => 'Mata kuliah berhasil ditambahkan.',
            'data' => $makul,
        ], 201);
    }

    // READ: Mengambil daftar mata kuliah
    public function index()
    {
        $makul = Makul::all();

        return response()->json([
            'message' => 'Daftar mata kuliah berhasil diambil.',
            'data' => $makul,
        ], 200);
    }

    // UPDATE: Memperbarui data mata kuliah
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode' => 'sometimes|string|max:10|unique:makul,kode,' . $id,
            'nama' => 'sometimes|string|max:255',
            'sks' => 'sometimes|integer|min:1|max:6',
            'semester' => 'sometimes|string|max:20',
        ]);

        $makul = Makul::find($id);

        if (!$makul) {
            return response()->json(['message' => 'Mata kuliah tidak ditemukan.'], 404);
        }

        $makul->update($validatedData);

        return response()->json([
            'message' => 'Data mata kuliah berhasil diperbarui.',
            'data' => $makul,
        ], 200);
    }

    // DELETE: Menghapus data mata kuliah
    public function destroy($id)
    {
        $makul = Makul::find($id);

        if (!$makul) {
            return response()->json(['message' => 'Mata kuliah tidak ditemukan.'], 404);
        }

        $makul->delete();

        return response()->json([
            'message' => 'Mata kuliah berhasil dihapus.',
        ], 200);
    }
}
