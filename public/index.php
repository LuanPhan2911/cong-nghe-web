<?php
require_once __DIR__ . "/../vendor/autoload.php";


$router = new \Bramus\Router\Router();
$router->setNamespace('\App\Controllers');
//middleware
require_once SRC_DIR . "/middlewares/index.php";
//routes
require_once SRC_DIR . "/routes/web.php";
//auth
require_once SRC_DIR . "/routes/auth.php";
// api
require_once SRC_DIR . "/routes/api.php";
//admin
require_once SRC_DIR . "/routes/admin.php";

$router->set404(fn () => view('404'));
$router->run();
