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


$router->dispatch();
