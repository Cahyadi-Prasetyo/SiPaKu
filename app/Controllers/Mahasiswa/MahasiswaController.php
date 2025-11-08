<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\RencanaStudiModel;
use App\Models\JadwalModel;
use App\Models\MataKuliahModel;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;
    protected $rencanaStudiModel;
    protected $jadwalModel;
    protected $mataKuliahModel;
    protected $nilaiMutuModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->rencanaStudiModel = new RencanaStudiModel();
        $this->jadwalModel = new JadwalModel();
        $this->mataKuliahModel = new MataKuliahModel();
        $this->nilaiMutuModel = new \App\Models\NilaiMutuModel();
    }

    public function dashboard()
    {
        // Set timezone user (bisa dari database atau session)
        set_user_timezone();
        
        $nim = session()->get('kode');
        
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->mahasiswaModel->where('nim', $nim)->first();
        
        if (!$mahasiswa) {
            return redirect()->to('/login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        // Get statistics
        $stats = [
            'total_sks' => $this->getTotalSKS($nim),
            'ipk' => $this->getIPK($nim),
            'semester_aktif' => $this->getSemesterAktif($nim),
            'mata_kuliah_aktif' => $this->getMataKuliahAktif($nim)
        ];

        $data = [
            'title' => 'Dashboard Mahasiswa',
            'breadcrumb' => 'Dashboard',
            'mahasiswa' => $mahasiswa,
            'stats' => $stats,
            'jadwal_hari_ini' => $this->getJadwalHariIni($nim)
        ];

        return view('mahasiswa/dashboard', $data);
    }

    public function jadwal()
    {
        $nim = session()->get('kode');
        
        // Get all jadwal for this mahasiswa
        $jadwalKuliah = $this->rencanaStudiModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, ruangan.nama_ruangan, dosen.nama as nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->where('rencana_studi.nim', $nim)
            ->orderBy('FIELD(jadwal.hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")')
            ->orderBy('jadwal.jam', 'ASC')
            ->findAll();

        // Get statistics
        $stats = [
            'total_sks' => $this->getTotalSKS($nim),
            'ipk' => $this->getIPK($nim),
            'semester_aktif' => $this->getSemesterAktif($nim),
            'mata_kuliah_aktif' => $this->getMataKuliahAktif($nim)
        ];

        $data = [
            'title' => 'Jadwal Kuliah',
            'breadcrumb' => 'Jadwal Kuliah',
            'jadwal_kuliah' => $jadwalKuliah,
            'stats' => $stats
        ];

        return view('mahasiswa/jadwal', $data);
    }

    public function nilai()
    {
        $nim = session()->get('kode');
        
        // Get all nilai for this mahasiswa (rencana studi)
        $rencanaStudi = $this->rencanaStudiModel
            ->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, mata_kuliah.kode_mata_kuliah, dosen.nama as nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->where('rencana_studi.nim', $nim)
            ->orderBy('mata_kuliah.nama_mata_kuliah', 'ASC')
            ->findAll();

        // Get transkrip (hanya yang sudah ada nilai)
        $transkrip = $this->rencanaStudiModel
            ->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, mata_kuliah.kode_mata_kuliah')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('rencana_studi.nilai_huruf IS NOT NULL')
            ->orderBy('mata_kuliah.nama_mata_kuliah', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Nilai & Transkrip',
            'breadcrumb' => 'Nilai & Transkrip',
            'rencana_studi' => $rencanaStudi,
            'transkrip' => $transkrip,
            'ipk' => $this->getIPK($nim),
            'total_sks' => $this->getTotalSKS($nim)
        ];

        return view('mahasiswa/nilai', $data);
    }

    public function krs()
    {
        $nim = session()->get('kode');
        
        // Cek status KRS mahasiswa
        $mahasiswa = $this->mahasiswaModel->where('nim', $nim)->first();
        $krsStatus = $mahasiswa['krs_status'] ?? 'draft';
        
        // Mahasiswa hanya bisa input/edit KRS jika status masih 'draft'
        $canInputKRS = ($krsStatus === 'draft');
        
        // Get KRS aktif
        $krsAktif = $this->rencanaStudiModel
            ->select('rencana_studi.id_rencana_studi, rencana_studi.nim, rencana_studi.id_jadwal, 
                      mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, mata_kuliah.kode_mata_kuliah, 
                      jadwal.hari, jadwal.jam, jadwal.id as id_jadwal, 
                      dosen.nama as nama_dosen, 
                      ruangan.nama_ruangan')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal', 'left')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->where('rencana_studi.nim', $nim)
            ->findAll();

        // Get mata kuliah tersedia (semua jadwal yang belum diambil)
        $jadwalDiambil = !empty($krsAktif) ? array_column($krsAktif, 'id_jadwal') : [];
        
        $query = $this->jadwalModel
            ->select('jadwal.id, jadwal.hari, jadwal.jam, jadwal.id_mata_kuliah, jadwal.nidn, jadwal.id_ruangan,
                      mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, mata_kuliah.kode_mata_kuliah, 
                      dosen.nama as nama_dosen, 
                      ruangan.nama_ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left');
        
        // Only add whereNotIn if there are jadwal already taken
        if (!empty($jadwalDiambil)) {
            $query->whereNotIn('jadwal.id', $jadwalDiambil);
        }
        
        $mataKuliahTersedia = $query->findAll();

        $data = [
            'title' => 'Kartu Rencana Studi',
            'breadcrumb' => 'KRS',
            'krs_aktif' => $krsAktif,
            'mata_kuliah_tersedia' => $mataKuliahTersedia,
            'total_sks' => $this->getTotalSKSAktif($nim),
            'can_input_krs' => $canInputKRS,
            'krs_status' => $krsStatus
        ];

        return view('mahasiswa/krs', $data);
    }

    public function addKRS()
    {
        $json = $this->request->getJSON();
        $nim = session()->get('kode');
        $jadwalId = $json->jadwal_id ?? null;

        if (!$jadwalId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal ID tidak ditemukan'
            ]);
        }

        // Check if already exists
        $existing = $this->rencanaStudiModel
            ->where('nim', $nim)
            ->where('id_jadwal', $jadwalId)
            ->first();

        if ($existing) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Mata kuliah sudah ada dalam KRS'
            ]);
        }

        // Get jadwal info
        $jadwal = $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.sks, mata_kuliah.nama_mata_kuliah, mata_kuliah.id_mata_kuliah')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('jadwal.id', $jadwalId)
            ->first();

        if (!$jadwal) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal tidak ditemukan'
            ]);
        }

        // Check if same mata kuliah already taken (different class/schedule)
        $sameMatkul = $this->rencanaStudiModel
            ->select('mata_kuliah.nama_mata_kuliah')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('mata_kuliah.id_mata_kuliah', $jadwal['id_mata_kuliah'])
            ->first();

        if ($sameMatkul) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anda sudah mengambil mata kuliah ' . $sameMatkul['nama_mata_kuliah']
            ]);
        }

        // Check SKS limit (24 SKS)
        $currentSKS = $this->getTotalSKSAktif($nim);
        if ($currentSKS + $jadwal['sks'] > 24) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Melebihi batas maksimal 24 SKS'
            ]);
        }

        // Check for schedule conflict
        $conflict = $this->checkScheduleConflict($nim, $jadwal['hari'], $jadwal['jam']);
        if ($conflict) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal bentrok dengan ' . $conflict['nama_mata_kuliah'] . ' (' . $conflict['hari'] . ', ' . $conflict['jam'] . ')'
            ]);
        }

        // Insert to rencana_studi
        $result = $this->rencanaStudiModel->insert([
            'nim' => $nim,
            'id_jadwal' => $jadwalId,
            'nilai_angka' => null,
            'nilai_huruf' => null
        ]);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Mata kuliah berhasil ditambahkan ke KRS',
                'total_sks' => $currentSKS + $jadwal['sks']
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menambahkan mata kuliah'
            ]);
        }
    }

    public function removeKRS()
    {
        $json = $this->request->getJSON();
        $nim = session()->get('kode');
        $jadwalId = $json->jadwal_id ?? null;

        if (!$jadwalId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Jadwal ID tidak ditemukan'
            ]);
        }

        // Delete from rencana_studi
        $result = $this->rencanaStudiModel
            ->where('nim', $nim)
            ->where('id_jadwal', $jadwalId)
            ->delete();

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Mata kuliah berhasil dihapus dari KRS',
                'total_sks' => $this->getTotalSKSAktif($nim)
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menghapus mata kuliah'
            ]);
        }
    }

    public function submitKRS()
    {
        $json = $this->request->getJSON();
        $nim = session()->get('kode');
        $totalSKS = $json->total_sks ?? 0;
        $totalMatkul = $json->total_matkul ?? 0;

        if ($totalMatkul == 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Belum ada mata kuliah yang dipilih'
            ]);
        }

        // Cek status KRS saat ini
        $mahasiswa = $this->mahasiswaModel->where('nim', $nim)->first();
        if ($mahasiswa['krs_status'] !== 'draft') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'KRS sudah diajukan sebelumnya dan tidak dapat diubah'
            ]);
        }

        // Update status KRS menjadi 'submitted'
        try {
            $db = \Config\Database::connect();
            $db->table('mahasiswa')
                ->where('nim', $nim)
                ->update(['krs_status' => 'submitted']);
        } catch (\Exception $e) {
            log_message('error', 'Submit KRS Error: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate status KRS: ' . $e->getMessage()
            ]);
        }
        
        return $this->response->setJSON([
            'success' => true,
            'message' => 'KRS berhasil diajukan dan menunggu persetujuan. KRS tidak dapat diubah lagi.',
            'total_sks' => $totalSKS,
            'total_matkul' => $totalMatkul
        ]);
    }

    public function printKRS()
    {
        $nim = session()->get('kode');
        
        // Get mahasiswa data
        $mahasiswa = $this->mahasiswaModel->where('nim', $nim)->first();
        
        // Get KRS aktif
        $krsAktif = $this->rencanaStudiModel
            ->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, mata_kuliah.kode_mata_kuliah, jadwal.hari, jadwal.jam, dosen.nama as nama_dosen, ruangan.nama_ruangan')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->where('rencana_studi.nim', $nim)
            ->orderBy('mata_kuliah.nama_mata_kuliah', 'ASC')
            ->findAll();

        $data = [
            'title' => 'Cetak KRS',
            'mahasiswa' => $mahasiswa,
            'krs_aktif' => $krsAktif,
            'total_sks' => $this->getTotalSKSAktif($nim),
            'semester' => $this->getSemesterAktif($nim),
            'tahun_akademik' => '2024/2025'
        ];

        return view('mahasiswa/krs_print', $data);
    }

    private function checkScheduleConflict($nim, $hari, $jam)
    {
        // Get existing schedules
        $existingSchedules = $this->rencanaStudiModel
            ->select('jadwal.hari, jadwal.jam, mata_kuliah.nama_mata_kuliah')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('jadwal.hari', $hari)
            ->findAll();

        foreach ($existingSchedules as $schedule) {
            if ($this->isTimeOverlap($schedule['jam'], $jam)) {
                return $schedule;
            }
        }

        return false;
    }

    private function isTimeOverlap($time1, $time2)
    {
        // Simple time overlap check
        // Format: "08:00-10:00"
        $parts1 = explode('-', $time1);
        $parts2 = explode('-', $time2);

        if (count($parts1) != 2 || count($parts2) != 2) {
            return false;
        }

        $start1 = strtotime($parts1[0]);
        $end1 = strtotime($parts1[1]);
        $start2 = strtotime($parts2[0]);
        $end2 = strtotime($parts2[1]);

        // Check if times overlap
        return ($start1 < $end2 && $end1 > $start2);
    }

    public function hasilStudi()
    {
        $nim = session()->get('kode');
        
        // Get hasil studi (hanya yang sudah ada nilai)
        $hasilStudi = $this->rencanaStudiModel
            ->select('rencana_studi.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, mata_kuliah.kode_mata_kuliah')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('rencana_studi.nilai_huruf IS NOT NULL')
            ->orderBy('mata_kuliah.nama_mata_kuliah', 'ASC')
            ->findAll();

        // Calculate statistics
        $totalSKS = 0;
        $totalSKSLulus = 0;
        $totalNilaiMutu = 0;
        $totalNilai = 0;
        $totalMatkul = count($hasilStudi);

        foreach ($hasilStudi as $hs) {
            $bobot = $this->getNilaiBobot($hs['nilai_huruf']);
            $nilaiMutu = $bobot * $hs['sks'];
            
            $totalSKS += $hs['sks'];
            $totalNilaiMutu += $nilaiMutu;
            $totalNilai += floatval($hs['nilai_angka']);
            
            // SKS Lulus (nilai >= C atau bobot >= 2.0)
            if ($bobot >= 2.0) {
                $totalSKSLulus += $hs['sks'];
            }
        }

        $ipk = $totalSKS > 0 ? $totalNilaiMutu / $totalSKS : 0;
        $rataRataNilai = $totalMatkul > 0 ? $totalNilai / $totalMatkul : 0;

        $data = [
            'title' => 'Hasil Studi',
            'breadcrumb' => 'Hasil Studi',
            'hasil_studi' => $hasilStudi,
            'ipk' => $ipk,
            'total_sks' => $totalSKS,
            'total_sks_lulus' => $totalSKSLulus,
            'total_matkul' => $totalMatkul,
            'total_nilai_mutu' => $totalNilaiMutu,
            'rata_rata_nilai' => $rataRataNilai
        ];

        return view('mahasiswa/hasil_studi', $data);
    }

    private function getJadwalHariIni($nim)
    {
        $hari = $this->getHariIndonesia();
        
        return $this->rencanaStudiModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, mata_kuliah.sks, ruangan.nama_ruangan, dosen.nama as nama_dosen')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan')
            ->join('dosen', 'dosen.nidn = jadwal.nidn')
            ->where('rencana_studi.nim', $nim)
            ->where('jadwal.hari', $hari)
            ->orderBy('jadwal.jam', 'ASC')
            ->findAll();
    }

    private function getTotalSKS($nim)
    {
        $result = $this->rencanaStudiModel
            ->select('SUM(mata_kuliah.sks) as total_sks')
            ->join('jadwal', 'rencana_studi.id_jadwal = jadwal.id')
            ->join('mata_kuliah', 'jadwal.id_mata_kuliah = mata_kuliah.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('rencana_studi.nilai_huruf IS NOT NULL')
            ->where('rencana_studi.nilai_huruf !=', 'E')
            ->first();
        
        return $result['total_sks'] ?? 0;
    }

    private function getTotalSKSAktif($nim)
    {
        $result = $this->rencanaStudiModel
            ->select('SUM(mata_kuliah.sks) as total_sks')
            ->join('jadwal', 'rencana_studi.id_jadwal = jadwal.id')
            ->join('mata_kuliah', 'jadwal.id_mata_kuliah = mata_kuliah.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->first();
        
        return $result['total_sks'] ?? 0;
    }

    private function getIPK($nim)
    {
        // Simulasi perhitungan IPK
        $rencanaStudi = $this->rencanaStudiModel
            ->select('rencana_studi.nilai_huruf, mata_kuliah.sks')
            ->join('jadwal', 'rencana_studi.id_jadwal = jadwal.id')
            ->join('mata_kuliah', 'jadwal.id_mata_kuliah = mata_kuliah.id_mata_kuliah')
            ->where('rencana_studi.nim', $nim)
            ->where('rencana_studi.nilai_huruf IS NOT NULL')
            ->findAll();

        if (empty($rencanaStudi)) {
            return 0.00;
        }

        $totalBobot = 0;
        $totalSKS = 0;

        foreach ($rencanaStudi as $rs) {
            $bobot = $this->getNilaiBobot($rs['nilai_huruf']);
            $totalBobot += $bobot * $rs['sks'];
            $totalSKS += $rs['sks'];
        }

        return $totalSKS > 0 ? round($totalBobot / $totalSKS, 2) : 0.00;
    }

    private function getNilaiBobot($nilaiHuruf)
    {
        // Ambil nilai mutu dari database
        return $this->nilaiMutuModel->getNilaiMutu($nilaiHuruf);
    }

    private function getSemesterAktif($nim)
    {
        // Simulasi semester aktif - bisa disesuaikan dengan logika bisnis
        return 5;
    }

    private function getMataKuliahAktif($nim)
    {
        return $this->rencanaStudiModel
            ->where('nim', $nim)
            ->countAllResults();
    }

    private function getHariIndonesia()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return $hari[date('w')];
    }
}
