<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        // Run seeders in order (considering foreign key constraints)
        $this->call('DosenSeeder');
        $this->call('RuanganSeeder');
        $this->call('MataKuliahSeeder');
        $this->call('JadwalSeeder');
        
        echo "All seeders completed successfully!\n";
    }
}