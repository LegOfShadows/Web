<?php
require_once('Config.php');

//require_once(CLASS_DIR.'Core.php');
if (DEBUG_MODE == TRUE) {
	lib\Log::Add('DEBUG_MODE',TRUE);
	lib\Log::ADD('Autoloader', spl_autoload_functions());
}

$url = $_SERVER['REQUEST_URI'];
$router = new lib\Router($url);

lib\Log::Add('SERVER',$_SERVER);

$router->Route();