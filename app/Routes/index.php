<?php

use App\Controllers\ArtikelController;
use App\Controllers\DashboardController;
use App\Router;



$router = new Router();

$router->get('/', ArtikelController::class, 'index');
$router->get('/{id}',ArtikelController::class, 'show');
$router->get('/dashboard/admin', DashboardController::class, 'indexAdmin');
$router->get('/dashboard/admin/artikel', DashboardController::class, 'listArtikelAdmin');
$router->get('/dashboard/admin/penulis', DashboardController::class, 'listPenulis');
$router->get('/dashboard/admin/komentar', DashboardController::class, 'listKomentarAdmin');
$router->get('/dashboard/admin/kategori', DashboardController::class, 'listKategoriAdmin');
$router->get('/dashboard/{id}', DashboardController::class, 'index');
$router->get('/dashboard/{id}/artikel', DashboardController::class, 'listArtikel');
$router->get('/dashboard/{id}/artikel/tambah', DashboardController::class, 'insertPageArtikel');
$router->post('/dashboard/{id}/artikel/tambah', DashboardController::class, 'artikelStore');
$router->get('/dashboard/{id}/artikel/{aid}', DashboardController::class, 'artikelDelete');
$router->get('/dashboard/{id}/artikel/edit/{aid}', DashboardController::class, 'artikelPageUpdate');
$router->post('/dashboard/{id}/artikel/edit/{aid}', DashboardController::class, 'artikelUpdate');
//mendefinisikan nama url dan class dan method controller yang akan digunakan
$router->get('/dashboard/{id}/penulis', DashboardController::class, "listPenulis");
$router->get('/dashboard/{id}/komentar', DashboardController::class, "listKomentar");
$router->get('/dashboard/{id}/kategori', DashboardController::class, "listKategori");

$router->get('/dashboard/admin/penulis/tambah', DashboardController::class, 'insertPagePenulis');
$router->post('/dashboard/admin/penulis/tambah', DashboardController::class, 'penulisStore');

$router->get('/dashboard/admin/penulis/{id}', DashboardController::class, 'deletePenulis');

$router->get('/dashboard/admin/penulis/edit/{id}', DashboardController::class, 'editPagePenulis');

$router->post('/dashboard/admin/penulis/edit/{id}', DashboardController::class, 'penulisUpdate');
$router->dispatch();
