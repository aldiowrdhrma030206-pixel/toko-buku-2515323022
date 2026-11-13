
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Buku</h1>

    <form action="{{ route('buku.update', $buku->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Judul Buku --}}
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text"
                   name="title"
                   id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $buku->title) }}">

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Penulis --}}
        <div class="mb-3">
            <label for="author_id" class="form-label">Penulis</label>

            <select name="author_id"
                    id="author_id"
                    class="form-select @error('author_id') is-invalid @enderror">

                <option value="">Pilih Penulis (Opsional)</option>

                @foreach ($authors as $author)
                    <option value="{{ $author->id }}"
                        {{ old('author_id', $buku->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>

            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>

            <select name="category_id"
                    id="category_id"
                    class="form-select @error('category_id') is-invalid @enderror">

                <option value="">Pilih Kategori</option>

                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('category_id', $buku->category_id) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Penerbit --}}
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Penerbit</label>

            <select name="publisher_id"
                    id="publisher_id"
                    class="form-select @error('publisher_id') is-invalid @enderror">

                <option value="">Pilih Penerbit</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}"
                        {{ old('publisher_id', $buku->publisher_id) == $penerbit->id ? 'selected' : '' }}>
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>

            @error('publisher_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>

            <input type="number"
                   name="price"
                   id="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $buku->price) }}">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>

            <input type="number"
                   name="stock"
                   id="stock"
                   class="form-control @error('stock') is-invalid @enderror"
                   value="{{ old('stock', $buku->stock) }}">

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tahun Terbit --}}
        <div class="mb-3">
            <label for="published_year" class="form-label">Tahun Terbit</label>

            <input type="number"
                   name="published_year"
                   id="published_year"
                   class="form-control @error('published_year') is-invalid @enderror"
                   value="{{ old('published_year', $buku->published_year) }}">

            @error('published_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Sampul --}}
        <div class="mb-3">
            <label for="cover" class="form-label">Sampul Buku</label>

            @if ($buku->cover)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $buku->cover) }}"
                         alt="Sampul Buku"
                         width="120">
                </div>
            @endif

            <input type="file"
                   name="cover"
                   id="cover"
                   class="form-control @error('cover') is-invalid @enderror"
                   accept=".jpg,.jpeg,.png">

            <small class="text-muted">
                Kosongkan jika tidak ingin mengganti sampul.
            </small>

            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>
</div>
@endsection
