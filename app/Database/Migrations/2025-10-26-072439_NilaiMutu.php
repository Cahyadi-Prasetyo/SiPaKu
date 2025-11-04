<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NilaiMutu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nilai_huruf' => [
                'type'       => 'VARCHAR',
                'constraint' => '2',
            ],
            'nilai_mutu' => [
                'type'       => 'DECIMAL',
                'constraint' => '3,2',
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
        $this->forge->addKey('nilai_huruf', true); // PK
        $this->forge->createTable('nilai_mutu');
    }

    public function down()
    {
        //
    }
}
