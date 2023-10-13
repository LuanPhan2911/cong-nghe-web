<?php
require_once __DIR__ . "/../vendor/autoload.php";
session_unset();
session_destroy();
redirect("/index.php");
