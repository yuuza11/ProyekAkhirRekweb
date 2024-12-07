<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // CREATE: Menyimpan data mahasiswa
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:15|unique:mahasiswa',
            'email' => 'required|email|unique:mahasiswa',
            'jurusan' => 'required|string|max:100',
        ]);

        // Simpan data mahasiswa
        $mahasiswa = Mahasiswa::create($validatedData);

        return response()->json([
            'message' => 'Mahasiswa berhasil ditambahkan.',
            'data' => $mahasiswa,
        ], 201);
    }

    // READ: Mendapatkan daftar mahasiswa
    public function index()
    {
        // Ambil semua data mahasiswa
        $mahasiswa = Mahasiswa::all();

        return response()->json([
            'message' => 'Daftar mahasiswa berhasil diambil.',
            'data' => $mahasiswa,
        ], 200);
    }

    // UPDATE: Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'nim' => 'sometimes|string|max:15|unique:mahasiswa,nim,' . $id,
            'email' => 'sometimes|email|unique:mahasiswa,email,' . $id,
            'jurusan' => 'sometimes|string|max:100',
        ]);

        // Cari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan.'], 404);
        }

        // Update data mahasiswa
        $mahasiswa->update($validatedData);

        return response()->json([
            'message' => 'Data mahasiswa berhasil diperbarui.',
            'data' => $mahasiswa,
        ], 200);
    }

    // DELETE: Menghapus data mahasiswa
    public function destroy($id)
    {
        // Cari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan.'], 404);
        }

        // Hapus data mahasiswa
        $mahasiswa->delete();

        return response()->json([
            'message' => 'Mahasiswa berhasil dihapus.',
        ], 200);
    }
}
