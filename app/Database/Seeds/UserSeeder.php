<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama terlebih dahulu
        $this->db->table('user')->truncate();
        
        $data = [
            // Admin User (hanya 1)
            [
                'nama_user'  => 'Administrator SIPAKU',
                'role'       => 'admin',
                'kode'       => 'admin',
                'password'   => password_hash('admin', PASSWORD_DEFAULT), // password = kode
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Dosen Users (password = NIDN)
            [
                'nama_user'  => 'Dr. Siti Nurhaliza',
                'role'       => 'dosen',
                'kode'       => '0123456789', // NIDN
                'password'   => password_hash('0123456789', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Prof. Ahmad Dahlan',
                'role'       => 'dosen',
                'kode'       => '0234567890', // NIDN
                'password'   => password_hash('0234567890', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Dr. Budi Raharjo',
                'role'       => 'dosen',
                'kode'       => '0345678901', // NIDN
                'password'   => password_hash('0345678901', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Dewi Fortuna, M.Kom',
                'role'       => 'dosen',
                'kode'       => '0456789012', // NIDN
                'password'   => password_hash('0456789012', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Dr. Eko Budiyanto',
                'role'       => 'dosen',
                'kode'       => '0567890123', // NIDN
                'password'   => password_hash('0567890123', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Fitri Yanti, M.Kom',
                'role'       => 'dosen',
                'kode'       => '0678901234', // NIDN
                'password'   => password_hash('0678901234', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Dr. Gunawan Susanto',
                'role'       => 'dosen',
                'kode'       => '0789012345', // NIDN
                'password'   => password_hash('0789012345', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Hendra Wijaya, M.T',
                'role'       => 'dosen',
                'kode'       => '0890123456', // NIDN
                'password'   => password_hash('0890123456', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Dr. Indira Chandra',
                'role'       => 'dosen',
                'kode'       => '0901234567', // NIDN
                'password'   => password_hash('0901234567', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Joko Santoso, M.Kom',
                'role'       => 'dosen',
                'kode'       => '1012345678', // NIDN
                'password'   => password_hash('1012345678', PASSWORD_DEFAULT), // password = NIDN
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Mahasiswa Users (29 data, password = NIM)
            [
                'nama_user'  => 'Ahmad Rizki Pratama',
                'role'       => 'mahasiswa',
                'kode'       => '2025000001',
                'password'   => password_hash('2025000001', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Siti Nurhaliza Putri',
                'role'       => 'mahasiswa',
                'kode'       => '2025000002',
                'password'   => password_hash('2025000002', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Budi Santoso',
                'role'       => 'mahasiswa',
                'kode'       => '2025000003',
                'password'   => password_hash('2025000003', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Dewi Sartika',
                'role'       => 'mahasiswa',
                'kode'       => '2025000004',
                'password'   => password_hash('2025000004', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Eko Prasetyo',
                'role'       => 'mahasiswa',
                'kode'       => '2025000005',
                'password'   => password_hash('2025000005', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Fitri Handayani',
                'role'       => 'mahasiswa',
                'kode'       => '2025000006',
                'password'   => password_hash('2025000006', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Gilang Ramadhan',
                'role'       => 'mahasiswa',
                'kode'       => '2025000007',
                'password'   => password_hash('2025000007', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Hana Pertiwi',
                'role'       => 'mahasiswa',
                'kode'       => '2025000008',
                'password'   => password_hash('2025000008', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Indra Gunawan',
                'role'       => 'mahasiswa',
                'kode'       => '2025000009',
                'password'   => password_hash('2025000009', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Joko Widodo',
                'role'       => 'mahasiswa',
                'kode'       => '2025000010',
                'password'   => password_hash('2025000010', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Kartika Sari',
                'role'       => 'mahasiswa',
                'kode'       => '2025000011',
                'password'   => password_hash('2025000011', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Lukman Hakim',
                'role'       => 'mahasiswa',
                'kode'       => '2025000012',
                'password'   => password_hash('2025000012', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Maya Sari',
                'role'       => 'mahasiswa',
                'kode'       => '2025000013',
                'password'   => password_hash('2025000013', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Nanda Pratama',
                'role'       => 'mahasiswa',
                'kode'       => '2025000014',
                'password'   => password_hash('2025000014', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Oki Setiana',
                'role'       => 'mahasiswa',
                'kode'       => '2025000015',
                'password'   => password_hash('2025000015', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Putri Maharani',
                'role'       => 'mahasiswa',
                'kode'       => '2025000016',
                'password'   => password_hash('2025000016', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Qori Sumanto',
                'role'       => 'mahasiswa',
                'kode'       => '2025000017',
                'password'   => password_hash('2025000017', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Rina Susanti',
                'role'       => 'mahasiswa',
                'kode'       => '2025000018',
                'password'   => password_hash('2025000018', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Surya Dinata',
                'role'       => 'mahasiswa',
                'kode'       => '2025000019',
                'password'   => password_hash('2025000019', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Tari Wulandari',
                'role'       => 'mahasiswa',
                'kode'       => '2025000020',
                'password'   => password_hash('2025000020', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Umar Bakri',
                'role'       => 'mahasiswa',
                'kode'       => '2025000021',
                'password'   => password_hash('2025000021', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Vina Melinda',
                'role'       => 'mahasiswa',
                'kode'       => '2025000022',
                'password'   => password_hash('2025000022', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Wahyu Setiawan',
                'role'       => 'mahasiswa',
                'kode'       => '2025000023',
                'password'   => password_hash('2025000023', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Xenia Putri',
                'role'       => 'mahasiswa',
                'kode'       => '2025000024',
                'password'   => password_hash('2025000024', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Yudi Pratama',
                'role'       => 'mahasiswa',
                'kode'       => '2025000025',
                'password'   => password_hash('2025000025', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Zahra Amelia',
                'role'       => 'mahasiswa',
                'kode'       => '2025000026',
                'password'   => password_hash('2025000026', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Andi Setiawan',
                'role'       => 'mahasiswa',
                'kode'       => '2025000027',
                'password'   => password_hash('2025000027', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Bella Safitri',
                'role'       => 'mahasiswa',
                'kode'       => '2025000028',
                'password'   => password_hash('2025000028', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_user'  => 'Candra Wijaya',
                'role'       => 'mahasiswa',
                'kode'       => '2025000029',
                'password'   => password_hash('2025000029', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('user')->insertBatch($data);
    }
}