<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_mata_kuliah' => 'TI001',
                'nama_mata_kuliah' => 'Pemrograman Web',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI002',
                'nama_mata_kuliah' => 'Basis Data',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI003',
                'nama_mata_kuliah' => 'Algoritma dan Struktur Data',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI004',
                'nama_mata_kuliah' => 'Jaringan Komputer',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI005',
                'nama_mata_kuliah' => 'Sistem Operasi',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI006',
                'nama_mata_kuliah' => 'Rekayasa Perangkat Lunak',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI007',
                'nama_mata_kuliah' => 'Kecerdasan Buatan',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kode_mata_kuliah' => 'TI008',
                'nama_mata_kuliah' => 'Multimedia',
                'sks' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('mata_kuliah')->insertBatch($data);
    }
}