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
    protected $afterInsert    = ['createUserAccount'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['updateUserAccount'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = ['deleteUserAccount'];

    /**
     * Auto-generate user account setelah insert dosen
     */
    protected function createUserAccount(array $data)
    {
        try {
            // Handle different callback data structures
            $nidn = null;
            $nama = null;
            
            if (isset($data['data']['nidn']) && isset($data['data']['nama'])) {
                // Standard insert callback
                $nidn = $data['data']['nidn'];
                $nama = $data['data']['nama'];
            } elseif (isset($data['id']) && is_string($data['id'])) {
                // Alternative callback structure
                $nidn = $data['id'];
                // Get nama from database
                $dosen = $this->find($nidn);
                if ($dosen) {
                    $nama = $dosen['nama'];
                }
            }
            
            if ($nidn && $nama) {
                $userModel = new \App\Models\UserModel();
                
                // Cek apakah user dengan kode ini sudah ada
                $existingUser = $userModel->findByKode($nidn);
                
                if (!$existingUser) {
                    $userData = [
                        'nama_user' => $nama,
                        'role'      => 'dosen',
                        'kode'      => $nidn,
                        'password'  => $nidn
                    ];
                    
                    $userModel->insert($userData);
                    log_message('info', 'Auto-generated user account for dosen: ' . $nidn);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to auto-generate user account for dosen: ' . $e->getMessage());
        }
        
        return $data;
    }

    /**
     * Auto-update user account setelah update dosen
     */
    protected function updateUserAccount(array $data)
    {
        try {
            $nidn = null;
            $nama = null;
            
            if (isset($data['id']) && isset($data['data']['nama'])) {
                $nidn = $data['id'];
                $nama = $data['data']['nama'];
            }
            
            if ($nidn && $nama) {
                $userModel = new \App\Models\UserModel();
                
                // Cari user dengan kode = nidn yang diupdate
                $user = $userModel->findByKode($nidn);
                
                if ($user && $user['role'] === 'dosen') {
                    $userModel->update($user['id_user'], ['nama_user' => $nama]);
                    log_message('info', 'Auto-updated user account name for dosen: ' . $nidn);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to auto-update user account for dosen: ' . $e->getMessage());
        }
        
        return $data;
    }

    /**
     * Auto-delete user account setelah delete dosen
     */
    protected function deleteUserAccount(array $data)
    {
        try {
            $nidn = null;
            
            if (isset($data['id'])) {
                $nidn = $data['id'];
            }
            
            if ($nidn) {
                $userModel = new \App\Models\UserModel();
                
                // Cari user dengan kode = nidn yang dihapus
                $user = $userModel->findByKode($nidn);
                
                if ($user && $user['role'] === 'dosen') {
                    $userModel->delete($user['id_user']);
                    log_message('info', 'Auto-deleted user account for dosen: ' . $nidn);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to auto-delete user account for dosen: ' . $e->getMessage());
        }
        
        return $data;
    }
}
