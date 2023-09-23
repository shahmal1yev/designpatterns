<?php

interface DBConnection
{
    public static function getInstance();
    public static function setDriver(string $driver): void;
    public static function setHost(string $host): void;
    public static function setDatabase(string $database): void;
    public static function setUsername(string $username): void;
    public static function setPassword(string $password): void;
}

class MySQLConnection implements DBConnection
{
    private static $instance;
    private static $driver;
    private static $host;
    private static $database;
    private static $username;
    private static $password;

    private function __construct()
    {
        if (!self::$driver || !self::$host || !self::$database || !self::$username || !self::$password) {
            throw new \Exception("Database connection parameters are missing.", 1);
        }

        self::$instance = new PDO(self::$driver. ":host=". self::$host . ";dbname=". self::$database, self::$username, self::$password);
    }

    private function __clone() {}

    public static function getInstance()
    {
        if (self::$instance === null)
        {
            new MySQLConnection();
        }

        return self::$instance;
    }

    public static function setDriver(string $driver): void
    {
        self::$driver = $driver;
    }

    public static function setHost(string $host): void
    {
        self::$host = $host;
    }

    public static function setDatabase(string $database): void
    {
        self::$database = $database;
    }

    public static function setUsername(string $username): void
    {
        self::$username = $username;
    }

    public static function setPassword(string $password): void
    {
        self::$password = $password;
    }
}

MySQLConnection::setDriver('mysql');
MySQLConnection::setHost('localhost');
MySQLConnection::setDatabase('designpatterns');
MySQLConnection::setUsername('root');
MySQLConnection::setPassword('ucvlqcq8');

$instance = MySQLConnection::getInstance();

$instance->query('SELECT * FROM `users`');