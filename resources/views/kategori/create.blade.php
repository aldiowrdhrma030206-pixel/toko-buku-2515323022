
@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-4">Tambah Kategori</h1>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">
                Nama Kategori
            </label>

            <input type="text"
                id="name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Masukkan nama kategori">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('kategori.index') }}"
            class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>

@endsection
