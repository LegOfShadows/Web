<?php
session_start ();
require_once ('config.php');

if (DEBUG_MODE == TRUE) {
	Log::Add ( 'DEBUG_MODE', TRUE );
	Log::Add ( 'Autoloader', spl_autoload_functions () );
}

$router = new Router ();

// TEST AREA //
Log::Add('Time',time());
// END TEST AREA //

$router->Route ();