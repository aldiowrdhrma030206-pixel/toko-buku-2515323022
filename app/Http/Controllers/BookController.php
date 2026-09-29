<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $daftarBuku = [
        1 => [
            'judul' => 'Manusia Dan Langit Archives', 'penulis' => 'Rogbi Adam', "harga" => 65000
        ],
        2 => [
            'judul' => 'Luka, Langit & Sebuah Mimpi', 'penulis' => 'Rogbi Adam', "harga" => 65000
        ],
        3 => [
            'judul' => '3726 MDPL', 'penulis' => 'Nurwina Sari', "harga" => 85000
        ],
        4 => [
            'judul' => 'Belajar PHP dari nol', 'penulis' => 'Adang Wihanda', "harga" => 75000
        ]
    ];

    public function index()
    {
        return view('buku.index',[
            'daftarBuku' => $this->daftarBuku
        ]);
    }
    public function show($id)
    {
        $buku = $this->daftarBuku[$id] ?? null;
        return view('buku.show',[
            'buku' => $buku,
            'id' => $id
        ]);
    }
}
