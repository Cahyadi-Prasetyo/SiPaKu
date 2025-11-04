<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionTimeoutFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Hanya jalankan untuk user yang sudah login
        if (!session()->get('isLoggedIn')) {
            return;
        }

        // Konfigurasi timeout (dalam detik)
        $sessionTimeout = 1800; // 30 menit
        $warningTime = 300; // 5 menit sebelum timeout untuk warning
        
        $lastActivity = session()->get('last_activity');
        $currentTime = time();
        
        if ($lastActivity) {
            $timeSinceLastActivity = $currentTime - $lastActivity;
            
            // Jika session sudah expired
            if ($timeSinceLastActivity > $sessionTimeout) {
                // Log aktivitas logout otomatis
                log_message('info', 'Session expired for user: ' . session()->get('kode'));
                
                // Destroy session
                session()->destroy();
                
                // Redirect ke login dengan pesan
                return redirect()->to('/login')->with('error', 'Sesi Anda telah berakhir karena tidak ada aktivitas selama 30 menit. Silakan login kembali.');
            }
            
            // Update last activity jika masih dalam batas waktu
            session()->set('last_activity', $currentTime);
            
            // Set warning flag jika mendekati timeout
            if ($timeSinceLastActivity > ($sessionTimeout - $warningTime)) {
                session()->set('session_warning', true);
                session()->set('time_remaining', $sessionTimeout - $timeSinceLastActivity);
            } else {
                session()->remove('session_warning');
                session()->remove('time_remaining');
            }
        } else {
            // Jika tidak ada last_activity, set sekarang
            session()->set('last_activity', $currentTime);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu action setelah response
    }
}