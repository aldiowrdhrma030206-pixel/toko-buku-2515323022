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
            'title' => 'Luka, langit, dan sebuah mimpi',
            'author_name' => 'Rogbi Adam',
            'price' => 65000,
        ]);

        Book::create([
            'category_id' => $cerpen->id,
            'title' => 'Filosofi Kopi',
            'author_name' => 'Dewi Lestari',
            'price' => 58000,
        ]);

        Book::create([
            'category_id' => $cerpen->id,
            'title' => 'Senyum Karyamin',
            'author_name' => 'Ahmad Tohari',
            'price' => 68000,
        ]);

        Book::create([
            'category_id' => $horor->id,
            'title' => 'Maddah',
            'author_name' => 'Risa Saraswati',
            'price' => 62000,
        ]);

        Book::create([
            'category_id' => $horor->id,
            'title' => 'Danur',
            'author_name' => 'Risa Saraswati',
            'price' => 60000,
        ]);
    }
}