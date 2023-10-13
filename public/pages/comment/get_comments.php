<?php

use App\Database\Comment;

require_once __DIR__ . "/../../../vendor/autoload.php";
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
