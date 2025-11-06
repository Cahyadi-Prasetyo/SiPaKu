<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 * SIPAKU - Sistem Informasi Akademik
 * Route Configuration
 */
$routes->get('/', 'Auth\Login::index');

// Guest routes (untuk user yang belum login)
$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('login', 'Auth\Login::index');
    $routes->post('login', 'Auth\Login::authenticate');
});

// Authenticated user routes
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('logout', 'Auth\Login::logout');
    $routes->post('extend-session', 'Auth\Login::extendSession'); // AJAX session extension
});


$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('dashboard/getTabData/(:segment)', 'Admin\Dashboard::getTabData/$1');
    $routes->post('dashboard/updateConfig', 'Admin\Dashboard::updateConfig');
    $routes->get('dashboard/getConfig', 'Admin\Dashboard::getConfig');
    $routes->post('dashboard/search', 'Admin\Dashboard::search');
    $routes->get('dashboard/getDetailedStats', 'Admin\Dashboard::getDetailedStats');
    // $routes->get('dashboard/export/(:segment)', 'Admin\Dashboard::export/$1'); // Future feature
    
    // Mahasiswa Management
    $routes->group('mahasiswa', function($routes) {
        $routes->get('/', 'Admin\Mahasiswa::index');
        $routes->post('/', 'Admin\Mahasiswa::create');
        $routes->get('(:segment)', 'Admin\Mahasiswa::show/$1');
        $routes->post('update/(:segment)', 'Admin\Mahasiswa::update/$1');
        $routes->delete('(:segment)', 'Admin\Mahasiswa::delete/$1');
    });
    
    // Dosen Management
    $routes->group('dosen', function($routes) {
        $routes->get('/', 'Admin\Dosen::index');
        $routes->post('/', 'Admin\Dosen::create');
        $routes->get('(:segment)', 'Admin\Dosen::show/$1');
        $routes->post('update/(:segment)', 'Admin\Dosen::update/$1');
        $routes->delete('(:segment)', 'Admin\Dosen::delete/$1');
    });
    
    // Mata Kuliah Management
    $routes->group('mata-kuliah', function($routes) {
        $routes->get('/', 'Admin\MataKuliah::index');
        $routes->post('/', 'Admin\MataKuliah::create');
        $routes->get('(:segment)', 'Admin\MataKuliah::show/$1');
        $routes->post('update/(:segment)', 'Admin\MataKuliah::update/$1');
        $routes->delete('(:segment)', 'Admin\MataKuliah::delete/$1');
    });
    
    // Ruangan Management
    $routes->group('ruangan', function($routes) {
        $routes->get('/', 'Admin\Ruangan::index');
        $routes->post('/', 'Admin\Ruangan::create');
        $routes->get('(:segment)', 'Admin\Ruangan::show/$1');
        $routes->post('update/(:segment)', 'Admin\Ruangan::update/$1');
        $routes->delete('(:segment)', 'Admin\Ruangan::delete/$1');
    });
    
    // Jadwal Management
    $routes->group('jadwal', function($routes) {
        $routes->get('/', 'Admin\Jadwal::index');
        $routes->post('/', 'Admin\Jadwal::create');
        $routes->get('(:segment)', 'Admin\Jadwal::show/$1');
        $routes->post('update/(:segment)', 'Admin\Jadwal::update/$1');
        $routes->delete('(:segment)', 'Admin\Jadwal::delete/$1');
        
        // AJAX endpoints for jadwal
        $routes->get('getMataKuliah', 'Admin\Jadwal::getMataKuliah');
        $routes->get('getDosen', 'Admin\Jadwal::getDosen');
        $routes->get('getRuangan', 'Admin\Jadwal::getRuangan');
        $routes->post('checkConflict', 'Admin\Jadwal::checkConflict');
    });
    
    // User Management & Bulk Operations
    $routes->group('users', function($routes) {
        // $routes->get('/', 'Admin\Users::index');                    // Future feature
        // $routes->post('/', 'Admin\Users::create');                  // Future feature
        // $routes->get('(:segment)', 'Admin\Users::show/$1');         // Future feature
        // $routes->post('update/(:segment)', 'Admin\Users::update/$1'); // Future feature
        // $routes->delete('(:segment)', 'Admin\Users::delete/$1');    // Future feature
        
        // Bulk operations
        $routes->post('bulk-create-mahasiswa', 'Admin\Users::bulkCreateMahasiswa');
        $routes->post('bulk-create-dosen', 'Admin\Users::bulkCreateDosen');
        $routes->post('test-auto-generate', 'Admin\Users::testAutoGenerate');
    });
    
    // Development/Testing routes
    $routes->get('test-empty', function() {
        return view('admin/test-empty', ['title' => 'Test Empty Page']);
    });
});

$routes->group('dosen', ['filter' => 'auth:dosen'], function($routes) {
    
    // Dashboard
    $routes->get('dashboard', 'Dosen\DosenController::dashboard');
    
    // Jadwal Mengajar
    $routes->get('jadwal', 'Dosen\DosenController::jadwal');
    
    // Input & Kelola Nilai
    $routes->group('nilai', function($routes) {
        $routes->get('/', 'Dosen\DosenController::nilai');
        $routes->get('mahasiswa/(:segment)', 'Dosen\DosenController::getMahasiswaByJadwal/$1');
        $routes->post('save', 'Dosen\DosenController::saveNilai');
    });
    
    // Future features
    // $routes->get('riwayat-mengajar', 'Dosen\DosenController::riwayatMengajar');
    // $routes->get('laporan', 'Dosen\DosenController::laporan');
});

$routes->group('mahasiswa', ['filter' => 'auth:mahasiswa'], function($routes) {
    
    // Dashboard
    $routes->get('dashboard', 'Mahasiswa\MahasiswaController::dashboard');
    
    // Future features
    // $routes->get('jadwal', 'Mahasiswa\MahasiswaController::jadwal');
    // $routes->get('nilai', 'Mahasiswa\MahasiswaController::nilai');
    // $routes->get('transkrip', 'Mahasiswa\MahasiswaController::transkrip');
    // $routes->get('krs', 'Mahasiswa\MahasiswaController::krs');
});