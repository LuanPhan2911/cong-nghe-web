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

    public function insert(array $atr)
    {
        $statement = $this->conn->prepare(
            "insert into comments(user_id, story_id, content)
            values(:user_id, :story_id, :comment_content)"
        );

        $statement->execute([...$atr]);
        return $statement->rowCount();
    }

    public function countByStoryId($story_id = NULL)
    {

        $query = "select count(*) from comments ";
        if (empty($story_id)) {
            $query .= "where comments.deleted_at is NULL ";
        } else {
            $query .= "where comments.story_id='$story_id' and comments.deleted_at is NULL ";
        }

        $statement = $this->conn->query($query);
        return $statement->fetchColumn();
    }
    public function paginate(int $limit = 10, $story_id = NULL)
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $query = "select 
        comments.id, comments.content, comments.created_at, 
        users.name as user_name, users.avatar as user_avatar,
        stories.name as story_name, stories.id as story_id
        from comments 
        join users on users.id= comments.user_id
        join stories on stories.id = comments.story_id ";
        if (empty($story_id)) {
            $query .= "where comments.deleted_at is NULL ";
        } else {
            $query .= "where comments.story_id='$story_id' and comments.deleted_at is NULL ";
        }

        $query .= "order by comments.created_at desc limit $limit offset $offset";

        $statement = $this->conn->query($query);

        $total_record = $this->countByStoryId($story_id);
        $total_page = ceil(intval($total_record) / intval($limit));

        return [
            'data' => $statement->fetchAll(),
            'total_record' => $total_record,
            'total_page' => $total_page,
            'current_page' => $page
        ];
    }

    public function block($id)
    {
        return $this->conn->exec("update comments
        set
        deleted_at=CURRENT_TIME()
        where
        id='$id'");
    }
    public function unBlock($id)
    {
        return $this->conn->exec("update comments
        set
        deleted_at=NULL
        where
        id='$id'");
    }

    public function delete($id)
    {
        return $this->conn->exec("delete from comments where id='$id'");
    }
}
