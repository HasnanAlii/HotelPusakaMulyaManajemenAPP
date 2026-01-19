<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'image_path' => 'galeri/main.jpg',
                'caption' => 'main image',
            ],
            [
                'image_path' => 'galeri/sub.jpg',
                'caption' => 'sub image',
            ],
            [
                'image_path' => 'galeri/2.jpg',
                'caption' => 'Standar',
            ],
            [
                'image_path' => 'galeri/2.jpg',
                'caption' => 'Standar 1',
            ],
            [
                'image_path' => 'galeri/3.jpg',
                'caption' => 'Superior 1',
            ],
            [
                'image_path' => 'galeri/4.jpg',
                'caption' => 'Superior 2',
            ],
            [
                'image_path' => 'galeri/5.jpg',
                'caption' => 'Superior 3',
            ],
             [
                'image_path' => 'galeri/sub.jpg',
                'caption' => 'tentang',
            ],
        ];

        foreach ($data as $item) {
            Galeri::create($item);
        }
    }
}
