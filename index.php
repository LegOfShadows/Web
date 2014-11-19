<?php
require_once('Config.php');
require_once(CLASS_DIR.'Core.php');

$url = $_SERVER['REQUEST_URI'];
$router = new Router($url);

$router->Route();
