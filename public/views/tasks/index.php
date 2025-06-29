<?php
ob_start();
?>
    <div id="app">
        <h1>Список задач</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div v-if="tasks.length === 0" class="alert alert-info">Нет задач</div>
        <ul class="list-group mb-4" v-else>
            <li v-for="task in tasks" :key="task.id" class="list-group-item">
                <strong>{{ task.title }}</strong>: {{ task.description }} (Статус: {{ task.status }})
                <div class="mt-2">
                    <a :href="'/tasks/' + task.id" class="btn btn-sm btn-primary">Просмотр</a>
                    <a :href="'/tasks/' + task.id + '/edit'" class="btn btn-sm btn-secondary">Редактировать</a>
                    <form :action="'/tasks/' + task.id + '/delete'" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger" @click="confirmDelete">Удалить</button>
                    </form>
                </div>
            </li>
        </ul>
        <nav v-if="totalPages > 1">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link" :href="'/tasks?page=' + (currentPage - 1)" v-if="currentPage > 1">Предыдущая</a>
                    <span class="page-link" v-else>Предыдущая</span>
                </li>
                <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: page === currentPage }">
                    <a class="page-link" :href="'/tasks?page=' + page">{{ page }}</a>
                </li>
                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <a class="page-link" :href="'/tasks?page=' + (currentPage + 1)" v-if="currentPage < totalPages">Следующая</a>
                    <span class="page-link" v-else>Следующая</span>
                </li>
            </ul>
        </nav>
    </div>
    <script>
        const { createApp } = Vue;
        createApp({
            data() {
                return {
                    tasks: <?php echo json_encode($tasks); ?>,
                    currentPage: <?php echo json_encode($currentPage); ?>,
                    totalPages: <?php echo json_encode($totalPages); ?>,
                };
            },
            methods: {
                confirmDelete(event) {
                    if (!confirm('Вы уверены, что хотите удалить задачу?')) {
                        event.preventDefault();
                    }
                }
            }
        }).mount('#app');
    </script>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>