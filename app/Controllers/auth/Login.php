<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Tampilkan halaman login
     */
    public function index()
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (session()->get('isLoggedIn')) {
            return $this->redirectToDashboard(session()->get('role'));
        }
        
        return view('auth/login');
    }

    /**
     * Proses login
     */
    public function authenticate()
    {
        $rules = [
            'kode' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $kode = $this->request->getPost('kode');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan kode
        $user = $this->userModel->findByKode($kode);

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan');
        }

        // Verifikasi password
        if (!$this->userModel->verifyPassword($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah');
        }

        // Set session dengan timestamp untuk tracking
        $sessionData = [
            'id_user' => $user['id_user'],
            'nama_user' => $user['nama_user'],
            'kode' => $user['kode'],
            'role' => $user['role'],
            'isLoggedIn' => true,
            'login_time' => time(),
            'last_activity' => time()
        ];

        session()->set($sessionData);

        // Redirect ke dashboard sesuai role
        return $this->redirectToDashboard($user['role']);
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout');
    }

    /**
     * Extend session (AJAX endpoint)
     */
    public function extendSession()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Invalid request']);
        }

        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['error' => 'Not logged in']);
        }

        // Update last activity
        session()->set('last_activity', time());
        session()->remove('session_warning');
        session()->remove('time_remaining');

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Session extended successfully'
        ]);
    }

    /**
     * Redirect ke dashboard sesuai role
     */
    private function redirectToDashboard($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'dosen':
                return redirect()->to('/dosen/dashboard');
            case 'mahasiswa':
                return redirect()->to('/mahasiswa/dashboard');
            default:
                return redirect()->to('/login');
        }
    }
}
