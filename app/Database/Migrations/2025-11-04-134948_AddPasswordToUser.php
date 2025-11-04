<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToUser extends Migration
{
    public function up()
    {
        // Menambahkan field password ke tabel user
        $fields = [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'after'      => 'kode', // Posisi setelah field kode
            ],
        ];
        
        $this->forge->addColumn('user', $fields);
    }

    public function down()
    {
        // Menghapus field password jika rollback
        $this->forge->dropColumn('user', 'password');
    }
}
