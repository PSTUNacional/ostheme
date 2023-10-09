<?php

namespace OS\Repository;

include get_template_directory() . '/autoloader.php';

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
