<?php

namespace OS\Repository;

include dirname(__DIR__, 2).'/autoloader.php';

use OS\Connection\PDOConnection;

abstract class Repository
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new PDOConnection;
        $this->conn = $this->conn->connect();
    }

}