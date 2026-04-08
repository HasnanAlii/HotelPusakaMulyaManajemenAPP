<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'image_path' => 'assets/bg.jpeg',
                'caption' => 'main image',
            ],
            [
                'image_path' => 'assets/k8.jpeg',
                'caption' => 'sub image',
            ],
            [
                'image_path' => 'assets/k3.jpeg',
                'caption' => 'Standar',
            ],
            [
                'image_path' => 'assets/k3.jpeg',
                'caption' => 'Standar 1',
            ],
            [
                'image_path' => 'assets/k4.jpeg',
                'caption' => 'Superior 1',
            ],
            [
                'image_path' => 'assets/k2.jpeg',
                'caption' => 'Superior 2',
            ],
            [
                'image_path' => 'assets/k1.jpeg',
                'caption' => 'Superior 3',
            ],
            [
                'image_path' => 'assets/k0.jpeg',
                'caption' => 'tentang',
            ],
        ];

        foreach ($data as $item) {

            // ambil file dari public/assets
            $source = public_path($item['image_path']);

            // generate nama baru biar tidak bentrok
            $newName = 'galeri/' . Str::random(10) . '.' . pathinfo($source, PATHINFO_EXTENSION);

            // copy ke storage/app/public
            if (file_exists($source)) {
                Storage::disk('public')->put($newName, file_get_contents($source));

                Galeri::create([
                    'image_path' => 'storage/' . $newName,
                    'caption' => $item['caption'], // ✅ tetap pakai caption
                ]);
            }
        }
    }
}