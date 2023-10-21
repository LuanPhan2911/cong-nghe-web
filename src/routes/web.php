<?php
$router->get("/", "HomeController@index");
$router->get("/review/(\d+)", "HomeController@show");
$router->get("/search", "HomeController@search");
$router->get("/404", "HomeController@page404");

//comment
$router->post("/comments/create", "CommentController@store");
