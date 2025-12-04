<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Router Setup
// $routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Home');
// $routes->setDefaultMethod('index');
// $routes->setTranslateURIDashes(false);
// $routes->set404Override();
// $routes->setAutoRoute(true);
// App routes

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

