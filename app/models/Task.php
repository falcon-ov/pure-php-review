<?php
class Task
{
    private static $pdo;

    public static function setConnection($pdo)
    {
        self::$pdo = $pdo;
    }
    /**
     * Get all
     */
    public static function all()
    {
        $stm = self::$pdo->prepare("SELECT * FROM tasks");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Find by id
     */
    public static function find($id)
    {
        $stm = self::$pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $stm->bindParam(':id', $id);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Create
     */
    public static function create($data)
    {
        $stm = self::$pdo->prepare("
            INSERT INTO tasks (title, description, status)
            VALUES (:title, :description, :status)
        ");
        $stm->bindParam(':title', $data['title']);
        $stm->bindParam(':description', $data['description']);
        $stm->bindParam(':status', $data['status']);
        return $stm->execute();
    }
    /**
     * Update
     */
    public static function update($id, $data)
    {
        $title = $data['title'];
        $description = $data['description'];
        $status = $data['status'];

        $stm = self::$pdo->prepare("
        UPDATE tasks
        SET title = :title, description = :description, status = :status
        WHERE :id
        ");
        $stm->bindParam(':id', $id);
        $stm->bindParam(':title', $title);
        $stm->bindParam(':description', $description);
        $stm->bindParam(':status', $status);
        return $stm->execute();
    }
    /**
     * Delete
     */
    public static function delete($id)
    {
        $stm = self::$pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stm->bindParam(':id', $id);
        return $stm->execute();
    }
    
}
