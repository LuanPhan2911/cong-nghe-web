<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{

    public function index()
    {

        $breadcrumb = [
            [
                "url" => "/admin",
                "name" => "Home"
            ],
            [
                "url" => NULL,
                "name" => "Users"
            ],
        ];
        $userModel = new User();

        [
            'data' => $users,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'current_page' => $page,
        ] = $userModel->paginate();
        $prev = $page - 1;
        $next = $page + 1;
        return view("admin.users", [
            'breadcrumb' => $breadcrumb,
            'users' => $users,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'page' => $page,
            'prev' => $prev,
            'next' => $next
        ]);
    }

    public function updateState($user_id, $action)
    {
        $id = htmlspecialchars($user_id);
        $action = htmlspecialchars($action);
        if (empty($id) || empty($action) || !is_numeric($id)) {
            redirect("/admin");
            exit;
        }

        $userModel = new User();
        if ($action == "block") {
            $userModel->block($id);
        } else {
            $userModel->unblock($id);
        }


        $action = ucfirst($action);

        $_SESSION["msg"] = "$action user success!";

        $redirect_back = $_SERVER['HTTP_REFERER'];

        redirect($redirect_back);
        exit;
    }
}
