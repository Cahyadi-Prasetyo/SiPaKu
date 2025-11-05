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
    protected $afterInsert    = ['createUserAccount'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['updateUserAccount'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = ['deleteUserAccount'];

    /**
     * Auto-generate user account setelah insert mahasiswa
     */
    protected function createUserAccount(array $data)
    {
        try {
            // Handle different callback data structures
            $nim = null;
            $nama = null;
            
            if (isset($data['data']['nim']) && isset($data['data']['nama'])) {
                // Standard insert callback
                $nim = $data['data']['nim'];
                $nama = $data['data']['nama'];
            } elseif (isset($data['id']) && is_string($data['id'])) {
                // Alternative callback structure
                $nim = $data['id'];
                // Get nama from database
                $mahasiswa = $this->find($nim);
                if ($mahasiswa) {
                    $nama = $mahasiswa['nama'];
                }
            }
            
            if ($nim && $nama) {
                $userModel = new \App\Models\UserModel();
                
                // Cek apakah user dengan kode ini sudah ada
                $existingUser = $userModel->findByKode($nim);
                
                if (!$existingUser) {
                    $userData = [
                        'nama_user' => $nama,
                        'role'      => 'mahasiswa',
                        'kode'      => $nim,
                        'password'  => $nim
                    ];
                    
                    $userModel->insert($userData);
                    log_message('info', 'Auto-generated user account for mahasiswa: ' . $nim);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to auto-generate user account for mahasiswa: ' . $e->getMessage());
        }
        
        return $data;
    }

    /**
     * Auto-update user account setelah update mahasiswa
     */
    protected function updateUserAccount(array $data)
    {
        try {
            $nim = null;
            $nama = null;
            
            if (isset($data['id']) && isset($data['data']['nama'])) {
                $nim = $data['id'];
                $nama = $data['data']['nama'];
            }
            
            if ($nim && $nama) {
                $userModel = new \App\Models\UserModel();
                
                // Cari user dengan kode = nim yang diupdate
                $user = $userModel->findByKode($nim);
                
                if ($user && $user['role'] === 'mahasiswa') {
                    $userModel->update($user['id_user'], ['nama_user' => $nama]);
                    log_message('info', 'Auto-updated user account name for mahasiswa: ' . $nim);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to auto-update user account for mahasiswa: ' . $e->getMessage());
        }
        
        return $data;
    }

    /**
     * Auto-delete user account setelah delete mahasiswa
     */
    protected function deleteUserAccount(array $data)
    {
        try {
            $nim = null;
            
            if (isset($data['id'])) {
                $nim = $data['id'];
            }
            
            if ($nim) {
                $userModel = new \App\Models\UserModel();
                
                // Cari user dengan kode = nim yang dihapus
                $user = $userModel->findByKode($nim);
                
                if ($user && $user['role'] === 'mahasiswa') {
                    $userModel->delete($user['id_user']);
                    log_message('info', 'Auto-deleted user account for mahasiswa: ' . $nim);
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to auto-delete user account for mahasiswa: ' . $e->getMessage());
        }
        
        return $data;
    }
}
