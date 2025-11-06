<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\JadwalModel;
use App\Models\MataKuliahModel;

class DosenController extends BaseController
{
    protected $dosenModel;
    protected $jadwalModel;
    protected $mataKuliahModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->jadwalModel = new JadwalModel();
        $this->mataKuliahModel = new MataKuliahModel();
    }

    public function dashboard()
    {
        // Set timezone user (bisa dari database atau session)
        set_user_timezone();
        
        $nidn = session()->get('kode');
        
        // Ambil data dosen berdasarkan NIDN
        $dosen = $this->dosenModel->where('nidn', $nidn)->first();
        
        if (!$dosen) {
            return redirect()->to('/login')->with('error', 'Data dosen tidak ditemukan');
        }

        // Get statistics
        $stats = [
            'total_jadwal' => $this->jadwalModel->where('nidn', $nidn)->countAllResults(),
            'total_mahasiswa' => $this->getTotalMahasiswa($nidn),
            'total_matkul' => $this->getTotalMataKuliah($nidn),
            'nilai_pending' => $this->getNilaiPending($nidn)
        ];

        $data = [
            'title' => 'Dashboard Dosen',
            'breadcrumb' => 'Dashboard',
            'dosen' => $dosen,
            'stats' => $stats,
            'jadwal_hari_ini' => $this->getJadwalHariIni($nidn)
        ];

        return view('dosen/dashboard', $data);
    }

    public function jadwal()
    {
        $nidn = session()->get('kode');
        
        // Get all jadwal for this dosen
        $jadwalMengajar = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('jadwal.nidn', $nidn)
            ->orderBy('jadwal.hari', 'DESC')
            ->orderBy('jadwal.jam', 'ASC')
            ->findAll();

        // Get ruangan list for filter
        $ruanganList = $this->jadwalModel
            ->select('ruangan.nama_ruangan')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('jadwal.nidn', $nidn)
            ->groupBy('ruangan.nama_ruangan')
            ->findAll();

        // Get statistics
        $stats = [
            'total_jadwal' => count($jadwalMengajar),
            'total_mahasiswa' => $this->getTotalMahasiswa($nidn),
            'total_matkul' => $this->getTotalMataKuliah($nidn),
            'nilai_pending' => $this->getNilaiPending($nidn)
        ];

        $data = [
            'title' => 'Jadwal Mengajar',
            'breadcrumb' => 'Jadwal Mengajar',
            'jadwal_mengajar' => $jadwalMengajar,
            'ruangan_list' => $ruanganList,
            'stats' => $stats
        ];

        return view('dosen/jadwal', $data);
    }

    public function nilai()
    {
        $nidn = session()->get('kode');
        
        // Get all jadwal for this dosen
        $jadwalMengajar = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('jadwal.nidn', $nidn)
            ->orderBy('jadwal.hari', 'DESC')
            ->orderBy('jadwal.jam', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Input Nilai Mahasiswa',
            'breadcrumb' => 'Input Nilai',
            'jadwal_mengajar' => $jadwalMengajar
        ];

        return view('dosen/nilai_input', $data);
    }

    public function getMahasiswaByJadwal($jadwalId)
    {
        $nidn = session()->get('kode');
        
        // Verify that this jadwal belongs to the logged-in dosen
        $jadwal = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('jadwal.id', $jadwalId)
            ->where('jadwal.nidn', $nidn)
            ->first();

        if (!$jadwal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan atau bukan milik Anda'
            ]);
        }

        // Get mahasiswa for this jadwal
        $rencanaStudiModel = new \App\Models\RencanaStudiModel();
        $mahasiswa = $rencanaStudiModel->getMahasiswaByJadwal($jadwalId);

        return $this->response->setJSON([
            'success' => true,
            'jadwal' => $jadwal,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function saveNilai()
    {
        $nidn = session()->get('kode');
        $jadwalId = $this->request->getPost('jadwal_id');
        $nilaiData = $this->request->getPost('nilai');

        // Verify that this jadwal belongs to the logged-in dosen
        $jadwal = $this->jadwalModel->where('id', $jadwalId)->where('nidn', $nidn)->first();
        
        if (!$jadwal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan atau bukan milik Anda'
            ]);
        }

        $rencanaStudiModel = new \App\Models\RencanaStudiModel();
        $successCount = 0;
        $errors = [];

        foreach ($nilaiData as $data) {
            if (!empty($data['nilai_angka'])) {
                $nilaiHuruf = $this->convertToHuruf($data['nilai_angka']);
                
                $result = $rencanaStudiModel->updateNilai(
                    $data['nim'],
                    $jadwalId,
                    $data['nilai_angka'],
                    $nilaiHuruf
                );

                if ($result) {
                    $successCount++;
                } else {
                    $errors[] = "Gagal menyimpan nilai untuk NIM: " . $data['nim'];
                }
            }
        }

        if ($successCount > 0) {
            return $this->response->setJSON([
                'success' => true,
                'message' => "Berhasil menyimpan {$successCount} nilai",
                'errors' => $errors
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak ada nilai yang disimpan',
                'errors' => $errors
            ]);
        }
    }

    private function convertToHuruf($nilaiAngka)
    {
        $nilai = floatval($nilaiAngka);
        
        if ($nilai >= 85) return 'A';
        if ($nilai >= 80) return 'A-';
        if ($nilai >= 75) return 'B+';
        if ($nilai >= 70) return 'B';
        if ($nilai >= 65) return 'B-';
        if ($nilai >= 60) return 'C+';
        if ($nilai >= 55) return 'C';
        if ($nilai >= 50) return 'C-';
        if ($nilai >= 45) return 'D+';
        if ($nilai >= 40) return 'D';
        return 'E';
    }

    private function getJadwalHariIni($nidn)
    {
        $hari = $this->getHariIndonesia();
        
        return $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('jadwal.nidn', $nidn)
            ->where('jadwal.hari', $hari)
            ->orderBy('jadwal.jam', 'ASC')
            ->findAll();
    }

    private function getMataKuliahDosen($nidn)
    {
        return $this->jadwalModel
            ->select('mata_kuliah.kode_mata_kuliah, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('jadwal.nidn', $nidn)
            ->groupBy('mata_kuliah.id_mata_kuliah')
            ->findAll();
    }

    private function getTotalMahasiswa($nidn)
    {
        $rencanaStudiModel = new \App\Models\RencanaStudiModel();
        return $rencanaStudiModel->getTotalMahasiswaByDosen($nidn);
    }

    private function getTotalMataKuliah($nidn)
    {
        return $this->jadwalModel
            ->select('mata_kuliah.id_mata_kuliah')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('jadwal.nidn', $nidn)
            ->groupBy('mata_kuliah.id_mata_kuliah')
            ->countAllResults();
    }

    private function getNilaiPending($nidn)
    {
        $rencanaStudiModel = new \App\Models\RencanaStudiModel();
        return $rencanaStudiModel->getNilaiPendingByDosen($nidn);
    }


    private function getHariIndonesia()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return $hari[date('w')];
    }
}