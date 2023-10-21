<?php
$router->get("/login", 'AuthController@loginForm');
$router->post("/login", 'AuthController@login');

$router->get("/register", 'AuthController@registerForm');
$router->post("/register", 'AuthController@register');

$router->get("user/(\d+)", "AuthController@edit");
$router->post("user/(\d+)", "AuthController@update");
$router->get("logout", 'AuthController@logout');
