<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $table            = 'mata_kuliah';
    protected $primaryKey       = 'id_mata_kuliah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_mata_kuliah', 'nama_mata_kuliah', 'sks'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'kode_mata_kuliah' => 'required|min_length[3]|max_length[10]',
        'nama_mata_kuliah' => 'required|min_length[3]|max_length[100]',
        'sks'              => 'required|integer|greater_than[0]|less_than_equal_to[6]'
    ];
    protected $validationMessages   = [
        'kode_mata_kuliah' => [
            'required'    => 'Kode mata kuliah harus diisi',
            'min_length'  => 'Kode mata kuliah minimal 3 karakter',
            'max_length'  => 'Kode mata kuliah maksimal 10 karakter',
            'is_unique'   => 'Kode mata kuliah sudah terdaftar'
        ],
        'nama_mata_kuliah' => [
            'required'    => 'Nama mata kuliah harus diisi',
            'min_length'  => 'Nama mata kuliah minimal 3 karakter',
            'max_length'  => 'Nama mata kuliah maksimal 100 karakter'
        ],
        'sks' => [
            'required'              => 'SKS harus diisi',
            'integer'               => 'SKS harus berupa angka',
            'greater_than'          => 'SKS minimal 1',
            'less_than_equal_to'    => 'SKS maksimal 6'
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