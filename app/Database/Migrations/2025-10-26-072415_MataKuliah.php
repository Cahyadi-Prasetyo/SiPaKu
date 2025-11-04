<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MataKuliah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mata_kuliah' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_mata_kuliah' => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'nama_mata_kuliah' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sks' => [
                'type'       => 'INT',
                'constraint' => 2,
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
        $this->forge->addKey('id_mata_kuliah', true); // PK
        $this->forge->createTable('mata_kuliah');
    }

    public function down()
    {
        //
    }
}
