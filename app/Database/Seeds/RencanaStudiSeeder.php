<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RencanaStudiSeeder extends Seeder
{
    public function run()
    {
        echo "🔄 Membuat ulang data Rencana Studi...\n\n";
        
        // Ambil data mahasiswa, jadwal, dan nilai_mutu yang ada
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $jadwalModel = new \App\Models\JadwalModel();
        
        // Ambil mahasiswa dengan urutan NIM (ascending)
        $mahasiswa = $mahasiswaModel->orderBy('nim', 'ASC')->findAll();
        $jadwal = $jadwalModel->findAll();
        
        // Ambil nilai mutu dari database
        $nilaiMutuData = $this->db->table('nilai_mutu')->get()->getResultArray();
        
        if (empty($mahasiswa)) {
            echo "Data mahasiswa tidak ditemukan. Jalankan seeder mahasiswa terlebih dahulu.\n";
            return;
        }
        
        if (empty($jadwal)) {
            echo "Data jadwal tidak ditemukan. Jalankan seeder jadwal terlebih dahulu.\n";
            return;
        }
        
        if (empty($nilaiMutuData)) {
            echo "Data nilai_mutu tidak ditemukan. Jalankan seeder nilai_mutu terlebih dahulu.\n";
            return;
        }
        
        // Buat array nilai huruf yang tersedia
        $nilaiHurufList = array_column($nilaiMutuData, 'nilai_huruf');
        
        $rencanaStudiData = [];
        
        // Untuk SEMUA mahasiswa, ambil beberapa jadwal secara random
        foreach ($mahasiswa as $mhs) {
            echo "Memproses mahasiswa: {$mhs['nama']} (NIM: {$mhs['nim']})\n";
            
            // Ambil 5-8 mata kuliah secara random untuk setiap mahasiswa
            $jumlahMatkul = rand(5, min(8, count($jadwal)));
            
            // Shuffle jadwal untuk random selection
            $shuffledJadwal = $jadwal;
            shuffle($shuffledJadwal);
            
            // Ambil sejumlah jadwal yang dibutuhkan
            $selectedJadwal = array_slice($shuffledJadwal, 0, $jumlahMatkul);
            
            foreach ($selectedJadwal as $jadwalItem) {
                // SEMUA data BELUM ada nilai (NULL)
                // Nilai akan diisi oleh dosen melalui fitur input nilai
                $rencanaStudiData[] = [
                    'nim' => $mhs['nim'],
                    'id_jadwal' => $jadwalItem['id'],
                    'nilai_angka' => null,
                    'nilai_huruf' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
        }
        
        // Insert data
        if (!empty($rencanaStudiData)) {
            echo "\n🗑️  Menghapus data lama...\n";
            // Hapus data lama dan reset auto increment
            $this->db->table('rencana_studi')->truncate();
            
            // Reset auto increment ke 1
            $this->db->query('ALTER TABLE rencana_studi AUTO_INCREMENT = 1');
            
            echo "💾 Menyimpan data baru...\n";
            // Insert data baru (ID akan dimulai dari 1)
            $this->db->table('rencana_studi')->insertBatch($rencanaStudiData);
            
            echo "\n✅ Berhasil menambahkan " . count($rencanaStudiData) . " data rencana studi untuk " . count($mahasiswa) . " mahasiswa.\n";
            
            echo "\n📊 Statistik:\n";
            echo "   - Total rencana studi: " . count($rencanaStudiData) . "\n";
            echo "   - Status nilai: SEMUA BELUM ADA NILAI (NULL)\n";
            echo "   - Catatan: Nilai akan diisi oleh dosen melalui fitur input nilai\n";
            
            // Tampilkan mahasiswa pertama
            if (!empty($mahasiswa)) {
                echo "\n👤 Mahasiswa Pertama:\n";
                echo "   - NIM: " . $mahasiswa[0]['nim'] . "\n";
                echo "   - Nama: " . $mahasiswa[0]['nama'] . "\n";
                
                // Hitung jumlah rencana studi untuk mahasiswa pertama
                $countFirst = count(array_filter($rencanaStudiData, function($item) use ($mahasiswa) {
                    return $item['nim'] === $mahasiswa[0]['nim'];
                }));
                echo "   - Jumlah mata kuliah: " . $countFirst . "\n";
            }
            
            echo "\n✨ Data rencana studi berhasil dibuat ulang dengan ID dimulai dari 1!\n";
        }
    }
    
    /**
     * Generate nilai angka berdasarkan nilai huruf
     * Mengikuti standar yang ada di tabel nilai_mutu
     */
    private function generateNilaiAngka($nilaiHuruf)
    {
        // Range nilai angka untuk setiap nilai huruf
        $ranges = [
            'A'  => [85, 100],  // 4.00
            'A-' => [80, 84],   // 3.50
            'B'  => [70, 79],   // 3.00
            'B-' => [65, 69],   // 2.50
            'C'  => [55, 64],   // 2.00
            'D'  => [40, 54],   // 1.00
            'E'  => [0, 39]     // 0.00
        ];
        
        if (isset($ranges[$nilaiHuruf])) {
            return rand($ranges[$nilaiHuruf][0], $ranges[$nilaiHuruf][1]);
        }
        
        return rand(55, 85); // Default jika tidak ditemukan
    }
}
