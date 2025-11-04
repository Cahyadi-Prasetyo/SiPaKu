<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nim';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nim', 'nama'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nim'  => 'required|min_length[8]|max_length[20]|is_unique[mahasiswa.nim]',
        'nama' => 'required|min_length[3]|max_length[100]'
    ];
    protected $validationMessages   = [
        'nim' => [
            'required'    => 'NIM harus diisi',
            'min_length'  => 'NIM minimal 8 karakter',
            'max_length'  => 'NIM maksimal 20 karakter',
            'is_unique'   => 'NIM sudah terdaftar'
        ],
        'nama' => [
            'required'    => 'Nama harus diisi',
            'min_length'  => 'Nama minimal 3 karakter',
            'max_length'  => 'Nama maksimal 100 karakter'
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
}
