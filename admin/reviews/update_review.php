<?php
require_once __DIR__ . "/../../middleware/session.php";
require __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../helper/helper.php";
$id = $_POST['id'] ?? NULL;
$name = $_POST['name'] ?? NULL;
$author_name = $_POST['author_name'] ?? NULL;
$description = $_POST['description'] ?? NULL;
$review_content = $_POST['review_content'] ?? NULL;
$genres = $_POST['genres'] ?? NULL;

$avatar = $_FILES['avatar'];

$_SESSION['story_name'] = $name;
$_SESSION['author_name'] = $author_name;
$_SESSION['genres'] = $genres;
if (empty($name) || empty($author_name) || empty($description) || empty($review_content) || empty($genres) || empty($id)) {
    $_SESSION['err'] = "Missing some field data!";

    header("location:../edit_review.php?id=$id");
    exit;
}

$query = "select avatar from stories where id='$id'";
$result = mysqli_query($connect, $query);
$old_avatar = mysqli_fetch_column($result);
$path_avatar = $old_avatar;
if (is_uploaded_file($avatar['tmp_name'])) {
    remove_file($old_avatar);
    $path_avatar = upload_file($avatar, "reviews/");
}

$query = "update stories set
name='$name',
author_name='$author_name',
description='$description',
review_content='$review_content',
genres='$genres',
avatar='$path_avatar'
where
id='$id'
";
mysqli_query($connect, $query);



$_SESSION['msg'] = "Update Review Success!";

$redirect_back = flash('redirect_back');
header("location: " . $redirect_back);
exit;
