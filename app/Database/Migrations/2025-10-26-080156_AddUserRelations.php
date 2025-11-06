<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserRelations extends Migration
{
    public function up()
    {
        // Migration ini tidak diperlukan karena struktur final user table
        // tidak menggunakan relasi langsung ke mahasiswa/dosen
        // User table hanya menggunakan field 'kode' untuk identifikasi
        // Dibiarkan kosong untuk menghindari konflik dengan migration selanjutnya
    }

    public function down()
    {
        // Tidak ada yang perlu di-rollback
    }
}
