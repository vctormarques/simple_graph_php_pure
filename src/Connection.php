<?php

namespace App\GraphQL;

class Connection 
{
    private static $conn;

    public static function get()
    {
        if (!self::$conn) {
            self::$conn = new \PDO(
                'mysql:host=localhost;dbname=contatos_graphql', 
                'root', 
                null);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}