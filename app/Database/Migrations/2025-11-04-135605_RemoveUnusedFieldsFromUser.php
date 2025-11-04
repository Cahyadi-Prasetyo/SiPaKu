<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveUnusedFieldsFromUser extends Migration
{
    public function up()
    {
        // Menghapus field yang tidak diperlukan dari tabel user
        $this->forge->dropColumn('user', ['email', 'nim', 'nidn']);
    }

    public function down()
    {
        // Menambahkan kembali field jika rollback
        $fields = [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
                'after'      => 'nama_user',
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'password',
            ],
            'nidn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'nim',
            ],
        ];
        
        $this->forge->addColumn('user', $fields);
    }
}
