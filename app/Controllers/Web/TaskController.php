<?php

namespace App\Controllers\Web;

use App\Models\Task;

class TaskController
{
    private function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../../../public/views/' . $view . '.php';
    }

    public function index(): void
    {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $totalTasks = Task::count();
        $totalPages = ceil($totalTasks / $perPage);
        $tasks = Task::all($perPage, $offset);

        $this->render('tasks/index', [
            'tasks' => $tasks,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function create(): void
    {
        $this->render('tasks/create');
    }

    public function store(): void
    {
        $input = $_POST;
        if (empty($input['title']) || empty($input['description']) || empty($input['status'])) {
            http_response_code(400);
            $this->render('tasks/create', ['error' => 'Заполните все поля']);
            return;
        }

        $result = Task::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'status' => $input['status'],
        ]);

        if ($result) {
            header('Location: /tasks');
            exit;
        } else {
            http_response_code(500);
            $this->render('tasks/create', ['error' => 'Ошибка при сохранении задачи']);
        }
    }


    public function edit($id): void
    {
        $id = (int)$id;
        $task = Task::find($id);
        if ($task) {
            $this->render('tasks/edit', ['task' => $task]);
        } else {
            http_response_code(404);
            $this->render('tasks/edit', ['error' => 'Задача не найдена']);
        }
    }

    public function show($id): void
    {
        $id = (int)$id;
        $task = Task::find($id);
        if ($task) {
            $this->render('tasks/show', ['task' => $task]);
        } else {
            http_response_code(404);
            $this->render('tasks/show', ['error' => 'Задача не найдена']);
        }
    }

    public function update($id): void
    {
        $id = (int)$id;
        $input = $_POST;
        if (empty($input['title']) || empty($input['description']) || empty($input['status'])) {
            http_response_code(400);
            $this->render('tasks/edit', ['error' => 'Заполните все поля', 'task' => ['id' => $id]]);
            return;
        }

        $result = Task::update($id, [
            'title' => $input['title'],
            'description' => $input['description'],
            'status' => $input['status'],
        ]);

        if ($result) {
            header('Location: /tasks');
            exit;
        } else {
            http_response_code(500);
            $this->render('tasks/edit', ['error' => 'Ошибка при обновлении задачи', 'task' => ['id' => $id]]);
        }
    }

    public function destroy($id): void
    {
        $id = (int)$id;
        $result = Task::delete($id);
        if ($result) {
            header('Location: /tasks');
            exit;
        } else {
            http_response_code(500);
            $this->render('tasks/index', ['error' => 'Ошибка при удалении задачи']);
        }
    }
}