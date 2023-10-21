<?php
$router->mount("/admin", function () use ($router) {
    $router->get("/", "AdminController@index");
    $router->get("/stories/create", "StoryController@create");
    $router->post("/stories/create", "StoryController@store");
    $router->get("/stories/edit/(\d+)", "StoryController@edit");
    $router->post("/stories/edit", "StoryController@update");
    $router->get("/stories/edit/{story_id}/{action}", "StoryController@updateState");
    $router->get("/stories/destroy/{story_id}", "StoryController@destroy");


    $router->get('/users', 'UserController@index');
    $router->get('/users/edit/{user_id}/{action}', 'UserController@updateState');

    $router->get("/reports/type/{reported_type}", "ReportController@index");


    $router->get("/reports/edit/{report_id}/{finish}", "ReportController@updateState");
    $router->get("reports/delete_finish/{reported_type}", "ReportController@deleteFinish");



    $router->get("/comments/{comment_id}/reports/{report_id}/{action}", "CommentController@updateState");
    $router->get("/comments/destroy/{comment_id}", "CommentController@destroy");
});
