<?php

namespace App\Models;

class User extends Model
{



    public function exist(string $email)
    {

        $statement = $this->conn->prepare("select * from users where email=:email and deleted_at is null");

        $statement->execute([
            'email' => $email
        ]);
        $user = $statement->fetch();
        return  empty($user) ? NULL : $user;
    }

    public function insert(string $name, string $email, string $password)
    {
        $statement = $this->conn->prepare("insert into users(name, email, password) values(:name,:email,:password)");

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $user_id = $this->conn->lastInsertId();
        return empty($user_id) ? NULL : $user_id;
    }

    public function findOne(string $id, bool $withDeletedAt = false)
    {
        $query = "";

        if ($withDeletedAt) {
            $query = "select * from users where id = :id";
        } else {
            $query = "select * from users where deleted_at is NULL and   id = :id";
        }
        $statement = $this->conn->prepare($query);
        $statement->execute([
            'id' => $id
        ]);
        $data = $statement->fetch();
        return empty($data) ? NULL : $data;
    }

    public function update(array $attr)
    {
        $statement = $this->conn->prepare("
        update users set
            name=:name,
            avatar=:avatar,
            birth_year=:birth_year,
            description=:description,
            gender=:gender
            where
            id=:id
        ");

        return $statement->execute($attr);
    }

    public function countAll()
    {
        $statement = $this->conn->query("select count(*) from users where role = 0");
        return $statement->fetchColumn();
    }

    public function paginate(int $limit = 10)
    {
        $page =  htmlspecialchars($_GET['page'] ?? 1);
        $offset = ($page - 1) * $limit;

        $statement = $this->conn->query("select 
        id,name,email, avatar, birth_year, gender, created_at, deleted_at 
        from users 
        where 
        role=0 order by deleted_at asc limit $limit offset $offset");


        $total_record = $this->countAll();
        $total_page = ceil(intval($total_record) / intval($limit));

        return [
            'data' => $statement->fetchAll(),
            'total_record' => $total_record,
            'total_page' => $total_page,
            'current_page' => $page,
        ];
    }

    public function block(string $id)
    {
        $statement = $this->conn->prepare("update users 
        set deleted_at=CURRENT_TIME()
        where id= :id");

        return $statement->execute(['id' => $id]);
    }
    public function unblock(string $id)
    {
        $statement = $this->conn->prepare("update users 
        set deleted_at=NULL
        where id= :id");

        return $statement->execute(['id' => $id]);
    }
}
