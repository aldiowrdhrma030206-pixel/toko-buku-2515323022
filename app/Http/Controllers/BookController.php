<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $daftarBuku = [
        1 => [
            'Judul' => 'Manusia Dan Langit Archives', 'Penulis' => 'Rogbi Adam'
        ],
        2 => [
            'Judul' => 'Luka, Langit & Sebuah Mimpi', 'Penulis' => 'Rogbi Adam'
        ],
        3 => [
            'Judul' => '3726 MDPL', 'Penulis' => 'Nurwina Sari'
        ],
        4 => [
            'Judul' => '3726 MDPL', 'Penulis' => 'Nurwina Sari'
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
