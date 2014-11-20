<?php
// Load all modules
require_once (CLASS_DIR . 'Auth.php');
require_once (CLASS_DIR . 'Controller.php');
require_once (CLASS_DIR . 'Database.php');
require_once (CLASS_DIR . 'Html.php');
require_once (CLASS_DIR . 'Model.php');
require_once (CLASS_DIR . 'Router.php');
require_once (CLASS_DIR . 'Session.php');
require_once (CLASS_DIR . 'View.php');
/**
 * Core file for the Framework
 * Contains all the module loading and global functions
 * @author Ivan
 */
class Core {
	/**
	 * File version
	 * @var string
	 */
	public $version = 'alpha 1.0';
	/**
	 * Capitalizes a given string
	 * @param string $string
	 * @return string
	 */
	public static function Capitalize($string) {
		$cap = strtoupper ( substr ( $string, 0, 1 ) );
		$rest = strtolower ( substr ( $string, 1, strlen ( $string ) ) );
		return $cap . $rest;
	}
	/**
	 * Camelizes a string that is separated with undescores
	 * or just capitalizes the string
	 * @param string $string
	 * @return string
	 */
	public static function Camelize($string) {
		$split = explode('_',$string);
		$out = '';
		foreach ($split as $str) {
			$out .= Core::Capitalize($str);
		}
		return $out;
	}
}

