<?php

require_once __DIR__ . "/../../database/Comment.php";
require_once __DIR__ . "/../../database/Story.php";
require_once __DIR__ . "/../../database/User.php";
require_once __DIR__ . "/../../middleware/session.php";

$redirect_back = "location:" . $_SERVER['HTTP_REFERER'];
if (!check_login()) {
    header($redirect_back);
    exit;
}

$story_id = $_POST['story_id'];
$user_id = $_SESSION['user_id'];
$comment_content = $_POST['comment_content'];

if (empty($story_id) || empty($user_id) || empty($comment_content)) {
    $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
    $_SESSION['comment_content'] = $comment_content;
    header($redirect_back);
    exit;
}


$storyModel = new Story();

$data = $storyModel->findOne($story_id);

if (empty($data)) {
    $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
    $_SESSION['comment_content'] = $comment_content;
    header($redirect_back);
    exit;
}

$userModel = new User();

$user = $userModel->findOne($user_id);
if (empty($user)) {
    $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
    $_SESSION['comment_content'] = $comment_content;
    header($redirect_back);
    exit;
}


$commentModel = new Comment();

$result = $commentModel->insert(
    compact(['user_id', 'story_id', 'comment_content'])
);

if ($result) {
    $_SESSION['msg'] = "Bình luận thành công!";
    header($redirect_back);
    exit;
}

$_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
$_SESSION['comment_content'] = $comment_content;
header($redirect_back);
exit;
