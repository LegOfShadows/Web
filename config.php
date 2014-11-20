<?php
// ////////////////////////////
// DEBUG MODE//////////////////
// ////////////////////////////
define ( 'DEBUG_MODE', TRUE );
$GLOBALS ['debug'] = '';

//Root and Directory Separator
define ( 'ROOT', dirname ( __FILE__ ) );
define ( 'DS', DIRECTORY_SEPARATOR );
// CSS and JS
define ( 'CSS_DIR', '/css/' );
define ( 'CSS_DEFAULT', CSS_DIR . 'style.css' );
define ( 'JS_DIR', '/js/' );
// Templating
define ( 'TEMPLATE_DIR', ROOT . DS . 'template' . DS );
define ( 'ELEMENT_DIR', TEMPLATE_DIR . 'element' . DS );
// Classes
define ( 'LIB_DIR', ROOT . DS . 'lib' . DS );
define ( 'CONTROLLER_DIR', ROOT . DS . 'controller' . DS );
define ( 'MODEL_DIR', ROOT . DS . 'model' . DS );
define ( 'VIEW_DIR', ROOT . DS . 'view' . DS );
// Title
define ( 'APP_TITLE', 'Leg of Shadows' );
// Database
define ( 'DB_HOSTNAME', 'localhost' );
define ( 'DB_USERNAME', 'http' );
define ( 'DB_PASSWORD', 'werewolf' );
define ( 'DB_PORT', 3306 );
define ( 'DB_DATABASE', 'ss');
// Autoloader
/**
 * * nullify any existing autoloads **
 */

spl_autoload_register ( null, false );

/**
 * * specify extensions that may be loaded **
 */
spl_autoload_extensions ( '.php, .class.php, .lib.php' );

/**
 * * class Loader **
 */
function controllerLoader($class) {
	$filename = strtolower ( $class ) . '.php';
	$file = 'controller/' . $filename;
	if (! file_exists ( $file )) {
		return false;
	}
	include $file;
}
function libLoader($class) {
	$filename = $class . '.php';
	$file = LIB_DIR . $filename;
	if (! file_exists ( $file )) {
		return false;
	}
	include $file;
}
function modelLoader($class) {
	$filename = $class . '.php';
	$file = MODEL_DIR . $filename;
	if (! file_exists ( $file )) {
		return false;
	}
	include $file;
}

/**
 * * register the loader functions **
 */
spl_autoload_register ( 'libLoader' );
spl_autoload_register ( 'modelLoader' );
spl_autoload_register ( 'controllerLoader' );