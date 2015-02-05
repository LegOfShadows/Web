<?php
// ////////////////////////////
// DEBUG MODE//////////////////
// ////////////////////////////
 define ( 'DEBUG_MODE', FALSE );
$GLOBALS ['debug'] = '';

// Root and Directory Separator
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
define ( 'DB_DATABASE', 'ss' );
// Authorization
define ( 'AUTH_DEFAULT', 'allow' );
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
function tcpdfLoader($class) {
	$filename = $class . '.php';
	$file = 'tcpdf/' . $filename;
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
spl_autoload_register ( 'tcpdfLoader');
/**
 * Define flash messages
 */
// Auth
define ( 'MSG_LOGIN_REQUIRED', 'You must login before accessing this page' );
// Login
define ( 'MSG_LOGIN_WRONG_PASSWORD', 'Please make sure you input the correct password. Check if Caps Lock is ON' );
define ( 'MSG_LOGIN_WRONG_USERNAME', 'This username was not found' );
define ( 'MSG_LOGIN_SUCCESS', 'Login was successful, welcome!' );
define ( 'MSG_LOGIN_BANNED', 'You are banned from the server. Contact an administrator for further information');
// Logout
define ( 'MSG_LOGOUT_SUCCESS', 'Logged out successfully, see you soon!' );
// Register
define ( 'MSG_REGISTER_SUCCESS', 'Registration complete' );
define ( 'MSG_REGISTER_FAILURE', 'There was an error during the process, please try again later' );
define ( 'MSG_REGISTER_PASS_MISSMATCH', 'The passwords do not match, please try again. Check if Caps Lock is ON' );
define ( 'MSG_REGISTER_NOT_UNIQUE', 'This Username or Email is already used, please try another' );
// User
define ( 'MSG_USER_PASSWORD_CHANGED', 'Your password has been changed' );
define ( 'MSG_USER_ACCESS_CHANGED', 'Access level changed' );
define ( 'MSG_USER_ACCESS_LOW', 'You can only grant the same access level as yourself, not highier' );
// Database

define ( 'MSG_DB_ID_NOT_FOUND', 'ID wasn\'t found in the database' );

