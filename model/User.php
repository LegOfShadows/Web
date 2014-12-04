<?php
class User extends Model {
	public function Login($id) {
		$this->Load ( $id );
		if ($this->accesslevel > 0) {
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
		$this->password = Auth::Encrypt ( $data ['password1'] );
		$this->email = $data ['email'];
		$this->lastlogon = 0;
		
		if ($this->Create ()) {
			$this->SetFlash ( 'Success', MSG_REGISTER_SUCCESS );
		} else {
			$this->SetFlash ( 'Failure', MSG_REGISTER_FAILURE );
		}
	}
	public function Validate($data) {
		$verdict = true;
		$unique = array(
				'username' => $data['username'],
				'email' => $data['email']
		);
		if ($this->Exists($unique <> false)) {
			$this->SetFlash('Username In Use', MSG_REGISTER_NOT_UNIQUE);
			$verdict = false;
		}
		if ($data['password1'] <> $data['password2']) {
			$this->SetFlash('Passwords Missmatch', MSG_REGISTER_PASS_MISSMATCH);
			$verdict = false;
		}
		foreach ($data as $item) {
			if ($item == '' || !isset($item)){
				$this->SetFlash('Missing Info', 'Please fill in all the fields');
				$verdict = false;
			}
		}
		return $verdict;
	}
	public function Exists($check) {
		if (isset ( $check ['password'] )) {
			$check ['password'] = Auth::Encrypt ( $check ['password'] );
		}
		return parent::Exists ( $check );
	}
	private function UpdateLastLogin() {
		$this->lastlogon = String::Timestamp ( time () );
		$this->Save ();
	}
	public function ChangePassword($pass) {
		$pass = Auth::Encrypt ( $pass );
		$this->password = $pass;
		$this->Save ();
	}
	public function ChangeAccessLevel($lvl) {
		$this->accesslevel = $lvl;
		$this->Save ();
	}
}