<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\RencanaStudiModel;
use App\Models\NilaiModel;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;
    protected $rencanaStudiModel;
    protected $nilaiModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->rencanaStudiModel = new RencanaStudiModel();
        $this->nilaiModel = new NilaiModel();
    }

    public function dashboard()
    {
        $nim = session()->get('kode');
        
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->mahasiswaModel->where('nim', $nim)->first();
        
        if (!$mahasiswa) {
            return redirect()->to('/login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $data = [
            'title' => 'Dashboard Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'totalSKS' => $this->getTotalSKS($nim),
            'ipk' => $this->calculateIPK($nim),
            'jadwalHariIni' => $this->getJadwalHariIni($nim),
            'rencanaStudi' => $this->getRencanaStudiAktif($nim)
        ];

        return view('mahasiswa/dashboard', $data);
    }

    private function getTotalSKS($nim)
    {
        $result = $this->rencanaStudiModel
            ->select('SUM(mata_kuliah.sks) as total_sks')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->first();
            
        return $result['total_sks'] ?? 0;
    }

    private function calculateIPK($nim)
    {
        // Ambil semua nilai mahasiswa
        $nilaiList = $this->rencanaStudiModel
            ->select('rencana_studi.nilai_angka, mata_kuliah.sks')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('rencana_studi.nilai_angka IS NOT NULL')
            ->findAll();

        if (empty($nilaiList)) {
            return 0;
        }

        $totalBobot = 0;
        $totalSKS = 0;

        foreach ($nilaiList as $nilai) {
            $bobot = $this->convertNilaiToBobot($nilai['nilai_angka']);
            $totalBobot += $bobot * $nilai['sks'];
            $totalSKS += $nilai['sks'];
        }

        return $totalSKS > 0 ? round($totalBobot / $totalSKS, 2) : 0;
    }

    private function convertNilaiToBobot($nilaiAngka)
    {
        if ($nilaiAngka >= 85) return 4.0;
        if ($nilaiAngka >= 80) return 3.7;
        if ($nilaiAngka >= 75) return 3.3;
        if ($nilaiAngka >= 70) return 3.0;
        if ($nilaiAngka >= 65) return 2.7;
        if ($nilaiAngka >= 60) return 2.3;
        if ($nilaiAngka >= 55) return 2.0;
        if ($nilaiAngka >= 50) return 1.7;
        if ($nilaiAngka >= 45) return 1.3;
        if ($nilaiAngka >= 40) return 1.0;
        return 0;
    }

    private function getJadwalHariIni($nim)
    {
        $hari = $this->getHariIndonesia();
        
        return $this->rencanaStudiModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, ruangan.nama_ruangan, dosen.nama as nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->where('rencana_studi.nim', $nim)
            ->where('jadwal.hari', $hari)
            ->orderBy('jadwal.jam', 'ASC')
            ->findAll();
    }

    private function getRencanaStudiAktif($nim)
    {
        return $this->rencanaStudiModel
            ->select('rencana_studi.*, mata_kuliah.kode_mata_kuliah, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, jadwal.hari, jadwal.jam, ruangan.nama_ruangan, dosen.nama as nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->where('rencana_studi.nim', $nim)
            ->findAll();
    }

    private function getHariIndonesia()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return $hari[date('w')];
    }
}