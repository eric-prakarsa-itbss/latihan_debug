<?php

namespace Database\Seeders;

use App\Models\Mahasiswa as ModelsMahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsMahasiswa::factory()->create([
            'NIM' => '0001',
            'nama' => 'Saya',
            'jurusan' => 'Sistem dan Teknologi Informasi'
        ]);

        ModelsMahasiswa::factory()->create([
            'NIM' => '0002',
            'nama' => 'Kamu',
            'jurusan' => 'Sistem dan Teknologi Informasi'
        ]);

        ModelsMahasiswa::factory()->create([
            'NIM' => '0003',
            'nama' => 'Dia',
            'jurusan' => 'Sistem dan Teknologi Informasi'
        ]);
    }
}
