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
        $nidn = session()->get('kode');
        
        // Ambil data dosen berdasarkan NIDN
        $dosen = $this->dosenModel->where('nidn', $nidn)->first();
        
        if (!$dosen) {
            return redirect()->to('/login')->with('error', 'Data dosen tidak ditemukan');
        }

        $data = [
            'title' => 'Dashboard Dosen',
            'dosen' => $dosen,
            'totalJadwal' => $this->jadwalModel->where('nidn', $nidn)->countAllResults(),
            'jadwalHariIni' => $this->getJadwalHariIni($nidn),
            'mataKuliah' => $this->getMataKuliahDosen($nidn)
        ];

        return view('dosen/dashboard', $data);
    }

    private function getJadwalHariIni($nidn)
    {
        $hari = $this->getHariIndonesia();
        
        return $this->jadwalModel
            ->select('jadwal.*, mata_kuliah.nama_mata_kuliah, ruangan.nama_ruangan')
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

    private function getHariIndonesia()
    {
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return $hari[date('w')];
    }
}