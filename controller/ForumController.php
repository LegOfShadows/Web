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
	public function index($id = false) {
		if ($id == false) {
			$cat = array('categories'=>$this->Thread->GetCategories());
			$this->view->AddData($cat);
		} else {
			$threads = array('threads'=>$this->Thread->GetThreadsByCategory($id));
			$this->view->AddData($threads);
		}
	}
}