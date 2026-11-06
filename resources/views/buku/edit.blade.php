
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Buku</h1>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="title" class="form-control"
                value="{{ old('title', $buku->title) }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text" name="author_name" class="form-control"
                value="{{ old('author_name', $buku->author_name) }}">
            @error('author_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-control">
                <option value="">Pilih Kategori</option>
                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('category_id', $buku->category_id) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <select name="publisher_id" class="form-control">
                <option value="">Pilih Penerbit</option>
                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}"
                        {{ old('publisher_id', $buku->publisher_id) == $penerbit->id ? 'selected' : '' }}>
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>
            @error('publisher_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control"
                value="{{ old('price', $buku->price) }}">
            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Terbit (opsional)</label>
            <input type="text" name="published_year" class="form-control"
                value="{{ old('published_year', $buku->published_year) }}">
            @error('published_year') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Cover Buku (opsional)</label>
            <input type="file" name="cover" class="form-control">
            @error('cover') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
