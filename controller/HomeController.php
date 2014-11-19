<?php
class HomeController extends Controller {
	public function index() {
		$this->name = 'Home';
		$this->view = 'Home\index';
		$this->ShowView();
	}
	public function test() {
		$this->name = 'Home';
		$this->view = 'Home\test';
		$this->ShowView();
	}
}