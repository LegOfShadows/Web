<?php
/**
 * Controller base class
 * @author Ivan
 *
 */ 
class Controller extends Core {
	public $models;
	
	public function __construct() {
		$this->LoadModels();
	}
	
	public function LoadModels() {
		if (isset($this->models)) {
			foreach ($this->models as $model) {
				$this->$model = new $model;
			}
		}
	}
	public function ShowView() {
		$html = new Html(Array('title'=>$this->name));
		$html->SetView($this->view);
		$html->Render();
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
