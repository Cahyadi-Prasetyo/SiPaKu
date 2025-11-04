<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika sudah login, redirect ke dashboard sesuai role
        if (session()->get('isLoggedIn')) {
            $role = session()->get('role');
            
            switch ($role) {
                case 'admin':
                    return redirect()->to('/admin/dashboard');
                case 'dosen':
                    return redirect()->to('/dosen/dashboard');
                case 'mahasiswa':
                    return redirect()->to('/mahasiswa/dashboard');
                default:
                    return redirect()->to('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}