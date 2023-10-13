<?php

namespace App\Database;

use Dotenv\Dotenv;

require_once __DIR__ . "/../../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();



class Model
{
    protected $conn;
    public function __construct()
    {
        try {
            $host = $_ENV['DB_HOST'];
            $name = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASSWORD'];
            $this->conn = new \PDO("mysql:host=$host;dbname=$name", $user, $password);
            //code...
        } catch (\Throwable $th) {
            //throw $th;

        }
    }

    public function __destruct()
    {
        $this->conn = NULL;
    }
}
