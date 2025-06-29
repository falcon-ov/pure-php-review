<?php
ob_start();
?>
    <div id="app">
        <h1>Задача #{{ task.id }}</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php else: ?>
            <p><strong>Название:</strong> {{ task.title }}</p>
            <p><strong>Описание:</strong> {{ task.description }}</p>
            <p><strong>Статус:</strong> {{ task.status }}</p>
            <a href="/tasks" class="btn btn-primary">Вернуться к списку</a>
        <?php endif; ?>
    </div>
    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    task: <?php echo json_encode($task ?? []); ?>,
                };
            }
        }).mount('#app');
    </script>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>