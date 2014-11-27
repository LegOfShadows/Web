<?php
class View extends Core {
	private $data = array();
	private $path;
	
	private $doc;
	
	public function __construct($options = array()) {
	}

	public function SetPath($path) {
		$this->path = VIEW_DIR.$path.'.php';
	}
	/**
	 * Used to pass data down to the view from the controller
	 * @param unknown $array
	 */
	public function AddData($array) {
		$this->data = array_merge($array, $this->data);
		Log::Add('View Data',$this->data);
	}
	/**
	 * Assigns data array to individual variables for easier access;
	 */
	private function PrepareData() {
		foreach ($this->data as $k => $v) {
			$this->$k = $v;
		}
	}

	public function Render() {
		if ($this->ViewExists()) {
			$this->PrepareData();
			include TEMPLATE_DIR . 'default.php';
		}
	}

	private function ViewExists() {
		return file_exists($this->path);
	}
	
}