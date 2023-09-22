<?php
require_once __DIR__ . "/../database/connect.php";
require_once __DIR__ . "/../middleware/session.php";

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

$query = "select * from stories where id='$story_id'";
$result = mysqli_query($connect, $query);
if (!(mysqli_num_rows($result) > 0)) {
    $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
    $_SESSION['comment_content'] = $comment_content;
    header($redirect_back);
    exit;
}


$query = "select * from users where id='$user_id'";
$result = mysqli_query($connect, $query);
if (!(mysqli_num_rows($result) > 0)) {
    $_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
    $_SESSION['comment_content'] = $comment_content;
    header($redirect_back);
    exit;
}



$query = "insert into comments(user_id, story_id, content)
            values('$user_id', '$story_id', '$comment_content')";

$result = mysqli_query($connect, $query);

if ($result) {
    $_SESSION['msg'] = "Bình luận thành công!";
    header($redirect_back);
    exit;
}

$_SESSION['err'] = "Nội dung bình luận không hợp lệ!";
$_SESSION['comment_content'] = $comment_content;
header($redirect_back);
exit;
