<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan daftar buku
    public function index(Request $request)
    {
        $kataKunci = $request->query('q');
        $kategoriId = $request->query('kategori');
        $penerbitId = $request->query('penerbit');

        $daftarBuku = Book::with('category')
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($q) use ($kataKunci) {
                    $q->where('title', 'like', "%{$kataKunci}%")
                    ->orWhere('author_name', 'like', "%{$kataKunci}%");
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('category_id', $kategoriId);
            })
            ->when($penerbitId, function ($query, $penerbitId) {
                $query->where('publisher_id', $penerbitId);
            })
            ->latest('id')
            ->paginate(3)
            ->withQueryString();

        return view('buku.index', [
            'daftarBuku' => $daftarBuku,
            'daftarKategori' => Category::orderBy('name')->get(),
            'daftarPenerbit' => Publisher::orderBy('name')->get(),
            'kataKunci' => $kataKunci,
            'kategoriId' => $kategoriId,
            'penerbitId' => $penerbitId,
        ]);
    }

    // Menampilkan detail buku
    public function show($id)
{
    $buku = Book::with('category')->findOrFail($id);

    $bukuLain = Book::with('category')
        ->where('category_id', $buku->category_id)
        ->where('id', '!=', $buku->id)
        ->get();

    return view('buku.show', compact('buku', 'bukuLain'));
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

    // Menghapus buku
    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }

    // Aturan validasi
    private function aturan(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',

            // Harga wajib angka bulat tanpa titik atau koma
            'price' => 'required|integer|min:1|max:99999999',

            // Stok wajib diisi, bilangan bulat, dan tidak boleh negatif
            'stock' => 'required|integer|min:0|max:100000',

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

            'price.required' => 'Harga buku wajib diisi.',
            'price.integer' => 'Harga harus berupa angka bulat tanpa titik atau koma. Contoh: 85000 untuk Rp85.000.',
            'price.min' => 'Harga buku minimal Rp1.',
            'price.max' => 'Harga terlalu besar (maksimal Rp99.999.999).',

            'stock.required' => 'Stok buku wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok buku tidak boleh negatif.',
            'stock.max' => 'Stok terlalu besar (maksimal 100.000).',

            'published_year.integer' => 'Tahun terbit harus berupa angka bulat.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit maksimal 2100.',

            'cover.image' => 'Sampul harus berupa gambar.',
            'cover.mimes' => 'Sampul harus berformat JPG atau PNG.',
            'cover.max' => 'Ukuran sampul maksimal 2 MB.',
        ];
    }
}