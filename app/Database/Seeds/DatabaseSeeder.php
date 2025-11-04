<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        try {
            // Start transaction for data consistency
            $this->db->transStart();
            
            // Clear existing data first
            $this->clearTables();
            
            // Seed independent tables first (no foreign keys)
            echo "Seeding independent tables...\n";
            $this->call('MahasiswaSeeder');
            $this->call('DosenSeeder');
            $this->call('MataKuliahSeeder');
            $this->call('RuanganSeeder');
            $this->call('NilaiMutuSeeder');
            
            // Seed dependent tables (with foreign keys)
            echo "Seeding dependent tables...\n";
            $this->call('JadwalSeeder');
            $this->call('RencanaStudiSeeder');
            $this->call('UserSeeder');
            
            // Complete transaction
            $this->db->transComplete();
            
            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaction failed during seeding process');
            }
            
            echo "\n=== Database seeding completed successfully! ===\n";
            echo "Summary:\n";
            echo "- 20 Mahasiswa records\n";
            echo "- 10 Dosen records\n";
            echo "- 15 Mata Kuliah records\n";
            echo "- 8 Ruangan records\n";
            echo "- 7 Nilai Mutu records\n";
            echo "- 30 Jadwal records\n";
            echo "- 100+ Rencana Studi records\n";
            echo "- 33 User records\n";
            
        } catch (\Exception $e) {
            echo "Error during seeding: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
    
    private function clearTables()
    {
        // Disable foreign key checks temporarily
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        
        // Clear tables in reverse dependency order
        $tables = [
            'user',
            'rencana_studi', 
            'jadwal',
            'nilai_mutu',
            'ruangan',
            'mata_kuliah',
            'dosen',
            'mahasiswa'
        ];
        
        foreach ($tables as $table) {
            $this->db->table($table)->truncate();
        }
        
        // Re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
        
        echo "Existing data cleared.\n";
    }
}