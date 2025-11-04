<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NilaiMutuSeeder extends Seeder
{
    public function run()
    {
        $data = $this->generateNilaiMutuData();
        
        $this->db->table('nilai_mutu')->insertBatch($data);
        
        echo "Nilai Mutu data seeded successfully! (" . count($data) . " records)\n";
    }
    
    private function generateNilaiMutuData()
    {
        $grades = [
            ['nilai_huruf' => 'A', 'nilai_mutu' => 4.00],
            ['nilai_huruf' => 'AB', 'nilai_mutu' => 3.50],
            ['nilai_huruf' => 'B', 'nilai_mutu' => 3.00],
            ['nilai_huruf' => 'BC', 'nilai_mutu' => 2.50],
            ['nilai_huruf' => 'C', 'nilai_mutu' => 2.00],
            ['nilai_huruf' => 'D', 'nilai_mutu' => 1.00],
            ['nilai_huruf' => 'E', 'nilai_mutu' => 0.00]
        ];
        
        $data = [];
        
        foreach ($grades as $grade) {
            $data[] = [
                'nilai_huruf' => $grade['nilai_huruf'],
                'nilai_mutu' => $grade['nilai_mutu'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        return $data;
    }
}