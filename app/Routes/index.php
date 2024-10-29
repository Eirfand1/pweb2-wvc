<?php

use App\Controllers\ArtikelController;
use App\Controllers\HomeController;
use App\Controllers\DashboardController;
use App\Router;



$router = new Router();

$router->get('/', ArtikelController::class, 'index');
$router->get('/{id}',ArtikelController::class, 'show');
$router->get('/dashboard/{id}', DashboardController::class, 'index');
$router->get('/dashboard/{id}/artikel', DashboardController::class, 'listArtikel');
//mendefinisikan nama url dan class dan method controller yang akan digunakan
$router->get('/dashboard/{id}/penulis', DashboardController::class, "listPenulis");
$router->get('/dashboard/{id}/komentar', DashboardController::class, "listKomentar");
$router->get('/dashboard/{id}/kategori', DashboardController::class, "listKategori");

$router->dispatch();
