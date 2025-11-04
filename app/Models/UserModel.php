<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_user',
        'role',
        'kode',
        'password'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama_user' => 'required|min_length[3]|max_length[100]',
        'role'      => 'required|in_list[admin,dosen,mahasiswa]',
        'kode'      => 'required|max_length[20]',
        'password'  => 'permit_empty|min_length[6]'
    ];
    
    protected $validationMessages = [
        'nama_user' => [
            'required'    => 'Nama user harus diisi',
            'min_length'  => 'Nama user minimal 3 karakter',
            'max_length'  => 'Nama user maksimal 100 karakter'
        ],
        'role' => [
            'required' => 'Role harus dipilih',
            'in_list'  => 'Role harus admin, dosen, atau mahasiswa'
        ],
        'kode' => [
            'required'   => 'Kode user harus diisi',
            'max_length' => 'Kode maksimal 20 karakter',
            'is_unique'  => 'Kode user sudah digunakan'
        ],
        'password' => [
            'required'   => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter'
        ]
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Hash password sebelum insert/update
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } elseif (isset($data['data']['password']) && empty($data['data']['password'])) {
            // Remove empty password from update data
            unset($data['data']['password']);
        }
        return $data;
    }

    /**
     * Cari user berdasarkan kode (username)
     */
    public function findByKode($kode)
    {
        return $this->where('kode', $kode)->first();
    }



    /**
     * Verifikasi password
     */
    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * Get users berdasarkan role
     */
    public function getUsersByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    /**
     * Get admin users
     */
    public function getAdmins()
    {
        return $this->getUsersByRole('admin');
    }

    /**
     * Get dosen users
     */
    public function getDosens()
    {
        return $this->getUsersByRole('dosen');
    }

    /**
     * Get mahasiswa users
     */
    public function getMahasiswas()
    {
        return $this->getUsersByRole('mahasiswa');
    }
}
