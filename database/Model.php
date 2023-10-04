<?php
class Model
{
    protected $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=localhost;dbname=review_truyen', 'root', '');
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
