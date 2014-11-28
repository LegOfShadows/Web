<?php
/**
 * User Controller
 * @author Ivan
 *
 */
class UserController extends Controller {
	public function __construct() {
		$this->models = array (
				'User' 
		);
		$this->auth = array (
				'all' => 'deny',
				'index' => 'allow,',
				'login' => 'allow',
				'register' => 'allow' 
		);
		parent::__construct ();
	}
	public function index() {
		if (isset ( $_SESSION ['User'] ['id'] )) {
			$this->view->title = 'Profile';
			$this->view->AddData ( array (
					'UserInfo' => $_SESSION ['User'] 
			) );
		} else {
			$this->Redirect ( 'user/login' );
		}
	}
	public function edit($id = false) {
		if ($id != false) {
			$id == $_SESSION ['User'] ['id'];
		}
		$this->User->Load ( $id );
		if (Auth::Check ( 3 ) || $_SESSION ['User'] ['id'] == $id) {
			$this->view->title = 'Edit Profile';
			$this->view->AddData ( array (
					'UserInfo' => $this->User->properties 
			) );
		} else {
			$this->SetFlash ( 'Access Denied', 'You don\'t have permission to edit User accounts' );
			$this->Redirect ( 'user/index' );
		}
		if ($this->IsPost ()) {
			Log::Add ( 'Post', $_POST );
			if ($_POST ['action'] == 'admin') {
				$id = $_POST ['id'];
				$newlevel = $_POST ['accesslevel'];
				if (isset ( $_POST ['password_reset'] )) {
					$this->User->ChangePassword ( '' );
					$this->SetFlash ( 'Password Reset', 'Username ' . $this->User->properties ['username'] );
				}
				if ($newlevel != $this->User->properties ['accesslevel']) {
					if ($newlevel > $_SESSION ['User'] ['accesslevel']) {
						$this->SetFlash ( 'Access Level', MSG_USER_ACCESS_LOW );
					} else {
						$this->User->ChangeAccessLevel ( $newlevel );
						$this->SetFlash ( 'Access Level', MSG_USER_ACCESS_CHANGED );
					}
				}
			} else {
				$id = $_POST ['id'];
				$pass = sha1 ( $_POST ['password'] );
				$pass1 = $_POST ['password1'];
				$pass2 = $_POST ['password2'];
				if ($pass == $this->User->properties ['password']) {
					if ($pass1 == $pass2) {
						$this->User->ChangePassword ( $pass1 );
						$this->SetFlash ( 'Password', MSG_USER_PASSWORD_CHANGED );
					} else {
						$this->SetFlash ( 'Password', MSG_REGISTER_PASS_MISSMATCH );
					}
				} else {
					$this->SetFlash ( 'Password', MSG_LOGIN_WRONG_PASSWORD );
				}
			}
		}
	}
	public function all() {
		if (Auth::Check ( 3 )) {
			$this->User->GetAll ();
			$this->view->AddData ( array (
					'Users' => $this->User->all 
			) );
			$this->view->title = 'User List';
		} else {
			$this->Redirect ( 'user/index' );
		}
	}
	public function register() {
		if ($this->IsPost ()) {
			if ($this->User->Validate ( 'registration', $_POST ) === true) {
				$this->User->Register ( $_POST );
				$this->Redirect ( 'user/login' );
			} else {
				$this->Redirect ( 'user/register' );
			}
		} else {
			$this->view->title = 'Register';
		}
	}
	public function login() {
		if ($this->IsPost ()) {
			$username = $_POST ['username'];
			$password = $_POST ['password'];
			if ($this->User->Validate ( 'password', $password ) === true && $this->User->Validate ( 'username', $username ) === true) {
				$this->User->Login ();
				$this->Redirect ( 'user/index' );
			} else {
				$this->Redirect ( 'user/login' );
			}
		} else {
			$this->view->title = 'Login';
		}
	}
	public function logout() {
		unset ( $_SESSION ['User'] );
		$this->SetFlash ( 'Logout', MSG_LOGOUT_SUCCESS );
		$this->Redirect ( 'home' );
	}
}