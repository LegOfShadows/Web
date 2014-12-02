<?php
session_start ();
require_once ('config.php');

if (DEBUG_MODE == TRUE) {
	Log::Add ( 'DEBUG_MODE', TRUE );
	Log::Add ( 'Autoloader', spl_autoload_functions () );
}

$router = new Router ();

// TEST AREA //
// Log::Add('Time',date('Y-M-d', time()));
// END TEST AREA //
$user = new User();
// var_dump($user->All());

echo $user->Exists('id',1);
echo $user->Exists('id',2);
echo $user->Exists('username','Shadow');
echo $user->Exists('lastname','Solo');
echo $user->Exists('potato','Solo');
$router->Route ();

