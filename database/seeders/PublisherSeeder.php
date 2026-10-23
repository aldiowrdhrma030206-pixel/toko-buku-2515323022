<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        Publisher::insert([
            [
                'name' => 'Media Informatika Nusantara',
                'city' => 'Surabaya',
            ],
            [
                'name' => 'Cakrawala Digital Press',
                'city' => 'Bandung',
            ],
            [
                'name' => 'Pustaka Teknologi Mandiri',
                'city' => 'Malang',
            ],
        ]);
    }
}
