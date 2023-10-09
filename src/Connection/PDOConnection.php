<?php

namespace OS\Connection;

class PDOConnection
{

    private $host;
    private $database;
    private $user;
    private $password;
    private $driver;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->database = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->driver = 'mysql';
    }

    public function connect()
    {
        try {

            $conn = new \PDO(
                "{$this->driver}:host={$this->host};dbname={$this->database};charset=utf8mb4",
                $this->user,
                $this->password
            );

            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (\PDOException $e) {
            echo '<pre>'.$e;
            die('Não foi possível solicitar a conexão com nossos servidores. Tente novamente.');
        }
    }
}