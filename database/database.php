<?php
class Database
{
    public function getConnection()
    {
        try {
            $pdo = new PDO("sqlite:../database.db");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Успешное подключение";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pdo;
    }
}
