<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserRelations extends Migration
{
    public function up()
    {
        // Menambahkan kolom untuk relasi user dengan mahasiswa/dosen
        $this->forge->addColumn('user', [
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'kode'
            ],
            'nidn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'nim'
            ]
        ]);
        
        // Menambahkan foreign key constraints
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim', 'SET NULL', 'CASCADE', 'user');
        $this->forge->addForeignKey('nidn', 'dosen', 'nidn', 'SET NULL', 'CASCADE', 'user');
    }

    public function down()
    {
        // Menghapus foreign key constraints
        $this->forge->dropForeignKey('user', 'user_nim_foreign');
        $this->forge->dropForeignKey('user', 'user_nidn_foreign');
        
        // Menghapus kolom
        $this->forge->dropColumn('user', ['nim', 'nidn']);
    }
}
