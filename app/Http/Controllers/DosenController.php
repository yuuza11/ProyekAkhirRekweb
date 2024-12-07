<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // CREATE: Menambahkan data dosen
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:15|unique:dosen',
            'email' => 'required|email|unique:dosen',
        ]);

        $dosen = Dosen::create($validatedData);

        return response()->json([
            'message' => 'Dosen berhasil ditambahkan.',
            'data' => $dosen,
        ], 201);
    }

    // READ: Mengambil daftar dosen
    public function index()
    {
        $dosen = Dosen::all();

        return response()->json([
            'message' => 'Daftar dosen berhasil diambil.',
            'data' => $dosen,
        ], 200);
    }

    // UPDATE: Memperbarui data dosen
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'nidn' => 'sometimes|string|max:15|unique:dosen,nidn,' . $id,
            'email' => 'sometimes|email|unique:dosen,email,' . $id,
        ]);

        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan.'], 404);
        }

        $dosen->update($validatedData);

        return response()->json([
            'message' => 'Data dosen berhasil diperbarui.',
            'data' => $dosen,
        ], 200);
    }

    // DELETE: Menghapus data dosen
    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan.'], 404);
        }

        $dosen->delete();

        return response()->json([
            'message' => 'Dosen berhasil dihapus.',
        ], 200);
    }
}
