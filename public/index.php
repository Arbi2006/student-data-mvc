<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/controllers/StudentController.php';
$router = new Router();
$router->get('/', [StudentController::class, 'index']);
$router->get('/students', [StudentController::class, 'index']);
$router->get('/students/create', [StudentController::class, 'create']);
$router->post('/students/store', [StudentController::class, 'store']);
$router->get('/students/edit', [StudentController::class, 'edit']);
$router->post('/students/update', [StudentController::class, 'update']);
$router->post('/students/delete', [StudentController::class, 'destroy']);
$router->dispatch();