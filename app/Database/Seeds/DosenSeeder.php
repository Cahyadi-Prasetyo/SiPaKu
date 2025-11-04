<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nidn' => '0001018501',
                'nama' => 'Prof. Dr. Budi Santoso, M.Kom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0002019001',
                'nama' => 'Dr. Ahmad Susanto, M.T',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0003019002',
                'nama' => 'Dr. Siti Nurhaliza, M.Kom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0004020001',
                'nama' => 'Eko Prasetyo, M.Kom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0005020002',
                'nama' => 'Dewi Lestari, M.T',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0006019003',
                'nama' => 'Dr. Fitri Handayani, M.Kom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0007020003',
                'nama' => 'Gilang Ramadhan, M.T',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nidn' => '0008021001',
                'nama' => 'Hana Pertiwi, M.Kom',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('dosen')->insertBatch($data);
    }
}