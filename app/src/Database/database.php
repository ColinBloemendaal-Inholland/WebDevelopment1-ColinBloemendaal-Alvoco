<?php

namespace App\Database;

use App\Config;
use PDO;

/**
 * Summary of Database.
 * Lets you connect to the database.
 */
class Database
{
    public static function getConnection(): PDO
    {
        try {
            // set connection string
            $connectionString = 'mysql:host=' . Config::DB_SERVER_NAME . ';dbname=' . Config::DB_NAME . ';charset=utf8mb4';

            // create PDO connection
            $connection = new PDO(
                $connectionString,
                Config::DB_SERVER_USER,
                Config::DB_PASSWORD);

            // set error mode to exception
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (\PDOException $e) {
            throw new \PDOException('Database connection error: ' . $e->getMessage());
        }
    }
}
