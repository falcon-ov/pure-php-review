<?php

namespace Database;
use \PDO;
Use \PDOException;
class Database
{
    public static function getConnection()
    {
        try {
            $pdo = new PDO("sqlite:".__DIR__."/database.db");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Успешное подключение";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $pdo;
    }
}
