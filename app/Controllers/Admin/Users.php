<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Tampilkan halaman kelola user
     */
    public function index()
    {
        // Exclude admin users from the list
        $users = $this->userModel->where('role !=', 'admin')->findAll();
        
        $data = [
            'title' => 'Kelola User',
            'breadcrumb' => 'Kelola User',
            'users' => $users
        ];

        return view('admin/users/index', $data);
    }

    /**
     * Tambah user baru
     */
    public function create()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $rules = [
            'nama_user' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[dosen,mahasiswa]',
            'kode' => 'required|max_length[20]|is_unique[user.kode]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'role' => $this->request->getPost('role'),
            'kode' => $this->request->getPost('kode'),
            'password' => $this->request->getPost('password')
        ];

        if ($this->userModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'User berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menambahkan user'
        ]);
    }

    /**
     * Tampilkan detail user
     */
    public function show($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        // Remove password from response
        unset($user['password']);

        return $this->response->setJSON([
            'success' => true,
            'data' => $user
        ]);
    }

    /**
     * Update user
     */
    public function update($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        $rules = [
            'nama_user' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[dosen,mahasiswa]',
            'kode' => "required|max_length[20]|is_unique[user.kode,id_user,{$id}]"
        ];

        // Only validate password if provided
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'role' => $this->request->getPost('role'),
            'kode' => $this->request->getPost('kode')
        ];

        // Only update password if provided
        if (!empty($password)) {
            $data['password'] = $password;
        }

        if ($this->userModel->update($id, $data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'User berhasil diperbarui'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal memperbarui user'
        ]);
    }

    /**
     * Hapus user
     */
    public function delete($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        // Prevent deleting admin users
        if ($user['role'] === 'admin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak dapat menghapus akun admin'
            ]);
        }

        if ($this->userModel->delete($id)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'User berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menghapus user'
        ]);
    }

    /**
     * Bulk create user accounts untuk semua mahasiswa
     */
    public function bulkCreateMahasiswa()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        try {
            $result = $this->userModel->bulkCreateMahasiswaAccounts();
            
            $message = "Bulk create selesai. ";
            $message .= "Dibuat: {$result['created']}, ";
            $message .= "Dilewati: {$result['skipped']}";
            
            if (!empty($result['errors'])) {
                $message .= ", Error: " . count($result['errors']);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => $message,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Bulk create user accounts untuk semua dosen
     */
    public function bulkCreateDosen()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        try {
            $result = $this->userModel->bulkCreateDosenAccounts();
            
            $message = "Bulk create selesai. ";
            $message .= "Dibuat: {$result['created']}, ";
            $message .= "Dilewati: {$result['skipped']}";
            
            if (!empty($result['errors'])) {
                $message .= ", Error: " . count($result['errors']);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => $message,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Test auto-generate functionality
     */
    public function testAutoGenerate()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $type = $this->request->getPost('type'); // 'mahasiswa' atau 'dosen'
        
        if ($type === 'mahasiswa') {
            // Test dengan data dummy mahasiswa
            $mahasiswaModel = new \App\Models\MahasiswaModel();
            $testData = [
                'nim' => 'TEST' . time(),
                'nama' => 'Test Mahasiswa ' . date('H:i:s')
            ];
            
            try {
                $result = $mahasiswaModel->insert($testData);
                if ($result) {
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Test mahasiswa berhasil dibuat. User account otomatis terbuat.',
                        'data' => $testData
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
        } elseif ($type === 'dosen') {
            // Test dengan data dummy dosen
            $dosenModel = new \App\Models\DosenModel();
            $testData = [
                'nidn' => 'TEST' . time(),
                'nama' => 'Test Dosen ' . date('H:i:s')
            ];
            
            try {
                $result = $dosenModel->insert($testData);
                if ($result) {
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Test dosen berhasil dibuat. User account otomatis terbuat.',
                        'data' => $testData
                    ]);
                }
            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Tipe test tidak valid'
        ]);
    }
}
