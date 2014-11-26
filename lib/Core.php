<?php
/**
 * Base Class for the Framework
 * 
 * @author Ivan
 */
class Core {
	/**
	 * File version
	 *
	 * @var string
	 */
	public $version = 'alpha 1.0';
	
	public function __construct() {
	}
	
	/**
	 * Returns the name of the class
	 * @return string
	 */
	public function Name() {
		return get_class($this);
	}
	
	public function Handle() {
		$self = &$this;
		return $self;
	}
	
	/**
	 * Sets a flash message that will be displayed in the next view
	 * @param string $title
	 * @param string $msg
	 */
	public static function SetFlash($title, $msg) {
		$_SESSION['flash'][$title] = $msg;
	}
	/**
	 * Returns and purges the flash data
	 * @return array
	 */
	public static function GetFlash() {
		$flash = $_SESSION['flash'];
		unset ($_SESSION['flash']);
		return $flash;
	}
	/**
	 * Checks if there is any flash data
	 * @return boolean
	 */
	public static function HasFlash() {			
		return isset($_SESSION['flash']);
	}
}