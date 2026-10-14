<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $novel = Category::where('name', 'Novel')->firstOrFail();
        $cerpen = Category::where('name', 'Cerpen')->firstOrFail();
        $horor = Category::where('name', 'Horor')->firstOrFail();

        Book::create([
            'category_id' => $novel->id,
            'title' => 'Manusia Dan Langit',
            'author_name' => 'Rogbi Adam',
            'price' => 65000,
        ]);

        Book::create([
            'category_id' => $novel->id,
            'title' => 'Dasar Laravel',
            'author_name' => 'Budi Santoso',
            'price' => 95000,
        ]);

        Book::create([
            'category_id' => $cerpen->id,
            'title' => 'Pengantar Jaringan Komputer',
            'author_name' => 'Citra Dewi',
            'price' => 78000,
        ]);

        Book::create([
            'category_id' => $cerpen->id,
            'title' => 'Praktik Jaringan Dasar',
            'author_name' => 'Dewa Putra',
            'price' => 88000,
        ]);

        Book::create([
            'category_id' => $horor->id,
            'title' => 'Dasar Basis Data',
            'author_name' => 'Eka Saputra',
            'price' => 82000,
        ]);

        Book::create([
            'category_id' => $horor->id,
            'title' => 'SQL untuk Pemula',
            'author_name' => 'Fitri Lestari',
            'price' => 90000,
        ]);
    }
}