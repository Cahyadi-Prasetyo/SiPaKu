<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = $this->generateMahasiswaData();
        
        $this->db->table('mahasiswa')->insertBatch($data);
        
        echo "Mahasiswa data seeded successfully! (" . count($data) . " records)\n";
    }
    
    private function generateMahasiswaData()
    {
        $names = [
            'Ahmad Rizki Pratama',
            'Siti Nurhaliza Putri',
            'Budi Santoso',
            'Dewi Sartika',
            'Eko Prasetyo',
            'Fitri Handayani',
            'Gilang Ramadhan',
            'Hana Pertiwi',
            'Indra Gunawan',
            'Joko Widodo',
            'Kartika Sari',
            'Lukman Hakim',
            'Maya Sari',
            'Nanda Pratama',
            'Oki Setiana',
            'Putri Maharani',
            'Qori Sumanto',
            'Rina Susanti',
            'Surya Dinata',
            'Tari Wulandari'
        ];
        
        $data = [];
        $currentYear = date('Y');
        
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'nim' => $currentYear . sprintf('%06d', $i + 1),
                'nama' => $names[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        return $data;
    }
}