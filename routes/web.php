<?php

use App\Controllers\FormController;
use App\Controllers\ReportController;
use App\Core\Router;

$router = new Router();


$router->get('/create', FormController::class, 'create');
$router->post('/create/post', FormController::class, 'submit');

$router->get('/', ReportController::class, 'index');

$router->dispatch();
