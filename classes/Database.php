<?php

class Database
{
    private PDO $connection;
    public function __construct() {
        $config = require __DIR__ . '/../config/database.php';

        try {
            $this->connection = new PDO(
                "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8",
                $config['db_user'],
                $config['db_pass']
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());

        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}