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

$router->get('/dashboard/{id}', DashboardController::class, 'index');

//CRUD ARTIKEL
$router->get('/dashboard/{id}/artikel', DashboardController::class, 'listArtikel');
$router->get('/dashboard/{id}/artikel/tambah', DashboardController::class, 'insertPageArtikel');
$router->post('/dashboard/{id}/artikel/tambah', DashboardController::class, 'artikelStore');
$router->get('/dashboard/{id}/artikel/{aid}', DashboardController::class, 'artikelDelete');
$router->get('/dashboard/{id}/artikel/edit/{aid}', DashboardController::class, 'artikelPageUpdate');
$router->post('/dashboard/{id}/artikel/edit/{aid}', DashboardController::class, 'artikelUpdate');

//mendefinisikan nama url dan class dan method controller yang akan digunakan
//SEMUA TAMPILAN
$router->get('/dashboard/{id}/penulis', DashboardController::class, "listPenulis");

//DELETE KOMENTAR (ADMIN)
$router->get('/dashboard/admin/komentar/{id}', DashboardController::class, "deleteKomentarAdmin");
$router->get('/dashboard/{id}/komentar', DashboardController::class, "listKomentar");

// $router->get('/dashboard/{id}/kategori', DashboardController::class, "listKategori");
// $router->get('/dashboard/{id}/kategori/edit{id}', DashboardController::class, 'editKategori');

// $router->get('/dashboard/{id}/kategori', DashboardController::class, "listKategori");


//CRUD PENULIS (ADMIN)
$router->get('/dashboard/admin/penulis/tambah', DashboardController::class, 'insertPagePenulis');
$router->post('/dashboard/admin/penulis/tambah', DashboardController::class, 'penulisStore');
$router->get('/dashboard/admin/penulis/{id}', DashboardController::class, 'deletePenulis');
$router->get('/dashboard/admin/penulis/edit/{id}', DashboardController::class, 'editPagePenulis');
$router->post('/dashboard/admin/penulis/edit/{id}', DashboardController::class, 'penulisUpdate');

//CRUD KATEGORI (ADMIN)
$router->get('/dashboard/admin/kategori/tambah', DashboardController::class, 'insertPageKategori');
$router->post('/dashboard/admin/kategori/tambah', DashboardController::class, 'kategoriStore');
$router->get('/dashboard/admin/kategori/{id}', DashboardController::class, 'deleteKategori');
$router->get('/dashboard/admin/kategori/edit/{id}', DashboardController::class,'editPageKategori');
$router->post('/dashboard/admin/kategori/edit/{id}', DashboardController::class,'kategoriUpdate');

$router->get('/dashboard/admin/kategori/edit/{id}', DashboardController::class, 'editPageKategori');
$router->post('/dashboard/admin/kategori/edit/{id}', DashboardController::class, 'kategoriUpdate');
$router->get('/dashboard/admin/kategori/{id}', DashboardController::class, 'deleteKategori');


$router->get('/dashboard/admin/kategori', DashboardController::class, 'listKategoriAdmin');

//CRUD KOMENTAR
$router->get('/dashboard/{id}/komentar/tambah', DashboardController::class, 'insertPageKomentar');
$router->post('/dashboard/{id}/komentar/tambah', DashboardController::class, 'komentarStore');
$router->get('/dashboard/{id}/komentar/hapus/{kid}', DashboardController::class, 'deleteKomentar');
$router->get('/dashboard/{id}/komentar/edit/{kid}', DashboardController::class, 'editPageKomentar');
$router->post('/dashboard/{id}/komentar/edit/{kid}', DashboardController::class,'komentarUpdate');

$router->get('/dashboard/admin/komentar/{kid}', DashboardController::class, 'deleteKomentarAdmin');
$router->dispatch();
