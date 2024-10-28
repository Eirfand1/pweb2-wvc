<?php

use App\Controllers\HomeController;
use App\Controllers\MahasiswaController;
use App\Controllers\StudentController;
use App\Router;


$router = new Router();

$router->get('/', HomeController::class, 'index');
$router->get('/student', StudentController::class, 'index');

$router->dispatch();
