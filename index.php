<?php
require_once('config.php');

if (DEBUG_MODE == TRUE) {
	Log::Add('DEBUG_MODE',TRUE);
	Log::Add('Autoloader', spl_autoload_functions());
}

$session = new Session();
$db = new Database();

$url = $_SERVER['REQUEST_URI'];
$router = new Router($url);

Log::Add('SERVER',$_SERVER);

$router->Route();