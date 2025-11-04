<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'id_mata_kuliah' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_ruangan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'nidn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
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
        $this->forge->addKey('id', true); // PK
        $this->forge->addForeignKey('id_mata_kuliah', 'mata_kuliah', 'id_mata_kuliah', 'CASCADE', 'CASCADE'); // FK
        $this->forge->addForeignKey('id_ruangan', 'ruangan', 'id_ruangan', 'CASCADE', 'CASCADE'); // FK
        $this->forge->addForeignKey('nidn', 'dosen', 'nidn', 'CASCADE', 'CASCADE'); // FK
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        //
    }
}
