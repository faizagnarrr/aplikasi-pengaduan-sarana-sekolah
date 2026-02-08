<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::create([
            'username' => 'admin',
            'password' => 'admin123', 
            'nama' => 'Administrator',
        ]);

        $siswas = [
            [
                'nis' => '1234567890',
                'nama' => 'Faiz Agnar Maulana',
                'kelas' => 'XII PPLG 1',
                'password' => 'password123',
            ],
            [
                'nis' => '1234567891',
                'nama' => 'Reyhan Putra Damar',
                'kelas' => 'XII PPLG 1',
                'password' => 'password123',
            ],
            [
                'nis' => '1234567892',
                'nama' => 'Muhammad Ziqi',
                'kelas' => 'XII PPLG 2',
                'password' => 'password123',
            ],
            [
                'nis' => '1234567893',
                'nama' => 'Ahnaf',
                'kelas' => 'XII PPLG 2',
                'password' => 'password123',
            ],
            [
                'nis' => '1234567894',
                'nama' => 'Nathan',
                'kelas' => 'XII ACP',
                'password' => 'password123',
            ],
        ];

        foreach ($siswas as $siswa) {
            Siswa::create($siswa);
        }
    }
}
