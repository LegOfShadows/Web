<?php
//////////////////////////////
//DEBUG MODE//////////////////
//////////////////////////////
define ('DEBUG_MODE', TRUE);//
$GLOBALS['debug'] = '';		//
//////////////////////////////

define ( 'ROOT', dirname ( __FILE__ ) );
define ( 'DS', DIRECTORY_SEPARATOR );

define ( 'CSS_DIR', '/css/' );
define ( 'CSS_DEFAULT', CSS_DIR . 'style.css' );
define ( 'JS_DIR', '/js/' );

define ( 'TEMPLATE_DIR', ROOT . DS . 'template' . DS );
define ( 'ELEMENT_DIR', TEMPLATE_DIR . 'element' . DS );

define ( 'CLASS_DIR', ROOT . DS . 'class' . DS );
define ( 'CONTROLLER_DIR', ROOT . DS . 'controller' . DS );
define ( 'MODEL_DIR', ROOT . DS . 'model' . DS );
define ( 'VIEW_DIR', ROOT . DS . 'view' . DS );

define ( 'APP_TITLE', 'Leg of Shadows' );

define ( 'DB_HOSTNAME', 'localhost' );
define ( 'DB_USERNAME', 'http' );
define ( 'DB_PASSWORD', 'werewolf' );
define ( 'DB_PORT', 3306 );