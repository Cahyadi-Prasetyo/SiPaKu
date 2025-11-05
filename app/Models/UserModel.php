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

    /**
     * Create user account untuk mahasiswa
     */
    public function createMahasiswaAccount($nim, $nama)
    {
        // Cek apakah user sudah ada
        $existingUser = $this->findByKode($nim);
        
        if ($existingUser) {
            return ['success' => false, 'message' => 'User account sudah ada'];
        }

        $userData = [
            'nama_user' => $nama,
            'role'      => 'mahasiswa',
            'kode'      => $nim,
            'password'  => $nim
        ];

        try {
            $result = $this->insert($userData);
            if ($result) {
                return ['success' => true, 'message' => 'User account berhasil dibuat', 'id' => $result];
            } else {
                return ['success' => false, 'message' => 'Gagal membuat user account'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Create user account untuk dosen
     */
    public function createDosenAccount($nidn, $nama)
    {
        // Cek apakah user sudah ada
        $existingUser = $this->findByKode($nidn);
        
        if ($existingUser) {
            return ['success' => false, 'message' => 'User account sudah ada'];
        }

        $userData = [
            'nama_user' => $nama,
            'role'      => 'dosen',
            'kode'      => $nidn,
            'password'  => $nidn
        ];

        try {
            $result = $this->insert($userData);
            if ($result) {
                return ['success' => true, 'message' => 'User account berhasil dibuat', 'id' => $result];
            } else {
                return ['success' => false, 'message' => 'Gagal membuat user account'];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    /**
     * Bulk create user accounts untuk mahasiswa yang belum punya account
     */
    public function bulkCreateMahasiswaAccounts()
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $allMahasiswa = $mahasiswaModel->findAll();
        
        $created = 0;
        $skipped = 0;
        $errors = [];

        foreach ($allMahasiswa as $mahasiswa) {
            // Cek apakah user sudah ada
            $existingUser = $this->findByKode($mahasiswa['nim']);
            
            if ($existingUser) {
                $skipped++;
                continue;
            }

            // Direct insert tanpa callback untuk menghindari konflik
            $userData = [
                'nama_user' => $mahasiswa['nama'],
                'role'      => 'mahasiswa',
                'kode'      => $mahasiswa['nim'],
                'password'  => password_hash($mahasiswa['nim'], PASSWORD_DEFAULT)
            ];

            try {
                $result = $this->insert($userData, false); // false = skip callbacks
                if ($result) {
                    $created++;
                } else {
                    $errors[] = "NIM {$mahasiswa['nim']}: Gagal insert ke database";
                }
            } catch (\Exception $e) {
                $errors[] = "NIM {$mahasiswa['nim']}: {$e->getMessage()}";
            }
        }

        return [
            'created' => $created,
            'skipped' => $skipped,
            'errors' => $errors
        ];
    }

    /**
     * Bulk create user accounts untuk dosen yang belum punya account
     */
    public function bulkCreateDosenAccounts()
    {
        $dosenModel = new \App\Models\DosenModel();
        $allDosen = $dosenModel->findAll();
        
        $created = 0;
        $skipped = 0;
        $errors = [];

        foreach ($allDosen as $dosen) {
            // Cek apakah user sudah ada
            $existingUser = $this->findByKode($dosen['nidn']);
            
            if ($existingUser) {
                $skipped++;
                continue;
            }

            // Direct insert tanpa callback untuk menghindari konflik
            $userData = [
                'nama_user' => $dosen['nama'],
                'role'      => 'dosen',
                'kode'      => $dosen['nidn'],
                'password'  => password_hash($dosen['nidn'], PASSWORD_DEFAULT)
            ];

            try {
                $result = $this->insert($userData, false); // false = skip callbacks
                if ($result) {
                    $created++;
                } else {
                    $errors[] = "NIDN {$dosen['nidn']}: Gagal insert ke database";
                }
            } catch (\Exception $e) {
                $errors[] = "NIDN {$dosen['nidn']}: {$e->getMessage()}";
            }
        }

        return [
            'created' => $created,
            'skipped' => $skipped,
            'errors' => $errors
        ];
    }
}
