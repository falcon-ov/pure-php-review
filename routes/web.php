<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../controllers/TaskController.php';

$db = new Database();
$taskModel = new Task($db->getConnection());
$controller = new TaskController($taskModel);

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        //$controller->create();
        break;
    case 'store':
        //$controller->store();
        break;
    default:
       // $controller->index();
        break;
}