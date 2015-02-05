<?php
class HomeController extends Controller {
	public function index() {
		$post = new Post ();
		$data = $post->GetFrontPage ();
		$this->view->AddData ( array (
				'posts' => $data 
		) );
	}
	public function test() {
		include (ROOT . '\ben.php');
	}
}