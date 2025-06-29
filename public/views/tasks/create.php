<?php
ob_start();
?>
    <div id="app">
        <h1>Создание задачи</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" action="/tasks">
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
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    form: {
                        title: '',
                        description: '',
                        status: 'pending',
                    }
                };
            }
        }).mount('#app');
    </script>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>