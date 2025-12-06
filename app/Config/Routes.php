<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login
$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'sessionCheck']);

$routes->get('/logout', 'Login::logout');

// Riwayat
$routes->get('/riwayat', 'Peminjaman::riwayat');

// Halaman Surat (preview)
$routes->get('/surat-peminjaman/(:num)', 'Peminjaman::surat/$1');

// Download surat
$routes->get('/surat-peminjaman/download/(:num)', 'Peminjaman::download/$1');

// Punya Fitur Wafi
$routes->get('/cek', 'Cek::index');
$routes->post('/cek/cek_ketersediaan', 'Cek::cek_ketersediaan');
$routes->get('/cek/getRuangan/(:num)', 'Cek::getRuangan/$1');

// ===== Petugas =====
// Dashboard Petugas
$routes->get('/dashboard_petugas', 'C_Petugas::index', ['filter' => 'sessionCheck']);

// User Management
$routes->get('/user/tambah', 'C_petugas::tambah');
$routes->post('/user/simpan', 'C_petugas::simpan');
$routes->get('/user/edit/(:num)', 'C_petugas::edit/$1');
$routes->post('/user/update/(:num)', 'C_petugas::update/$1');
$routes->get('/user/delete/(:num)', 'C_petugas::delete/$1');


