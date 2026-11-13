@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<div class="container">

    <h1 class="mb-4">Daftar Buku</h1>

    <a href="{{ route('buku.create') }}" class="btn btn-success mb-4">
        + Tambah Buku
    </a>

    <!-- Form Pencarian dan Filter -->
    <form action="{{ route('buku.index') }}" method="GET" class="row g-2 mb-4">

        <!-- Pencarian -->
        <div class="col-md-4">
            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Cari judul atau penulis"
                value="{{ $kataKunci }}"
            >
        </div>

        <!-- Filter Kategori -->
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua kategori</option>

                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}"
                        @selected($kategoriId == $kategori->id)>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filter Penerbit -->
        <div class="col-md-3">
            <select name="penerbit" class="form-select">
                <option value="">Semua penerbit</option>

                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}"
                        @selected($penerbitId == $penerbit->id)>
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Cari dan Reset -->
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Cari
            </button>

            @if ($kataKunci || $kategoriId || $penerbitId)
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                    Reset
                </a>
            @endif
        </div>

    </form>

    <!-- Daftar Buku -->
    <div class="row">

        @forelse ($daftarBuku as $buku)

            <div class="col-md-4 mb-4">
                <div class="card kartu-buku h-100">

                    <img
                        src="{{ asset('images/sampul-placeholder.png') }}"
                        class="card-img-top"
                        alt="Sampul {{ $buku->title }}"
                    >

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $buku->title }}
                        </h5>

                        <p class="card-text">
                            Penulis: {{ $buku->author?->name ?? $buku->author_name ?? '-' }}
                        </p>

                        <p class="card-text">
                            Kategori: {{ $buku->category->name ?? '-' }}
                        </p>

                        <p class="card-text harga-buku">
                            Rp{{ number_format($buku->price, 0, ',', '.') }}
                        </p>

                        <!-- Informasi Stok Buku -->
                        <p class="card-text">
                            Stok:

                            @if ($buku->stock > 5)
                                <span class="badge bg-success">
                                    {{ $buku->stock }} tersedia
                                </span>
                            @elseif ($buku->stock > 0)
                                <span class="badge bg-warning text-dark">
                                    {{ $buku->stock }} tersisa
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Habis
                                </span>
                            @endif
                        </p>

                        <!-- Tombol Detail -->
                        <a
                            href="{{ url('/buku/' . $buku->id) }}"
                            class="btn btn-primary"
                        >
                            Lihat Detail
                        </a>

                        <!-- Tombol Edit -->
                        <a
                            href="{{ route('buku.edit', $buku->id) }}"
                            class="btn btn-warning"
                        >
                            Edit
                        </a>

                        <!-- Tombol Hapus -->
                        <form
                            action="{{ route('buku.destroy', $buku->id) }}"
                            method="POST"
                            style="display: inline;"
                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-warning">
                    Tidak ada buku yang cocok.
                </div>
            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $daftarBuku->links() }}
    </div>

</div>

@endsection