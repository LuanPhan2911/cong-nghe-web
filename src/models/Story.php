<?php

namespace App\Models;

class Story extends Model
{

    public function getFeatureReview()
    {
        $statement = $this->conn->query(
            "select * from stories where deleted_at is NULL and pinned='1' limit 5"
        );


        $data = $statement->fetchAll();
        return empty($data) ? NULL : $data;
    }

    public function countAll(bool $withDeletedAt = false)
    {
        $query = "";
        if ($withDeletedAt) {
            $query = "select count(*) from stories";
        } else {
            $query = "select count(*) from stories where deleted_at is NULL";
        }
        $statement = $this->conn->query($query);

        return $statement->fetchColumn();
    }
    public function paginate(int $limit = 5, bool $withDeletedAt = false)
    {
        $page =  htmlspecialchars($_GET['page'] ?? 1);
        $offset = ($page - 1) * $limit;

        $query = "";
        if ($withDeletedAt) {
            $query = "select * from stories order by created_at desc limit $limit offset $offset";
        } else {
            $query = "select *
            from stories 
            where
            deleted_at is NULL
            order by view_count desc 
            limit $limit 
            offset $offset";
        }
        $statement = $this->conn->query($query);
        $total_record = $this->countAll(withDeletedAt: $withDeletedAt);
        $total_page = ceil(intval($total_record) / intval($limit));

        return [
            'data' => $statement->fetchAll(),
            'total_record' => $total_record,
            'total_page' => $total_page,
            'current_page' => $page,
        ];
    }

    public function getNewReview()
    {
        $statement = $this->conn->query(
            "select * from stories where deleted_at is NULL order by created_at desc limit 10"
        );


        $data = $statement->fetchAll();
        return empty($data) ? NULL : $data;
    }

    public function findOne($id, bool $withDeletedAt = false)
    {

        $query = "";
        if ($withDeletedAt) {
            $query = "select * from stories where id=:id";
        } else {
            $query = "select * from stories where deleted_at is NULL and id=:id";
        }
        $statement = $this->conn->prepare(
            $query
        );
        $statement->execute([
            'id' => $id
        ]);
        $data = $statement->fetch();


        return empty($data) ? NULL : $data;
    }

    public function updateViewCount($id)
    {
        $statement = $this->conn->prepare("
        update stories 
        set
        view_count=view_count +1
        where id=:id");

        return $statement->execute([
            'id' => $id
        ]);
    }

    public function findAll($q)
    {
        $statement = $this->conn->query("
        select * from stories
        where
        deleted_at is NULL 
        and 
        (name like '%$q%'
        or 
        author_name like '%$q%')
        ");



        $data = $statement->fetchAll();

        return empty($data) ? NULL : $data;
    }

    public function totalViewCount()
    {
        $statement = $this->conn->query("select 
        sum(view_count) as total_view_count from stories");
        return $statement->fetchColumn();
    }

    public function getReviewChart()
    {
        $statement = $this->conn->query("select 
        name, view_count
        from stories
        order by view_count desc
        limit 10");
        $data = $statement->fetchAll();
        return empty($data) ? NULL : $data;
    }

    public function getAvatar($id)
    {
        $statement = $this->conn->prepare("select avatar from stories where id=:id");

        $statement->execute([
            'id' => $id
        ]);

        return $statement->fetchColumn();
    }

    public function delete($id)
    {
        return  $this->conn->exec("delete from stories where id='$id'");
    }

    public function hide($id)
    {
        return $this->conn->exec("update stories 
        set
        deleted_at=CURRENT_TIME()
        where 
        id='$id'");
    }
    public function show($id)
    {
        return $this->conn->exec("update stories 
        set
        deleted_at=NULL
        where 
        id='$id'");
    }

    public function pinned($id)
    {
        return $this->conn->exec("update stories 
        set
        pinned=1
        where 
        id='$id'");
    }
    public function unPinned($id)
    {
        return $this->conn->exec("update stories 
        set
        pinned=0
        where 
        id='$id'");
    }

    public function insert($atr)
    {
        $statement = $this->conn->prepare(
            "insert into stories(name, author_name, description, review_content, genres, avatar)
            values(:name, :author_name, :description, :review_content, :genres, :path_avatar)"
        );

        $statement->execute([
            ...$atr
        ]);

        return $statement->rowCount();
    }

    public function update($atr)
    {
        $statement = $this->conn->prepare("update stories set
        name=:name,
        author_name=:author_name,
        description=:description,
        review_content=:review_content,
        genres=:genres,
        avatar=:path_avatar
        where
        id=:id");

        $statement->execute([...$atr]);
        return $statement->rowCount();
    }
}
