<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Report;
use App\Models\Story;
use App\Models\User;

class CommentController
{
    public function index()
    {
        header('Content-Type: application/json; charset=utf-8');
        $story_id = htmlspecialchars($_GET['id']) ?? NULL;
        $commentModel = new Comment();
        [
            'data' => $result,
            'total_page' => $total_page,
            'current_page' => $page,
        ] = $commentModel->paginate(10, $story_id);
        $next_page = $page + 1;
        if ($next_page > $total_page) {
            $next_page = NULL;
        }

        $comments = [];
        foreach ($result as $each) {
            $comments[] = $each;
        }


        echo json_encode([
            "data" => [
                'data' => $comments,
                'next_page' => $next_page,
            ],
            "success" => true,

        ]);
    }

    public function store()
    {
        $redirect_back = $_SERVER['HTTP_REFERER'];

        $story_id = htmlspecialchars($_POST['story_id']) ?? NULL;
        $user_id = $_SESSION['user_id'] ?? NULL;
        $comment_content = htmlspecialchars($_POST['comment_content']) ?? NULL;

        if (empty($story_id) || empty($user_id) || empty($comment_content)) {
            $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
            $_SESSION['comment_content'] = $comment_content;
            redirect($redirect_back);
            exit;
        }


        $storyModel = new Story();

        $data = $storyModel->findOne($story_id);

        if (empty($data)) {
            $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
            $_SESSION['comment_content'] = $comment_content;
            redirect($redirect_back);
            exit;
        }

        $userModel = new User();

        $user = $userModel->findOne($user_id);
        if (empty($user)) {
            $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
            $_SESSION['comment_content'] = $comment_content;
            redirect($redirect_back);
            exit;
        }


        $commentModel = new Comment();

        $result = $commentModel->insert(
            compact(['user_id', 'story_id', 'comment_content'])
        );

        if ($result) {
            $_SESSION['msg'] = "Bình luận thành công!";
            redirect($redirect_back);
            exit;
        }

        $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
        $_SESSION['comment_content'] = $comment_content;
        redirect($redirect_back);
        exit;
    }

    public function updateState($comment_id, $report_id, $action)
    {
        $report_id = htmlspecialchars($report_id);
        $comment_id = htmlspecialchars($comment_id);
        $action = htmlspecialchars($action);
        $redirect_back =  $_SERVER['HTTP_REFERER'];

        $reportModel = new Report();
        $commentModel = new Comment();

        $reportModel->finish($report_id);


        switch ($action) {
            case 'block':
                $commentModel->block($comment_id);
                break;
            case 'unblock':
                $commentModel->unBlock($comment_id);
                break;
            default:
        }

        $action = ucfirst($action);
        $_SESSION["msg"] = "$action comment success!";


        redirect($redirect_back);
        exit;
    }

    public function destroy($comment_id)
    {
        $comment_id = htmlspecialchars($comment_id);
        $redirect_back =  $_SERVER['HTTP_REFERER'];

        $reportModel = new Report();
        $commentModel = new Comment();


        $reportModel->delete(reported_type: 'comments', reported_id: $comment_id);


        $commentModel->delete($comment_id);

        $_SESSION["msg"] = "Delete comment success!";



        redirect($redirect_back);
        exit;
    }
}
