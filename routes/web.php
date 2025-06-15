<?php
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../app/models/Task.php';
require_once __DIR__ . '/../app/controllers/TaskController.php';

$db = new Database();
$taskModel = new Task($db->getConnection());
$controller = new TaskController($taskModel);

echo "<br> ROUTE";