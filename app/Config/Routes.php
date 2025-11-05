<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Auth\Login::index');

// Auth routes (untuk guest)
$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('login', 'Auth\Login::index');
    $routes->post('login', 'Auth\Login::authenticate');
});


// Logout route (untuk authenticated user)
$routes->get('logout', 'Auth\Login::logout', ['filter' => 'auth']);

// Extend session route (AJAX)
$routes->post('extend-session', 'Auth\Login::extendSession', ['filter' => 'auth']);

// Admin routes (dengan auth filter)
$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
});

// Dosen routes  
$routes->group('dosen', ['filter' => 'auth:dosen'], function($routes) {
    $routes->get('dashboard', 'Dosen\DosenController::dashboard');
});

// Mahasiswa routes
$routes->group('mahasiswa', ['filter' => 'auth:mahasiswa'], function($routes) {
    $routes->get('dashboard', 'Mahasiswa\MahasiswaController::dashboard');
});
$routes->get('admin/dashboard/getTabData/(:segment)', 'Admin\Dashboard::getTabData/$1');
$routes->post('admin/dashboard/updateConfig', 'Admin\Dashboard::updateConfig');
$routes->get('admin/dashboard/getConfig', 'Admin\Dashboard::getConfig');
$routes->post('admin/dashboard/search', 'Admin\Dashboard::search');
$routes->get('admin/dashboard/getDetailedStats', 'Admin\Dashboard::getDetailedStats');
// $routes->get('admin/dashboard/export/(:segment)', 'Admin\Dashboard::export/$1'); // Commented out for now
$routes->get('admin/mahasiswa', 'Admin\Mahasiswa::index');
$routes->post('admin/mahasiswa', 'Admin\Mahasiswa::create');
$routes->post('admin/mahasiswa/update/(:segment)', 'Admin\Mahasiswa::update/$1');
$routes->get('admin/mahasiswa/(:segment)', 'Admin\Mahasiswa::show/$1');
$routes->delete('admin/mahasiswa/(:segment)', 'Admin\Mahasiswa::delete/$1');

$routes->get('admin/dosen', 'Admin\Dosen::index');
$routes->post('admin/dosen', 'Admin\Dosen::create');
$routes->post('admin/dosen/update/(:segment)', 'Admin\Dosen::update/$1');
$routes->get('admin/dosen/(:segment)', 'Admin\Dosen::show/$1');
$routes->delete('admin/dosen/(:segment)', 'Admin\Dosen::delete/$1');

$routes->get('admin/ruangan', 'Admin\Ruangan::index');
$routes->post('admin/ruangan', 'Admin\Ruangan::create');
$routes->post('admin/ruangan/update/(:segment)', 'Admin\Ruangan::update/$1');
$routes->get('admin/ruangan/(:segment)', 'Admin\Ruangan::show/$1');
$routes->delete('admin/ruangan/(:segment)', 'Admin\Ruangan::delete/$1');

$routes->get('admin/jadwal', 'Admin\Jadwal::index');
$routes->post('admin/jadwal', 'Admin\Jadwal::create');
$routes->get('admin/jadwal/getMataKuliah', 'Admin\Jadwal::getMataKuliah');
$routes->get('admin/jadwal/getDosen', 'Admin\Jadwal::getDosen');
$routes->get('admin/jadwal/getRuangan', 'Admin\Jadwal::getRuangan');
$routes->post('admin/jadwal/checkConflict', 'Admin\Jadwal::checkConflict');
$routes->post('admin/jadwal/update/(:segment)', 'Admin\Jadwal::update/$1');
$routes->get('admin/jadwal/(:segment)', 'Admin\Jadwal::show/$1');
$routes->delete('admin/jadwal/(:segment)', 'Admin\Jadwal::delete/$1');
// Mata Kuliah routes
$routes->get('admin/mata-kuliah', 'Admin\MataKuliah::index');
$routes->post('admin/mata-kuliah', 'Admin\MataKuliah::create');
$routes->post('admin/mata-kuliah/update/(:segment)', 'Admin\MataKuliah::update/$1');
$routes->get('admin/mata-kuliah/(:segment)', 'Admin\MataKuliah::show/$1');
$routes->delete('admin/mata-kuliah/(:segment)', 'Admin\MataKuliah::delete/$1');

// // Users routes
// $routes->get('admin/users', 'Admin\Users::index');
// $routes->post('admin/users', 'Admin\Users::create');
// $routes->post('admin/users/update/(:segment)', 'Admin\Users::update/$1');
// $routes->get('admin/users/(:segment)', 'Admin\Users::show/$1');
// $routes->delete('admin/users/(:segment)', 'Admin\Users::delete/$1');

// Bulk operations routes
$routes->post('admin/users/bulk-create-mahasiswa', 'Admin\Users::bulkCreateMahasiswa');
$routes->post('admin/users/bulk-create-dosen', 'Admin\Users::bulkCreateDosen');
$routes->post('admin/users/test-auto-generate', 'Admin\Users::testAutoGenerate');

$routes->get('admin/test-empty', function() {
    return view('admin/test-empty', ['title' => 'Test Empty Page']);
});