<?php
/**
 * User Controller
 * @author Ivan
 *
 */
class UserController extends Controller {
	public function __construct() {
		$this->models [] = 'User';
		parent::__construct ();
	}
	public function index() {
		if (isset ( $_SESSION ['user'] ['id'] )) {
		} else {
			header ( 'Location: /user/login' );
		}
	}
	public function edit() {
	}
	public function register() {
		$this->SetFlash ( 'Success', 'Was @register' );
	}
	public function login() {
		if ($this->IsPost ()) {
			$username = $_POST ['username'];
			$password = $_POST ['password'];
			if ($this->User->Validate ( 'username', $username ) && $this->User->Validate ( 'password', $password )) {
				$this->User->Login ();
			}
		} else {
			$this->name = 'Login';
			$this->view = 'User\login';
			Log::Add ( 'UserController', $this );
			$this->ShowView ();
		}
	}
	public function logout() {
		unset ( $_SESSION ['User'] );
		$this->SetFlash ( 'Logout', 'Successfully logged out' );
		header ( 'Location: /user/login' );
	}
}