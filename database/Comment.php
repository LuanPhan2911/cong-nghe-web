<?php
require_once __DIR__ . "/Model.php";
class Comment extends Model
{

    public function countAll()
    {
        $statement = $this->conn->query("select 
        count(*) as total_comment
        from comments");

        return $statement->fetchColumn();
    }
}
