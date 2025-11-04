<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RencanaStudi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rencana_studi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'id_jadwal' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nilai_angka' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ],
            'nilai_huruf' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_rencana_studi', true); // PK
        $this->forge->addForeignKey('nim', 'mahasiswa', 'nim', 'CASCADE', 'CASCADE'); // FK
        $this->forge->addForeignKey('id_jadwal', 'jadwal', 'id', 'CASCADE', 'CASCADE'); // FK
        $this->forge->addForeignKey('nilai_huruf', 'nilai_mutu', 'nilai_huruf', 'CASCADE', 'CASCADE'); // FK
        $this->forge->createTable('rencana_studi');
    }

    public function down()
    {
        //
    }
}
