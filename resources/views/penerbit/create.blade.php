<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Penerbit</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penerbit.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Penerbit</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input
                    type="text"
                    name="city"
                    id="city"
                    class="form-control"
                    value="{{ old('city') }}"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('penerbit.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
