<?php

use Core\Router;

Router::get('/', 'views/layout.php');
Router::get('/about', 'pages/about.php');
Router::get('/contact', function () {
    echo "<h1>Контакты</h1><p>Email: contact@example.com</p>";
});
