<?php
ob_start();
?>
    <div id="app">
        <h1>Редактирование задачи #{{ task.id }}</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php else: ?>
            <form method="POST" :action="'/tasks/' + task.id">
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3">
                    <label for="title" class="form-label">Название</label>
                    <input type="text" class="form-control" id="title" name="title" v-model="form.title">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" v-model="form.description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Статус</label>
                    <input type="text" class="form-control" id="status" name="status" v-model="form.status">
                </div>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        <?php endif; ?>
    </div>
    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    task: <?php echo json_encode($task ?? []); ?>,
                    form: {
                        title: <?php echo json_encode($task['title'] ?? ''); ?>,
                        description: <?php echo json_encode($task['description'] ?? ''); ?>,
                        status: <?php echo json_encode($task['status'] ?? 'pending'); ?>,
                    }
                };
            }
        }).mount('#app');
    </script>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>