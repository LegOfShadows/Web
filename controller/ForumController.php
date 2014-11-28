<?php
class ForumController extends Controller {
	public function __construct() {
		$this->models = array (
				'Thread',
				'Post' 
		);
		$this->auth = array (
				'edit' => 'deny' 
		);
		parent::__construct ();
	}
	public function index() {
	}
}