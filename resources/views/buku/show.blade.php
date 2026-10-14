@extends('layouts.app')

@section('title', $buku->title ?? 'Detail Buku')

@section('content')

    <h1 class="mb-4">Detail Buku</h1>

    @if($buku)

        <div class="card">
            <div class="card-body">

                <img src="{{ asset('images/sampul-placeholder.png') }}"
                     class="img-fluid mb-4"
                     style="max-width: 250px;"
                     alt="Sampul {{ $buku->title }}">

                <h2 class="card-title">
                    {{ $buku->title }}
                </h2>

                <p class="card-text">
                    <strong>Penulis:</strong>
                    {{ $buku->author_name }}
                </p>

                <p class="card-text">
                    <strong>Kategori:</strong>
                    {{ $buku->category->name }}
                </p>

                <p class="harga-buku fs-4">
                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                </p>

                <a href="{{ url('/buku') }}" class="btn btn-secondary">
                    Kembali ke Daftar Buku
                </a>

            </div>
        </div>

    @else

        <div class="alert alert-danger">
            Buku dengan ID {{ $id }} tidak ditemukan.
        </div>

        <a href="{{ url('/buku') }}" class="btn btn-secondary">
            Kembali ke Daftar Buku
        </a>

    @endif

@endsection