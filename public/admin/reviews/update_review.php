<?php

use App\Database\Story;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$id = htmlspecialchars($_POST['id']) ?? NULL;
$name = htmlspecialchars($_POST['name']) ?? NULL;
$author_name = htmlspecialchars($_POST['author_name']) ?? NULL;
$description = htmlspecialchars($_POST['description']) ?? NULL;
$review_content = htmlspecialchars($_POST['review_content']) ?? NULL;
$genres = htmlspecialchars($_POST['genres']) ?? NULL;

$avatar = $_FILES['avatar'];

$_SESSION['story_name'] = $name;
$_SESSION['author_name'] = $author_name;
$_SESSION['genres'] = $genres;
if (empty($name) || empty($author_name) || empty($description) || empty($review_content) || empty($genres) || empty($id)) {
    $_SESSION['err'] = "Missing some field data!";

    redirect("/admin/edit_review.php?id=$id");
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
redirect($redirect_back);
exit;
