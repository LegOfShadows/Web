<?php
/**
 * User Controller
 * @author Ivan
 *
 */
class UserController extends Controller {
	public function index() {
		if (isset ( $session->user )) {
		} else {
			header ( 'Location: /user/login' );
		}
	}
	public function edit() {
	}
	public function register() {
	}
	public function login() {
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
		} else {
			$this->name = 'Login';
			$this->view = 'User\login';
			$this->ShowView ();
		}
	}
	public function logout() {
	}
}