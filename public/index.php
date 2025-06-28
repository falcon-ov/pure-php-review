<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Database\Database;
use App\Models\Task;
use App\Controllers\TaskController;
use Core\Router;

$taskModel = new Task(Database::getConnection());
$controller = new TaskController($taskModel);

require __DIR__ . '/../routes/web.php';

// обрабатываем запрос
Router::dispatch();
