<?php

namespace App\Models;

use CodeIgniter\Model;

class RencanaStudiModel extends Model
{
    protected $table = 'rencana_studi';
    protected $primaryKey = 'id_rencana_studi';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nim',
        'id_jadwal',
        'nilai_angka',
        'nilai_huruf'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getMahasiswaByJadwal($jadwalId)
    {
        return $this->select('rencana_studi.*, mahasiswa.nama')
            ->join('mahasiswa', 'mahasiswa.nim = rencana_studi.nim')
            ->where('rencana_studi.id_jadwal', $jadwalId)
            ->orderBy('mahasiswa.nama', 'ASC')
            ->findAll();
    }

    public function updateNilai($nim, $jadwalId, $nilaiAngka, $nilaiHuruf)
    {
        $existing = $this->where('nim', $nim)
            ->where('id_jadwal', $jadwalId)
            ->first();

        if ($existing) {
            return $this->update($existing['id_rencana_studi'], [
                'nilai_angka' => $nilaiAngka,
                'nilai_huruf' => $nilaiHuruf
            ]);
        } else {
            return $this->insert([
                'nim' => $nim,
                'id_jadwal' => $jadwalId,
                'nilai_angka' => $nilaiAngka,
                'nilai_huruf' => $nilaiHuruf
            ]);
        }
    }

    public function getTotalMahasiswaByDosen($nidn)
    {
        return $this->select('COUNT(DISTINCT rencana_studi.nim) as total')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->where('jadwal.nidn', $nidn)
            ->first()['total'] ?? 0;
    }

    public function getNilaiPendingByDosen($nidn)
    {
        return $this->select('COUNT(*) as total')
            ->join('jadwal', 'jadwal.id = rencana_studi.id_jadwal')
            ->where('jadwal.nidn', $nidn)
            ->where('(rencana_studi.nilai_angka IS NULL OR rencana_studi.nilai_angka = "")')
            ->first()['total'] ?? 0;
    }
}