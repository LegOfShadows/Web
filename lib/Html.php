<?php
/**
 * Class for creating a HTML Document
 * @author Ivan
 */
class Html extends Core {
	private $template;
	private $styles = Array (
			CSS_DEFAULT 
	);
	private $scripts = Array ();
	private $view;
	private $data;
	private $title;
	/**
	 * Creates an HTML document
	 * 
	 * @param
	 *        	Template - String
	 * @param
	 *        	Options - Array
	 */
	public function __construct($options = Array()) {
		if (isset ( $options ['title'] )) {
			$this->title = $options ['title'];
		}
		if (isset ( $options ['styles'] )) {
			foreach ( $options ['styles'] as $style ) {
				$this->styles [] = $style;
			}
		}
		$this->template = TEMPLATE_DIR . 'default.php';
	}
	/**
	 * Renders an html document using the set template
	 */
	public function Render() {
		include $this->template;
	}
	/**
	 * Generates a string containing all HTML link elements with the extra styles for the document
	 * 
	 * @return string
	 */
	private function GetStyles() {
		$out = '';
		foreach ( $this->styles as $url ) {
			$out .= '<link rel="stylesheet" type="text/css" href="' . $url . '">';
		}
		return $out;
	}
	/**
	 * Generates a string containing all HTML script elements with the included scripts for the document
	 * 
	 * @return string
	 */
	private function GetScripts() {
		$out = '';
		foreach ( $this->scripts as $url ) {
			$out .= '<script type="text/javascript" src="' . $url . '">';
		}
		return $out;
	}
	/**
	 * TODO finish the notification module using sessions
	 * 
	 * @return boolean
	 */
	private function Flash() {
		if ($this->HasFlash()) {
			$inner = '';
			foreach ( $this->GetFlash() as $k => $v ) {
				$inner .= $this->CreateElement('span',$k,false,'ctrlNotificationTitle').' : ';
				$inner .= $this->CreateElement('span',$v,false,'ctrlNotificationText').'<br>';
			}
			$outer = $this->CreateElement('div',$inner,'wrpNotification');
			echo $outer;
		}
	}
	/**
	 * Pulls a named element from template/element folder into the document
	 * 
	 * @param string $name        	
	 */
	public static function GetElement($name) {
		include ELEMENT_DIR . $name . '.php';
	}
	/**
	 * Pulls the view content from the file given by controller
	 */
	private function GetView() {
		if (isset ( $this->view )) {
			include $this->view;
		}
	}
	/**
	 * Sets the file path for the content element
	 * 
	 * @param string $name        	
	 */
	public function SetView($name) {
		$this->view = VIEW_DIR . $name . '.php';
	}
	public function CreateElement($tag,$text,$id=false,$class=false) {
		$elem = '<'.$tag; 
		if ($id <> false) {
			$elem .= ' id="'.$id.'"';
		}
		if ($class <> false) {
			$elem .= ' class="'.$class.'"';
		}
		$elem .= '>'.$text.'</'.$tag.'>';
		return $elem;
	}
}