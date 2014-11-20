<?php
class Router {
	private $controller = 'home';
	private $action = 'index';
	private $param1 = false;
	private $param2 = false;
	/**
	 * Allowed Actions for Controllers
	 *
	 * @var array of strings
	 */
	private $actions = array (
			'index',
			'show',
			'create',
			'delete',
			'edit',
			'test',
			'login',
			'logout',
			'register' 
	);
	/**
	 * Construct of Router class;
	 * Parses the url and assigns variables which are used to control the web routing
	 *
	 * @param string $url        	
	 */
	public function __construct($url) {
		$command = explode ( '/', $url );
		$command = array_filter ( $command, "Router::RemoveEmpty" );
		
		if (isset ( $command [1] )) {
			$this->controller = $command [1];
		}
		if (isset ( $command [2] ) && in_array ( $command [2], $this->actions )) {
			$this->action = $command [2];
		}
		if (isset ( $command [3] )) {
			$this->param1 = $command [3];
		}
		if (isset ( $command [4] )) {
			$this->param2 = $command [4];
		}
	}
	/**
	 * Loads required Controller class file
	 * and runs the specified action
	 *
	 * Default Controller is Home
	 * Default Action is always Index
	 */
	public function Route() {
		$class = $this->GetControllerClassName ();
		$action = $this->action;
		// Initialize the routed Controller
		$controller = new $class ();
		// Call controller Action
		$controller->$action ( $this->param1, $this->param2 );
	}
	/**
	 * Gives the CamelCase Class name of the Controller parsed at construct
	 *
	 * @return string
	 */
	private function GetControllerClassName() {
		$name = Core::Camelize ( $this->controller ) . 'Controller';
		return $name;
	}
	/**
	 * Removes all empty string items from array;
	 *
	 * @param String $string:
	 *        	item to test
	 * @return s Boolean: false if empty string, true otherwise
	 */
	public static function RemoveEmpty($string) {
		if ($string == '') {
			return false;
		} else {
			return true;
		}
	}
}
?>