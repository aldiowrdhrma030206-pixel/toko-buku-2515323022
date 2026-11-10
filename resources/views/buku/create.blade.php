@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')

<div class="container">
    <h1 class="mb-4">Tambah Buku</h1>

    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Judul Buku -->
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>

            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}"
            >

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Penulis -->
        <div class="mb-3">
            <label for="author_name" class="form-label">Penulis</label>

            <input
                type="text"
                id="author_name"
                name="author_name"
                class="form-control @error('author_name') is-invalid @enderror"
                value="{{ old('author_name') }}"
            >

            @error('author_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>

            <select
                id="category_id"
                name="category_id"
                class="form-select @error('category_id') is-invalid @enderror"
            >
                <option value="">Pilih Kategori</option>

                @foreach ($daftarKategori as $kategori)
                    <option
                        value="{{ $kategori->id }}"
                        {{ old('category_id') == $kategori->id ? 'selected' : '' }}
                    >
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Penerbit -->
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Penerbit</label>

            <select
                id="publisher_id"
                name="publisher_id"
                class="form-select @error('publisher_id') is-invalid @enderror"
            >
                <option value="">Pilih Penerbit</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option
                        value="{{ $penerbit->id }}"
                        {{ old('publisher_id') == $penerbit->id ? 'selected' : '' }}
                    >
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>

            @error('publisher_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Harga -->
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>

            <input
                type="text"
                id="price"
                name="price"
                inputmode="numeric"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price') }}"
                placeholder="Contoh: 85000"
            >

            <small class="text-muted">
                Masukkan angka tanpa titik atau koma.
                Contoh: 85000 (Rp85.000).
            </small>

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Stok Buku -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stok Buku</label>

            <input
                type="number"
                id="stock"
                name="stock"
                min="0"
                step="1"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock') }}"
                placeholder="Masukkan jumlah stok"
            >

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tahun Terbit -->
        <div class="mb-3">
            <label for="published_year" class="form-label">
                Tahun Terbit (opsional)
            </label>

            <input
                type="number"
                id="published_year"
                name="published_year"
                min="1900"
                max="2100"
                class="form-control @error('published_year') is-invalid @enderror"
                value="{{ old('published_year') }}"
            >

            @error('published_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sampul Buku -->
        <div class="mb-3">
            <label for="cover" class="form-label">Sampul Buku</label>

            <input
                type="file"
                id="cover"
                name="cover"
                accept=".jpg,.jpeg,.png"
                class="form-control @error('cover') is-invalid @enderror"
            >

            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol -->
        <button type="submit" class="btn btn-primary">
            Simpan Buku
        </button>

        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </form>
</div>

@endsection