<?php

use App\Database\Comment;
use App\Database\Story;
use App\Database\User;

require_once __DIR__ . "/../../../vendor/autoload.php";

$redirect_back = $_SERVER['HTTP_REFERER'];
if (!check_login()) {
    redirect($redirect_back);
    exit;
}

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
