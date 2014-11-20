<?php
//////////////////////////////
//DEBUG MODE//////////////////
//////////////////////////////
define ('DEBUG_MODE', TRUE);//
$GLOBALS['debug'] = '';		//
//////////////////////////////
//Root and Directory Separator
define ( 'ROOT', dirname ( __FILE__ ) );
define ( 'DS', DIRECTORY_SEPARATOR );
//CSS and JS
define ( 'CSS_DIR', '/css/' );
define ( 'CSS_DEFAULT', CSS_DIR . 'style.css' );
define ( 'JS_DIR', '/js/' );
//Templating
define ( 'TEMPLATE_DIR', ROOT . DS . 'template' . DS );
define ( 'ELEMENT_DIR', TEMPLATE_DIR . 'element' . DS );
//Classes
define ( 'LIB_DIR', ROOT . DS . 'lib' . DS );
define ( 'CONTROLLER_DIR', ROOT . DS . 'controller' . DS );
define ( 'MODEL_DIR', ROOT . DS . 'model' . DS );
define ( 'VIEW_DIR', ROOT . DS . 'view' . DS );
//Title
define ( 'APP_TITLE', 'Leg of Shadows' );
//Database
define ( 'DB_HOSTNAME', 'localhost' );
define ( 'DB_USERNAME', 'http' );
define ( 'DB_PASSWORD', 'werewolf' );
define ( 'DB_PORT', 3306 );
//Autoloader
spl_autoload_register();
