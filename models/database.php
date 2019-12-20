<?php

class Database {
    private static $dsn = 'mysql:host='.HOST.';dbname='.DB;
    private static $username = USERNAME;
    private static $password = PASSWORD;
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                    self::$username,
                    self::$password);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }
}


?>