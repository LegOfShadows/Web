<?php
/**
 * Controller base class
 * @author Ivan
 *
 */ 
class Controller {
	public $name;
	public $data;
	public $view;
	
	public function ShowView() {
		$html = new Html(Array('title'=>$this->name));
		$html->SetView($this->view);
		$html->Render();
	} 
}
?>
