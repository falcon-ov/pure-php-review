<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Database\Database;
use App\Models\Task;
use Core\Router;

// Инициализация PDO через класс Database
Task::setConnection(Database::getConnection());

require __DIR__ . '/../routes/web.php';

// Обрабатываем запрос
Router::dispatch();