<?php
/**
 * Controller base class
 * @author Ivan
 *
 */ 
class Controller extends Core {
	public $models;
	public $view;
	public $auth = array();
	
	public function __construct() {
		$this->LoadModels();
		$this->view = new View();
	}
	
	public function LoadModels() {
		if (isset($this->models)) {
			foreach ($this->models as $model) {
				$this->$model = new $model;
			}
		}
	}
	/**
	 * Checks if server request is POST
	 * @return boolean
	 */
	public function IsPost() {
		return ($_SERVER['REQUEST_METHOD'] === 'POST');
	}
}
?>
