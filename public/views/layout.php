<?php
// layout.php
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление задачами</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@3.4.31/dist/vue.global.prod.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { padding-top: 70px; }
        footer { margin-top: 50px; padding: 20px 0; background-color: #f8f9fa; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Task Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/tasks">Задачи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tasks/create">Создать задачу</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <?php echo $content ?? ''; ?>
</main>

<footer class="text-center">
    <div class="container">
        <p>© <?php echo date('Y'); ?> Task Manager. Все права защищены.</p>
    </div>
</footer>
</body>
</html>