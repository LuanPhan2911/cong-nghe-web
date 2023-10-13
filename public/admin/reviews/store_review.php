<?php

use App\Database\Story;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$name = htmlspecialchars($_POST['name']) ?? NULL;
$author_name = htmlspecialchars($_POST['author_name']) ?? NULL;
$description = htmlspecialchars($_POST['description']) ?? NULL;
$review_content = htmlspecialchars($_POST['review_content']) ?? NULL;
$genres = htmlspecialchars($_POST['genres']) ?? NULL;

$avatar = $_FILES['avatar'];


if (empty($name) || empty($author_name) || empty($description) || empty($review_content) || empty($genres)) {
    $_SESSION['err'] = "Missing some field data!";
    $_SESSION['story_name'] = $name;
    $_SESSION['author_name'] = $author_name;
    $_SESSION['genres'] = $genres;
    $_SESSION['description'] = $description;
    $_SESSION['review_content'] = $review_content;
    redirect("/admin/create_review.php");
    exit;
}
if (!is_uploaded_file($avatar['tmp_name'])) {
    $_SESSION['err'] = "Missing avatar!";
    $_SESSION['story_name'] = $name;
    $_SESSION['author_name'] = $author_name;
    $_SESSION['genres'] = $genres;
    $_SESSION['description'] = $description;
    $_SESSION['review_content'] = $review_content;
    redirect("/admin/create_review.php");
    exit;
}

$path_avatar = upload_file($avatar, "reviews/");




$storyModel = new Story();

$storyModel->insert([
    'name' => $name,
    'author_name' => $author_name,
    'description' => $description,
    'review_content' => $review_content,
    'genres' => $genres,
    'path_avatar' => $path_avatar
]);
$_SESSION['msg'] = "Create Review Success!";
redirect("/admin/index.php");
exit;
