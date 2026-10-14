@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

    <h1 class="mb-4">Daftar Buku</h1>

    <div class="row">
        @foreach ($daftarBuku as $buku)

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
                            Penulis: {{ $buku->author_name }}
                        </p>

                        <p class="card-text">
                            Kategori: {{ $buku->category->name }}
                        </p>

                        <p class="card-text harga-buku">
                            Rp{{ number_format($buku->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ url('/buku/' . $buku->id) }}"
                           class="btn btn-primary">
                            Lihat Detail
                        </a>

                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection