<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kelas' => 'TI-2A',
                'id_mata_kuliah' => 1, // Pemrograman Web
                'id_ruangan' => 1, // Lab Komputer 1
                'nidn' => '0001018501', // Prof. Dr. Budi Santoso
                'hari' => 'Senin',
                'jam' => '08:00-10:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-2B',
                'id_mata_kuliah' => 2, // Basis Data
                'id_ruangan' => 2, // Lab Komputer 2
                'nidn' => '0002019001', // Dr. Ahmad Susanto
                'hari' => 'Senin',
                'jam' => '10:00-12:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-1A',
                'id_mata_kuliah' => 3, // Algoritma dan Struktur Data
                'id_ruangan' => 4, // Ruang Kelas A
                'nidn' => '0003019002', // Dr. Siti Nurhaliza
                'hari' => 'Selasa',
                'jam' => '08:00-10:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-3A',
                'id_mata_kuliah' => 4, // Jaringan Komputer
                'id_ruangan' => 8, // Lab Jaringan
                'nidn' => '0004020001', // Eko Prasetyo
                'hari' => 'Selasa',
                'jam' => '13:00-15:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-2A',
                'id_mata_kuliah' => 5, // Sistem Operasi
                'id_ruangan' => 5, // Ruang Kelas B
                'nidn' => '0005020002', // Dewi Lestari
                'hari' => 'Rabu',
                'jam' => '08:00-10:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-3B',
                'id_mata_kuliah' => 6, // Rekayasa Perangkat Lunak
                'id_ruangan' => 6, // Ruang Kelas C
                'nidn' => '0006019003', // Dr. Fitri Handayani
                'hari' => 'Rabu',
                'jam' => '10:00-12:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-4A',
                'id_mata_kuliah' => 7, // Kecerdasan Buatan
                'id_ruangan' => 3, // Lab Komputer 3
                'nidn' => '0007020003', // Gilang Ramadhan
                'hari' => 'Kamis',
                'jam' => '08:00-10:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-1B',
                'id_mata_kuliah' => 8, // Multimedia
                'id_ruangan' => 9, // Lab Multimedia
                'nidn' => '0008021001', // Hana Pertiwi
                'hari' => 'Kamis',
                'jam' => '13:00-15:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-2B',
                'id_mata_kuliah' => 1, // Pemrograman Web
                'id_ruangan' => 1, // Lab Komputer 1
                'nidn' => '0001018501', // Prof. Dr. Budi Santoso
                'hari' => 'Jumat',
                'jam' => '08:00-10:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kelas' => 'TI-3A',
                'id_mata_kuliah' => 2, // Basis Data
                'id_ruangan' => 2, // Lab Komputer 2
                'nidn' => '0002019001', // Dr. Ahmad Susanto
                'hari' => 'Jumat',
                'jam' => '10:00-12:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('jadwal')->insertBatch($data);
    }
}