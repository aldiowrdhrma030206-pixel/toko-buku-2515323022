<h1>{{ $buku['Judul'] ?? 'Tidak ditemukan' }}</h1>

@if($buku)
    <p>Penulis: {{ $buku['Penulis'] }}</p>
@else
    <p>Tidak ada buku dengan id {{ $id }}</p>
@endif

<a href="/buku">Kembali</a>