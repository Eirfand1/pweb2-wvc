<?php

use App\Controllers\ArtikelController;
use App\Controllers\HomeController;
use App\Router;



$router = new Router();

$router->get('/', ArtikelController::class, 'index');

$router->dispatch();
