<?php
class Router extends Core {
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
			'all',
			'create',
			'delete',
			'edit',
			'test',
			'login',
			'logout',
			'register',
			'thread',
			'post',
	);
	/**
	 * Construct of Router class;
	 * Parses the url and assigns variables which are used to control the web routing
	 *
	 * @param string $url        	
	 */
	public function __construct() {
		$url = $_SERVER ['REQUEST_URI'];
		if (stripos($url, '?')> 0) {
			$url = substr($url,0,stripos($url, '?'));
		}
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
		if (isset ($_GET) && count($_GET) > 0) {
			$_POST['get'] = $_GET;
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
		$class = String::Controller ( $this->controller );
		$action = $this->action;
		// Initialize the routed Controller
		$controller = new $class ();
		// Check if Authorization is required;
		Auth::RequiresLogin($this->action, $controller->auth);
		// Set default values for controller
		$controller->view->SetPath (String::View ( $this->controller, $this->action ));
		$controller->view->title = String::Capitalize ( $this->controller );
		// Call controller Action
		$controller->$action ( $this->param1, $this->param2 );
		$controller->view->Render();
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