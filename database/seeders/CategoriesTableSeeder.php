<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan 5 kategori buku
        DB::table('categories')->insert([
            ['name' => 'Fiksi', 'description' => 'Buku fiksi yang mengandung cerita imajinatif.'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku yang berisi fakta dan informasi nyata.'],
            ['name' => 'Ilmu Pengetahuan', 'description' => 'Buku tentang pengetahuan dan penelitian ilmiah.'],
            ['name' => 'Biografi', 'description' => 'Buku yang menceritakan kisah hidup seseorang.'],
            ['name' => 'Sejarah', 'description' => 'Buku yang membahas peristiwa-peristiwa sejarah.']
        ]);
    }
}
