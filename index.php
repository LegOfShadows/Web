<?php
require_once('Config.php');
require_once(CLASS_DIR.'Core.php');
if (DEBUG_MODE == TRUE) {
	require_once(CLASS_DIR.'Log.php');
}

$url = $_SERVER['REQUEST_URI'];
$router = new Router($url);

Log::Add('SERVER',$_SERVER);

$router->Route();