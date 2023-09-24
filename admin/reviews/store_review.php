<?php
require_once __DIR__ . "/../../middleware/session.php";
require __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../helper/helper.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$name = $_POST['name'] ?? NULL;
$author_name = $_POST['author_name'] ?? NULL;
$description = $_POST['description'] ?? NULL;
$review_content = $_POST['review_content'] ?? NULL;
$genres = $_POST['genres'] ?? NULL;

$avatar = $_FILES['avatar'];


if (empty($name) || empty($author_name) || empty($description) || empty($review_content) || empty($genres)) {
    $_SESSION['err'] = "Missing some field data!";
    $_SESSION['story_name'] = $name;
    $_SESSION['author_name'] = $author_name;
    $_SESSION['genres'] = $genres;
    $_SESSION['description'] = $description;
    $_SESSION['review_content'] = $review_content;
    header("location:../create_review.php");
    exit;
}
if (!is_uploaded_file($avatar['tmp_name'])) {
    $_SESSION['err'] = "Missing avatar!";
    $_SESSION['story_name'] = $name;
    $_SESSION['author_name'] = $author_name;
    $_SESSION['genres'] = $genres;
    $_SESSION['description'] = $description;
    $_SESSION['review_content'] = $review_content;
    header("location:../create_review.php");
    exit;
}

$path_avatar = upload_file($avatar, "reviews/");
$query = "insert into stories(name, author_name, description, review_content, genres, avatar)
values('$name', '$author_name', '$description', '$review_content', '$genres', '$path_avatar')";

mysqli_query($connect, $query);


mysqli_close($connect);
$_SESSION['msg'] = "Create Review Success!";
header("location:../index.php");
exit;
