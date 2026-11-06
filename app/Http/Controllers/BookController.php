<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        return view('buku.index', [
            'daftarBuku' => Book::with('category')->get()
        ]);
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $buku = Book::with('category')->find($id);

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id
        ]);
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('buku.create', [
            'daftarKategori' => Category::all(),
            'daftarPenerbit' => Publisher::all(),
        ]);
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->aturan(),
            $this->pesan()
        );

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')
                ->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
    $buku = Book::findOrFail($id);

    return view('buku.edit', [
        'buku' => $buku,
        'daftarKategori' => Category::all(),
        'daftarPenerbit' => Publisher::all()
    ]);
    }

    // Memperbarui data buku
    public function update(Request $request, $id)
    {
        $buku = Book::findOrFail($id);

        $data = $request->validate(
            $this->aturan(),
            $this->pesan()
        );

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')
                ->store('covers', 'public');
        } else {
            unset($data['cover']);
        }

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Aturan validasi
    private function aturan(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'price' => 'required|numeric|min:0|max:99999999',
            'published_year' => 'nullable|integer|min:1900|max:2100',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    // Pesan validasi
    private function pesan(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'title.string' => 'Judul buku harus berupa teks.',
            'title.max' => 'Judul buku maksimal 255 karakter.',

            'author_name.required' => 'Nama penulis wajib diisi.',
            'author_name.string' => 'Nama penulis harus berupa teks.',
            'author_name.max' => 'Nama penulis maksimal 255 karakter.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'publisher_id.required' => 'Penerbit wajib dipilih.',
            'publisher_id.exists' => 'Penerbit yang dipilih tidak valid.',

            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
            'price.max' => 'Harga terlalu besar (maksimal 99.999.999).',

            'published_year.integer' => 'Tahun terbit harus berupa angka bulat.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit maksimal 2100.',

            'cover.image' => 'Sampul harus berupa gambar.',
            'cover.mimes' => 'Sampul harus berformat JPG atau PNG.',
            'cover.max' => 'Ukuran sampul maksimal 2 MB.',
        ];
    }
}
