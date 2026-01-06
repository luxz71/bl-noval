<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Post; // Import model Post

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'judul' => 'Belajar Laravel di bl-noval',
            'konten' => 'Ini adalah data pertama hasil dari Seeder.'
        ]);
        Post::create([
            'judul' => 'Progress Proyek',
            'konten' => 'Langkah 7 sudah berhasil dijalankan!'
        ]);
    }
}