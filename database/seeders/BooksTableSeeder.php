<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Loop untuk membuat 50 buku
        for ($i = 0; $i < 50; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3), // Judul buku acak
                'author' => $faker->name, // Nama pengarang acak
                'publisher' => $faker->company, // Nama penerbit acak
                'publication_year' => $faker->year, // Tahun terbit acak
                'stock' => $faker->numberBetween(1, 100), // Stok buku acak
                'description' => $faker->paragraph, // Deskripsi buku acak
                'category_id' => \App\Models\Category::inRandomOrder()->first()->id, // Random category_id
                'is_available' => $faker->boolean(80), // Status ketersediaan acak (80% kemungkinan tersedia)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
