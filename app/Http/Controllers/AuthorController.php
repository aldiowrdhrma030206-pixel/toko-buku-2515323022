<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Menampilkan semua data penulis
    public function index()
    {
        $penulis = Author::latest()->get();

        return view('penulis.index', compact('penulis'));
    }

    // Menampilkan formulir tambah penulis
    public function create()
    {
        return view('penulis.create');
    }

    // Menyimpan data penulis
    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:100|min:3|unique:authors,name',
        'country' => 'nullable|string|max:100',
    ], [
        'name.required' => 'Nama penulis wajib diisi.',
        'name.string' => 'Nama penulis harus berupa teks.',
        'name.max' => 'Nama penulis maksimal 100 karakter.',
        'name.min' => 'Nama Penulis minimal lebih dari 3 karaker',
        'name.unique' => 'Nama penulis sudah terdaftar.',
        'country.string' => 'Negara harus berupa teks.',
        'country.max' => 'Negara maksimal 100 karakter.',
    ]);

    Author::create($validated);

    return redirect()
        ->route('penulis.index')
        ->with('success', 'Penulis berhasil ditambahkan.');
    }


    // Menampilkan formulir edit penulis
    public function edit(Author $penulis)
    {
        return view('penulis.edit', compact('penulis'));
    }

    // Memperbarui data penulis
    public function update(Request $request, Author $penulis)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:100|unique:authors,name,' . $penulis->id,
        'country' => 'nullable|string|max:100',
    ], [
        'name.required' => 'Nama penulis wajib diisi.',
        'name.string' => 'Nama penulis harus berupa teks.',
        'name.max' => 'Nama penulis maksimal 100 karakter.',
        'name.unique' => 'Nama penulis sudah terdaftar.',
        'country.string' => 'Negara harus berupa teks.',
        'country.max' => 'Negara maksimal 100 karakter.',
    ]);

    $penulis->update($validated);

    return redirect()
        ->route('penulis.index')
        ->with('success', 'Penulis berhasil diperbarui.');
    }

    // Menghapus data penulis
    public function destroy(Author $penulis)
    {
    // Periksa apakah penulis masih memiliki buku
    if ($penulis->books()->exists()) {
        return redirect()->route('penulis.index')
            ->with('error', 'Penulis tidak dapat dihapus karena masih digunakan oleh buku.');
    }

    // Hapus penulis jika tidak memiliki buku
    $penulis->delete();

    return redirect()->route('penulis.index')
        ->with('success', 'Penulis berhasil dihapus.');
    }
}
