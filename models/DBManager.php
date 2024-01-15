<?php

class DBManager
{
    public static function Connect($dbname){
        $dsn = "mysql:dbname={$dbname};host=localhost";
        $pdo = new PDO($dsn, 'root', 'root');
        return $pdo;
    }

}