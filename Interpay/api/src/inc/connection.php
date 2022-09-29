<?php

namespace App;

class Connection
{
    public static $_instance;

    public static function get()
    {
        try {

            self::$_instance = new \PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
            
        } catch (\PDOException $exception) {

            self::$_instance = 'Connection error: ' . $exception->getMessage();
        }

        return self::$_instance;
    }

    public static function lastInsertId()
    {
        return self::$_instance->lastInsertId();
    }
}
