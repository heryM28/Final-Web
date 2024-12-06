<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'university_email' => 'admin@university.com',
                'is_active' => true,
            ],
            [
                'name' => 'Library Staff',
                'email' => 'pegawai@example.com',
                'password' => Hash::make('password123'),
                'role' => 'staff', // Ganti nilai role menjadi pendek jika masih gagal
                'university_email' => 'staff@university.com',
                'is_active' => true,
            ],
            [
                'name' => 'Student User',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'university_email' => 'student@university.com',
                'is_active' => true,
            ],
            [
                'name' => 'Guest User',
                'email' => 'guest@example.com',
                'password' => Hash::make('password123'),
                'role' => 'guest',
                'university_email' => null,
                'is_active' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
