<?php

namespace Database\Seeders;

use App\Models\Matakuliah as ModelsMatakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class matakuliah extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsMatakuliah::factory()->create([
            'kode' => 'ST0001',
            'nama_matakuliah' => 'Pemograman Web Dasar'
        ]);

        ModelsMatakuliah::factory()->create([
            'kode' => 'ST0002',
            'nama_matakuliah' => 'Pemograman Web Lanjutan'
        ]);
    }
}
