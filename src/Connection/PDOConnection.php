<?php

namespace OS\Connection;

include 'env.php';

class PDOConnection
{

    private $host;
    private $database;
    private $user;
    private $password;
    private $driver;

    public function __construct()
    {
        $this->host = DBHOST;
        $this->database = DBNAME;
        $this->user = DBUSER;
        $this->password = DBPASS;
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