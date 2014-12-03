<?php
class User extends Model {
	public function Login($id) {
		$this->Load ( $id );
		if ($this->properties ['accesslevel'] != 0) {
			$_SESSION ['User'] = $this;
			$this->UpdateLastLogin ();
			$this->SetFlash ( 'Login', MSG_LOGIN_SUCCESS );
		} else {
			$this->SetFlash ( 'Login', MSG_LOGIN_BANNED );
		}
	}
	public function Register($data) {
		$this->firstname = $data ['firstname'];
		$this->lastname = $data ['lastname'];
		$this->username = $data ['username'];
		$this->password = Auth::Encrypt( $data ['password1'] );
		$this->email = $data ['email'];
		$this->lastlogon = 0;
		
		if ($this->Create()) {
			$this->SetFlash ( 'Success', MSG_REGISTER_SUCCESS );
		} else {
			$this->SetFlash ( 'Failure', MSG_REGISTER_FAILURE );
		}
	}
	
	private function UpdateLastLogin() {
		$this->lastlogon = String::Timestamp ( time () );
		$this->Save();
	}
	public function ChangePassword($pass) {		
		$pass = sha1 ( $pass );
		$this->password = $pass;
		$this->Save();
	}
	public function ChangeAccessLevel($lvl) {
		$this->accesslevel = $lvl;
		$this->Save();
	}
}