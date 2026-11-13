

@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mb-3">Tambah Penulis</h1>

    <form action="{{ route('penulis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Penulis</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   required>

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Negara</label>

            <input type="text"
                   name="country"
                   class="form-control"
                   value="{{ old('country') }}">

            @error('country')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('penulis.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </form>

</div>
@endsection
