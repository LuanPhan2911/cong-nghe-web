<?php
$router->get("/comments", "CommentController@index");

$router->post("/reports/create", "ReportController@store");

$router->get("/stories/count_review", "StoryController@countReview");
