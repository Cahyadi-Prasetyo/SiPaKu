<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToRencanaStudi extends Migration
{
    public function up()
    {
        // Tambahkan field krs_status di tabel mahasiswa
        $fields = [
            'krs_status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'submitted', 'approved'],
                'default' => 'draft',
                'null' => false
            ]
        ];
        
        $this->forge->addColumn('mahasiswa', $fields);
    }

    public function down()
    {
        // Hapus field krs_status
        $this->forge->dropColumn('mahasiswa', 'krs_status');
    }
}
