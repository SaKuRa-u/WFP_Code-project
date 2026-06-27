<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            ['title' => 'Tips Menjaga Kesehatan Jantung',    'author' => 'Dr. Budi Santoso'],
            ['title' => 'Mengenal Penyakit Kulit Umum',      'author' => 'Dr. Dedi Pratama'],
            ['title' => 'Pentingnya Vaksinasi Anak',         'author' => 'Dr. Citra Lestari'],
            ['title' => 'Cara Mencegah Diabetes',            'author' => 'Dr. Andi Saputra'],
            ['title' => 'Kesehatan Mental di Era Digital',   'author' => 'Dr. Eka Wijaya'],
        ];

        foreach ($articles as $article) {
            Article::create([
                'title'   => $article['title'],
                'slug'    => \Illuminate\Support\Str::slug($article['title']),
                'content' => 'Konten artikel tentang ' . $article['title'],
                'author'  => $article['author'],
            ]);
        }
    }
}
