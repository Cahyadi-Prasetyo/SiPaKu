<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek session timeout (30 menit = 1800 detik)
        $sessionTimeout = 1800; // 30 menit
        $lastActivity = session()->get('last_activity');
        
        if ($lastActivity && (time() - $lastActivity > $sessionTimeout)) {
            // Session expired, destroy session dan redirect ke login
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Sesi Anda telah berakhir. Silakan login kembali.');
        }

        // Update last activity time
        session()->set('last_activity', time());

        // Jika ada argument role, cek apakah user memiliki role yang sesuai
        if ($arguments) {
            $userRole = session()->get('role');
            
            // Jika role user tidak sesuai dengan yang diizinkan
            if (!in_array($userRole, $arguments)) {
                return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}