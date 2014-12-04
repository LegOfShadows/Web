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
		if (isset ( $_SESSION ['User']->id )) {
			$this->view->title = 'Profile';
			$this->view->AddData ( array (
					'User' => $_SESSION ['User'] 
			) );
		} else {
			$this->Redirect ( 'user/login' );
		}
	}
	public function edit($id = false) {
		if ($id != false) {
			$id == $_SESSION ['User']->id;
		}
		$this->User->Load ( $id );
		$Admin = $_SESSION ['User'];
		if (Auth::Check ( 3 ) || $Admin->id == $id) {
			$this->view->title = 'Edit Profile';
			$this->view->AddData ( array (
					'User' => $this->User 
			) );
		} else {
			$this->SetFlash ( 'Access Denied', 'You don\'t have permission to edit User accounts' );
			$this->Redirect ( 'user/index' );
		}
		if ($this->IsPost ()) {
			Log::Add ( 'Post', $_POST );
			if ($_POST ['action'] == 'admin') {
				// Check if user credentials allow for action
				$newlevel = $_POST ['accesslevel'];
				if ($newlevel < $Admin->accesslevel && $Admin->accesslevel > $this->User->accesslevel) {
					// Check if password reset was checked
					if (isset ( $_POST ['password_reset'] )) {
						$this->User->ChangePassword ( '' );
						$this->SetFlash ( 'Password Reset', 'Username ' . $this->User->properties ['username'] );
					}
					// Check if the level was changed
					if ($newlevel != $this->User->accesslevel) {
						$this->User->ChangeAccessLevel ( $newlevel );
						$this->SetFlash ( 'Access Level', MSG_USER_ACCESS_CHANGED );
					}
				} else {
					$this->SetFlash ( 'Access Level', MSG_USER_ACCESS_LOW );
				}
			} elseif ($_POST ['action'] == 'password') {
				$pass = Auth::Encrypt ( $_POST ['password'] );
				$pass1 = $_POST ['password1'];
				$pass2 = $_POST ['password2'];
				// Check if password validates
				if ($pass == $this->User->password) {
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
			$this->view->AddData ( array (
					'Users' => $this->User->All () 
			) );
			$this->view->title = 'User List';
		} else {
			$this->Redirect ( 'user/index' );
		}
	}
	public function register() {
		if ($this->IsPost ()) {
			if ($this->User->Validate ( $_POST ) === true) {
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
			$check = array (
					'username' => $_POST ['username'],
					'password' => $_POST ['password'] 
			);
			$id = $this->User->Exists ( $check );
			if ($id != false) {
				$this->User->Login ( $id );
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
		session_destroy ();
		session_start ();
		$this->SetFlash ( 'Logout', MSG_LOGOUT_SUCCESS );
		$this->Redirect ( 'home' );
	}
}