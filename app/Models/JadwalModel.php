<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kelas', 'id_mata_kuliah', 'id_ruangan', 'nidn', 'hari', 'jam'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_kelas'     => 'required|min_length[2]|max_length[50]',
        'id_mata_kuliah' => 'required|integer',
        'id_ruangan'     => 'required|integer',
        'nidn'           => 'required|min_length[8]|max_length[20]',
        'hari'           => 'required|in_list[Senin,Selasa,Rabu,Kamis,Jumat,Sabtu]',
        'jam'            => 'required|min_length[5]|max_length[20]'
    ];
    protected $validationMessages   = [
        'nama_kelas' => [
            'required'    => 'Nama kelas harus diisi',
            'min_length'  => 'Nama kelas minimal 2 karakter',
            'max_length'  => 'Nama kelas maksimal 50 karakter'
        ],
        'id_mata_kuliah' => [
            'required' => 'Mata kuliah harus dipilih',
            'integer'  => 'ID mata kuliah tidak valid'
        ],
        'id_ruangan' => [
            'required' => 'Ruangan harus dipilih',
            'integer'  => 'ID ruangan tidak valid'
        ],
        'nidn' => [
            'required'    => 'Dosen harus dipilih',
            'min_length'  => 'NIDN tidak valid',
            'max_length'  => 'NIDN tidak valid'
        ],
        'hari' => [
            'required' => 'Hari harus dipilih',
            'in_list'  => 'Hari tidak valid'
        ],
        'jam' => [
            'required'    => 'Jam harus diisi',
            'min_length'  => 'Format jam tidak valid',
            'max_length'  => 'Format jam terlalu panjang'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get jadwal with related data (JOIN)
     */
    public function getJadwalWithRelations($sortBy = 'created_at', $sortOrder = 'ASC')
    {
        // Map sort fields to actual column names
        $sortFieldMap = [
            'nama_kelas' => 'jadwal.nama_kelas',
            'hari' => 'jadwal.hari',
            'jam' => 'jadwal.jam',
            'nama_mata_kuliah' => 'mata_kuliah.nama_mata_kuliah',
            'nama_dosen' => 'dosen.nama',
            'nama_ruangan' => 'ruangan.nama_ruangan',
            'created_at' => 'jadwal.created_at'
        ];
        
        // Get the actual column name for sorting
        $sortColumn = $sortFieldMap[$sortBy] ?? 'jadwal.created_at';
        
        return $this->select('
                jadwal.*,
                mata_kuliah.nama_mata_kuliah,
                mata_kuliah.kode_mata_kuliah,
                dosen.nama as nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->orderBy($sortColumn, $sortOrder)
            ->findAll();
    }

    /**
     * Get jadwal by ID with relations
     */
    public function getJadwalWithRelationsById($id)
    {
        return $this->select('
                jadwal.*,
                mata_kuliah.nama_mata_kuliah,
                dosen.nama as nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->find($id);
    }

    /**
     * Validasi konflik jadwal sebelum insert/update
     */
    public function validateScheduleConflict($data, $excludeId = null)
    {
        $errors = [];

        // Cek konflik ruangan dengan informasi lebih detail
        $roomConflictQuery = $this->select('
                jadwal.*,
                mata_kuliah.nama_mata_kuliah,
                dosen.nama as nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->where([
                'jadwal.id_ruangan' => $data['id_ruangan'],
                'jadwal.hari' => $data['hari'],
                'jadwal.jam' => $data['jam']
            ]);

        if ($excludeId) {
            $roomConflictQuery->where('jadwal.id !=', $excludeId);
        }

        $roomConflict = $roomConflictQuery->first();
        if ($roomConflict) {
            $errors['id_ruangan'] = [
                'type' => 'conflict',
                'title' => 'Konflik Ruangan!',
                'message' => sprintf(
                    '%s sudah digunakan pada %s jam %s',
                    $roomConflict['nama_ruangan'] ?? 'Ruangan',
                    $data['hari'],
                    $data['jam']
                ),
                'details' => [
                    'Kelas' => $roomConflict['nama_kelas'],
                    'Mata Kuliah' => $roomConflict['nama_mata_kuliah'] ?? 'N/A',
                    'Dosen' => $roomConflict['nama_dosen'] ?? 'N/A'
                ]
            ];
        }

        // Cek konflik dosen dengan informasi lebih detail
        $dosenConflictQuery = $this->select('
                jadwal.*,
                mata_kuliah.nama_mata_kuliah,
                dosen.nama as nama_dosen,
                ruangan.nama_ruangan
            ')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah = jadwal.id_mata_kuliah', 'left')
            ->join('dosen', 'dosen.nidn = jadwal.nidn', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = jadwal.id_ruangan', 'left')
            ->where([
                'jadwal.nidn' => $data['nidn'],
                'jadwal.hari' => $data['hari'],
                'jadwal.jam' => $data['jam']
            ]);

        if ($excludeId) {
            $dosenConflictQuery->where('jadwal.id !=', $excludeId);
        }

        $dosenConflict = $dosenConflictQuery->first();
        if ($dosenConflict) {
            $errors['nidn'] = [
                'type' => 'conflict',
                'title' => 'Konflik Dosen!',
                'message' => sprintf(
                    '%s sudah mengajar pada %s jam %s',
                    $dosenConflict['nama_dosen'] ?? 'Dosen',
                    $data['hari'],
                    $data['jam']
                ),
                'details' => [
                    'Kelas' => $dosenConflict['nama_kelas'],
                    'Mata Kuliah' => $dosenConflict['nama_mata_kuliah'] ?? 'N/A',
                    'Ruangan' => $dosenConflict['nama_ruangan'] ?? 'N/A'
                ]
            ];
        }

        return $errors;
    }

    /**
     * Override insert untuk validasi konflik
     */
    public function insert($data = null, bool $returnID = true)
    {
        if ($data) { 
            $conflicts = $this->validateScheduleConflict($data);
            if (!empty($conflicts)) {
                // Ensure $this->errors is an array before merging
                $this->errors = is_array($this->errors) ? array_merge($this->errors, $conflicts) : $conflicts;
                return false;
            }
        }

        return parent::insert($data, $returnID);
    }

    /**
     * Override update untuk validasi konflik
     */
    public function update($id = null, $data = null): bool
    {
        
        if ($data) {
            $conflicts = $this->validateScheduleConflict($data, $id);
            if (!empty($conflicts)) {
                // Ensure $this->errors is an array before merging
                $this->errors = is_array($this->errors) ? array_merge($this->errors, $conflicts) : $conflicts;
                return false;
            }
        }

        return parent::update($id, $data);
    }
}
