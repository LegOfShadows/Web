<?php
require_once ('config.php');

if (DEBUG_MODE == TRUE) {
	Log::Add ( 'DEBUG_MODE', TRUE );
	//Log::Add ( 'Autoloader', spl_autoload_functions () );
}
session_start ();
$router = new Router ();

// TEST AREA //
// Log::Add('Time',date('Y-M-d', time()));
// END TEST AREA //
$router->Route ();

