<?php

namespace App\Models;

use PDO;

class Task
{
    public static $pdo;

    public static function setConnection($pdo)
    {
        self::$pdo = $pdo;
    }

    public static function all($limit = null, $offset = null)
    {
        try {
            $query = "SELECT * FROM tasks";
            if ($limit !== null && $offset !== null) {
                $query .= " LIMIT :limit OFFSET :offset";
            }
            $stm = self::$pdo->prepare($query);
            if ($limit !== null && $offset !== null) {
                $stm->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                $stm->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            }
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public static function count()
    {
        try {
            $stm = self::$pdo->prepare("SELECT COUNT(*) FROM tasks");
            $stm->execute();
            return (int)$stm->fetchColumn();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return 0;
        }
    }

    public static function find($id)
    {
        try {
            $stm = self::$pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public static function create($data)
    {
        try {
            $stm = self::$pdo->prepare("
                INSERT INTO tasks (title, description, status)
                VALUES (:title, :description, :status)
            ");
            $stm->bindParam(':title', $data['title']);
            $stm->bindParam(':description', $data['description']);
            $stm->bindParam(':status', $data['status']);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function update($id, $data)
    {
        try {
            $stm = self::$pdo->prepare("
                UPDATE tasks
                SET title = :title, description = :description, status = :status
                WHERE id = :id
            ");
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->bindParam(':title', $data['title']);
            $stm->bindParam(':description', $data['description']);
            $stm->bindParam(':status', $data['status']);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function delete($id)
    {
        try {
            $stm = self::$pdo->prepare("DELETE FROM tasks WHERE id = :id");
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}