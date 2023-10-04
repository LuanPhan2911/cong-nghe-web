<?php
require_once __DIR__ . "/../../middleware/session.php";
require __DIR__ . "/../../database/Story.php";
require_once __DIR__ . "/../../helper/helper.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
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

$storyModel = new Story();

$old_avatar = $storyModel->getAvatar($id);
$path_avatar = $old_avatar;
if (is_uploaded_file($avatar['tmp_name'])) {
    remove_file($old_avatar);
    $path_avatar = upload_file($avatar, "reviews/");
}





$storyModel->update(compact([
    'name', 'author_name',
    'description', 'review_content',
    'genres', 'path_avatar', 'id'
]));




$_SESSION['msg'] = "Update Review Success!";

$redirect_back = flash('redirect_back');
header("location: " . $redirect_back);
exit;
