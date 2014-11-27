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
			$this->name='Index';
			$this->view = 'User\index';
			$userTable = array(array_keys($_SESSION['User']),array_values($_SESSION['User']));
			
			$this->data = array('UserInfo',$userTable);
			Log::Add('Data',$this->data);
			$this->ShowView();
		} else {
			$this->Redirect('user/login');
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
			if ($this->User->Validate ( 'username', $username ) === true && $this->User->Validate ( 'password', $password ) === true) {
				$this->User->Login ();
				$this->Redirect('user/index');
			} else {
				$this->Redirect('user/login');
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
		$this->Redirect('home');
	}
}