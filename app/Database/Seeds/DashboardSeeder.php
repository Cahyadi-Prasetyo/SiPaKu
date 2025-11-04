<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DashboardSeeder extends Seeder
{
    public function run()
    {
        // Seed Users (Admin, Dosen)
        $this->seedUsers();
        
        // Seed Mahasiswa
        $this->seedMahasiswa();
        
        // Seed Mata Kuliah
        $this->seedMataKuliah();
        
        // Seed Ruangan
        $this->seedRuangan();
        
        // Seed Jadwal
        $this->seedJadwal();
    }

    private function seedUsers()
    {
        $userData = [
            [
                'nama_user' => 'Administrator',
                'role' => 'admin',
                'kode' => 'ADM001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'nama_user' => 'Dr. Ahmad Susanto, M.Kom',
                'role' => 'dosen',
                'kode' => 'DSN001',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'nama_user' => 'Prof. Siti Nurhaliza, Ph.D',
                'role' => 'dosen',
                'kode' => 'DSN002',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'nama_user' => 'Dr. Budi Santoso, M.T',
                'role' => 'dosen',
                'kode' => 'DSN003',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ]
        ];

        $this->db->table('user')->insertBatch($userData);
    }

    private function seedMahasiswa()
    {
        $mahasiswaData = [
            [
                'nim' => '11240001',
                'nama' => 'Ahmad Rizki Pratama',
                'created_at' => date('Y-m-d H:i:s', strtotime('-30 minutes')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-30 minutes'))
            ],
            [
                'nim' => '12240002',
                'nama' => 'Siti Nurhaliza Putri',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))
            ],
            [
                'nim' => '11240003',
                'nama' => 'Budi Santoso',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'nim' => '12240004',
                'nama' => 'Dewi Lestari',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 hours'))
            ],
            [
                'nim' => '11240005',
                'nama' => 'Eko Prasetyo',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'nim' => '12240006',
                'nama' => 'Fitri Handayani',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'nim' => '11240007',
                'nama' => 'Gilang Ramadhan',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'nim' => '12240008',
                'nama' => 'Hana Pertiwi',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days'))
            ]
        ];

        $this->db->table('mahasiswa')->insertBatch($mahasiswaData);
    }

    private function seedMataKuliah()
    {
        $mataKuliahData = [
            [
                'kode_mata_kuliah' => 'TI101',
                'nama_mata_kuliah' => 'Pemrograman Web',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
            ],
            [
                'kode_mata_kuliah' => 'TI102',
                'nama_mata_kuliah' => 'Basis Data',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
            ],
            [
                'kode_mata_kuliah' => 'TI201',
                'nama_mata_kuliah' => 'Algoritma dan Struktur Data',
                'sks' => 4,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
            ],
            [
                'kode_mata_kuliah' => 'SI101',
                'nama_mata_kuliah' => 'Sistem Informasi Manajemen',
                'sks' => 3,
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
            ]
        ];

        $this->db->table('mata_kuliah')->insertBatch($mataKuliahData);
    }

    private function seedRuangan()
    {
        $ruanganData = [
            [
                'nama_ruangan' => 'Lab Komputer 1',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'nama_ruangan' => 'Lab Komputer 2',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'nama_ruangan' => 'Ruang Kelas A',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'nama_ruangan' => 'Ruang Kelas B',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'nama_ruangan' => 'Auditorium',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 week'))
            ]
        ];

        $this->db->table('ruangan')->insertBatch($ruanganData);
    }

    private function seedJadwal()
    {
        $jadwalData = [
            [
                'nama_kelas' => 'TI-1A',
                'id_mata_kuliah' => 1,
                'id_ruangan' => 1,
                'nidn' => 'DSN001',
                'hari' => 'Senin',
                'jam' => '08:00 - 10:00',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))
            ],
            [
                'nama_kelas' => 'TI-1B',
                'id_mata_kuliah' => 2,
                'id_ruangan' => 2,
                'nidn' => 'DSN002',
                'hari' => 'Selasa',
                'jam' => '10:00 - 12:00',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'nama_kelas' => 'TI-2A',
                'id_mata_kuliah' => 3,
                'id_ruangan' => 3,
                'nidn' => 'DSN003',
                'hari' => 'Rabu',
                'jam' => '13:00 - 15:00',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 hours'))
            ],
            [
                'nama_kelas' => 'SI-1A',
                'id_mata_kuliah' => 4,
                'id_ruangan' => 4,
                'nidn' => 'DSN001',
                'hari' => 'Kamis',
                'jam' => '15:00 - 17:00',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ]
        ];

        $this->db->table('jadwal')->insertBatch($jadwalData);
    }
}