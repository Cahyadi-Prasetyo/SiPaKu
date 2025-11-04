<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RencanaStudiSeeder extends Seeder
{
    public function run()
    {
        $data = $this->generateRencanaStudiData();
        
        $this->db->table('rencana_studi')->insertBatch($data);
        
        echo "Rencana Studi data seeded successfully! (" . count($data) . " records)\n";
    }
    
    private function generateRencanaStudiData()
    {
        $grades = ['A', 'AB', 'B', 'BC', 'C', 'D', 'E'];
        $gradeWeights = [20, 25, 30, 15, 7, 2, 1]; // Percentage distribution
        
        $data = [];
        $currentYear = date('Y');
        
        // Generate enrollments for each student
        for ($studentIndex = 1; $studentIndex <= 20; $studentIndex++) {
            $nim = $currentYear . sprintf('%06d', $studentIndex);
            
            // Each student enrolls in 5-8 random courses
            $numCourses = rand(5, 8);
            $enrolledJadwalIds = [];
            
            for ($i = 0; $i < $numCourses; $i++) {
                // Select random jadwal (1-30, since we have 10 courses x 3 classes)
                do {
                    $jadwalId = rand(1, 30);
                } while (in_array($jadwalId, $enrolledJadwalIds));
                
                $enrolledJadwalIds[] = $jadwalId;
                
                // Generate grade based on weighted distribution
                $grade = $this->getWeightedRandomGrade($grades, $gradeWeights);
                $nilaiAngka = $this->generateNilaiAngka($grade);
                
                $data[] = [
                    'nim' => $nim,
                    'id_jadwal' => $jadwalId,
                    'nilai_huruf' => $grade,
                    'nilai_angka' => $nilaiAngka,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        
        return $data;
    }
    
    private function getWeightedRandomGrade($grades, $weights)
    {
        $totalWeight = array_sum($weights);
        $random = rand(1, $totalWeight);
        
        $currentWeight = 0;
        for ($i = 0; $i < count($grades); $i++) {
            $currentWeight += $weights[$i];
            if ($random <= $currentWeight) {
                return $grades[$i];
            }
        }
        
        return $grades[0]; // fallback
    }
    
    private function generateNilaiAngka($grade)
    {
        switch ($grade) {
            case 'A':
                return rand(85, 100) + (rand(0, 99) / 100);
            case 'AB':
                return rand(80, 84) + (rand(0, 99) / 100);
            case 'B':
                return rand(75, 79) + (rand(0, 99) / 100);
            case 'BC':
                return rand(70, 74) + (rand(0, 99) / 100);
            case 'C':
                return rand(60, 69) + (rand(0, 99) / 100);
            case 'D':
                return rand(50, 59) + (rand(0, 99) / 100);
            case 'E':
                return rand(0, 49) + (rand(0, 99) / 100);
            default:
                return 75.00;
        }
    }
}