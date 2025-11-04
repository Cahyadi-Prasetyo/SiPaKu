<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table            = 'dosen';
    protected $primaryKey       = 'nidn';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nidn', 'nama'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nidn' => 'required|min_length[8]|max_length[20]|is_unique[dosen.nidn]',
        'nama' => 'required|min_length[3]|max_length[100]'
    ];
    protected $validationMessages   = [
        'nidn' => [
            'required'    => 'NIDN harus diisi',
            'min_length'  => 'NIDN minimal 8 karakter',
            'max_length'  => 'NIDN maksimal 20 karakter',
            'is_unique'   => 'NIDN sudah terdaftar'
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
