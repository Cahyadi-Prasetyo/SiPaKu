<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveUnusedFieldsFromUser extends Migration
{
    public function up()
    {
        // Migration ini tidak diperlukan karena field email, nim, nidn 
        // tidak ada di struktur tabel user yang final
        // Dibiarkan kosong untuk menghindari error
    }

    public function down()
    {
        // Tidak ada yang perlu di-rollback
    }
}
