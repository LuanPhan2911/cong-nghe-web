<?php

namespace App\Models;

class Report extends Model
{

    public function valid($reported_type, $reported_id)
    {
        $statement = $this->conn->query("select * from $reported_type where id= '$reported_id'");
        return $statement->rowCount();
    }

    public function insert($atr)
    {
        $statement = $this->conn->prepare("insert into reports(reported_id, reported_type, content)
        values(:reported_id,:reported_type, :report_content)");


        $statement->execute([
            ...$atr
        ]);

        return $statement->rowCount();
    }

    public function getReport($reported_type = 'comments')
    {
        $query = "";
        if ($reported_type === 'comments') {
            $query = "select 
            reports.id, reports.content,reports.finish,
            comments.id as comment_id, comments.content as comment_content, comments.deleted_at as comment_deleted
            from reports
            join comments on reports.reported_id=comments.id
            where reported_type='comments'  
            ";
        } else
        
        if ($reported_type === 'stories') {
            $query = "select 
            reports.id, reports.content,reports.finish,
            stories.id as story_id, stories.name as story_name
            from reports
            join stories on reports.reported_id=stories.id
            where reported_type='stories'   
            ";
        }

        $statement = $this->conn->query($query);
        return $statement->fetchAll();
    }

    public function deleteFinish($type)
    {
        return $this->conn->exec("delete from reports where finish=1 and reported_type='$type'");
    }

    public function finish($id)
    {
        return $this->conn->exec("update reports 
        set
        finish=1
        where 
        id='$id'");
    }
    public function unFinish($id)
    {
        return $this->conn->exec("update reports 
        set
        finish=0
        where 
        id='$id'");
    }

    public function delete($reported_type, $reported_id)
    {
        return $this->conn->exec("delete from reports 
        where reported_id='$reported_id' and reported_type='$reported_type'");
    }
}
