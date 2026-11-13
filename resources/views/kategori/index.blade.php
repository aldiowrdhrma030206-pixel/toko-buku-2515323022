
@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-3">Daftar Kategori</h1>

    {{-- Tombol Tambah Kategori --}}
    <div class="mb-4">
        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-lg">
            Tambah Kategori
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Kategori --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="9%">No.</th>
                <th>Nama Kategori</th>
                <th width="25%">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $category->id) }}"
                            class="btn btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('kategori.destroy', $category->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Belum ada kategori buku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
