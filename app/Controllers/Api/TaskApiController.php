<?php

namespace App\Controllers\Api;

use App\Models\Task;

class TaskApiController
{
    public function index(): void
    {
        header('Content-Type: application/json');
        $tasks = Task::all();
        echo json_encode(['message' => 'Список задач', 'data' => $tasks]);
        http_response_code(200);
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input['title']) || empty($input['description']) || empty($input['status'])) {
            echo json_encode(['message' => 'Ошибка: Заполните все поля']);
            http_response_code(400);
            return;
        }

        $result = Task::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'status' => $input['status'],
        ]);

        if ($result) {
            $task = Task::find(Task::$pdo->lastInsertId());
            echo json_encode(['message' => 'Задача создана', 'data' => $task]);
            http_response_code(201);
        } else {
            echo json_encode(['message' => 'Ошибка при создании задачи']);
            http_response_code(500);
        }
    }

    public function show(int $id): void
    {
        header('Content-Type: application/json');
        $task = Task::find($id);
        if ($task) {
            echo json_encode(['message' => 'Задача найдена', 'data' => $task]);
            http_response_code(200);
        } else {
            echo json_encode(['message' => 'Задача не найдена']);
            http_response_code(404);
        }
    }

    public function update(int $id): void
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input['title']) || empty($input['description']) || empty($input['status'])) {
            echo json_encode(['message' => 'Ошибка: Заполните все поля']);
            http_response_code(400);
            return;
        }

        $result = Task::update($id, [
            'title' => $input['title'],
            'description' => $input['description'],
            'status' => $input['status'],
        ]);

        if ($result) {
            $task = Task::find($id);
            echo json_encode(['message' => 'Задача обновлена', 'data' => $task]);
            http_response_code(200);
        } else {
            echo json_encode(['message' => 'Ошибка при обновлении задачи']);
            http_response_code(500);
        }
    }

    public function destroy(int $id): void
    {
        header('Content-Type: application/json');
        $result = Task::delete($id);
        if ($result) {
            echo json_encode(['message' => 'Задача удалена', 'id' => $id]);
            http_response_code(200);
        } else {
            echo json_encode(['message' => 'Ошибка при удалении задачи']);
            http_response_code(500);
        }
    }
}