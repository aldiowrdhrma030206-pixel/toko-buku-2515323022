
@extends('layouts.app')

@section('title', $buku->title ?? 'Detail Buku')

@section('content')

    <h1 class="mb-4">Detail Buku</h1>

    @if($buku)

        <div class="card mb-4">
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
                    {{ $buku->category->name ?? '-' }}
                </p>

                <p class="harga-buku fs-4">
                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                </p>

                @if ($buku->published_year)
                    <p class="text-muted">
                        Tahun terbit: {{ $buku->published_year }}
                    </p>
                @endif

                <p>
                    <strong>Stok:</strong>

                    @if ($buku->stock <= 0)
                        <span class="badge bg-danger">Stok habis</span>
                    @else
                        <span class="badge bg-success">
                            {{ $buku->stock }}
                        </span>
                    @endif
                </p>

                <a href="{{ url('/buku') }}" class="btn btn-secondary">
                    Kembali ke Daftar Buku
                </a>

            </div>
        </div>

        {{-- Buku lain dalam kategori yang sama --}}

        <h3 class="mb-3">
            Buku lain di kategori {{ $buku->category->name ?? 'Lainnya' }}
        </h3>

        <div class="row">

            @forelse ($bukuLain as $item)

                <div class="col-md-3 mb-4">

                    <div class="card h-100">

                        <img src="{{ asset('images/sampul-placeholder.png') }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;"
                             alt="Sampul {{ $item->title }}">

                        <div class="card-body">

                            <h5 class="card-title">
                                {{ $item->title }}
                            </h5>

                            <p class="card-text">
                                {{ $item->author_name }}
                            </p>

                            <p class="fw-bold">
                                Rp{{ number_format($item->price, 0, ',', '.') }}
                            </p>

                            <a href="{{ route('buku.show', $item->id) }}"
                               class="btn btn-primary btn-sm">
                                Lihat Detail
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-info">
                        Belum ada buku lain dalam kategori ini.
                    </div>
                </div>

            @endforelse

        </div>

    @else

        <div class="alert alert-danger">
            Buku tidak ditemukan.
        </div>

        <a href="{{ url('/buku') }}" class="btn btn-secondary">
            Kembali ke Daftar Buku
        </a>

    @endif

@endsection
