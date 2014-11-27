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
		if (isset ( $_SESSION ['User'] ['id'] )) {
			$this->name='Profile';
			$this->view->AddData (array('UserInfo' => $_SESSION['User']));
		} else {
			$this->Redirect('user/login');
		}
	}
	public function edit() {
		if ($this->IsPost()) {
			echo 'Potato';
		} else {
			$this->name = 'Edit Profile';
		}
	}
	public function register() {
		if ($this->IsPost()) {
			if ($this->User->Validate('registration',$_POST) === true) {
				$this->User->Register($_POST);
				$this->Redirect('user/login');
			} else {
				$this->Redirect('user/register');
			}
		} else {
			$this->name = 'Register';
		}
	}
	public function login() {
		if ($this->IsPost ()) {
			$username = $_POST ['username'];
			$password = $_POST ['password'];
			if ($this->User->Validate ( 'password', $password ) === true && $this->User->Validate ( 'username', $username ) === true) {
				$this->User->Login ();
				$this->Redirect('user/index');
			} else {
				$this->Redirect('user/login');
			}
		} else {
			$this->name = 'Login';
		}
	}
	public function logout() {
		unset ( $_SESSION ['User'] );
		$this->SetFlash ( 'Logout', MSG_LOGOUT_SUCCESS );
		$this->Redirect('home');
	}
}