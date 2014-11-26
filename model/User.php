<?php
class User extends Model {
	public function Login() {
		$id = $this->db->Result()[0][0];
		$this->Load ( $id );
		$_SESSION['User'] = $this->properties;
		$this->UpdateLastLogin();
	}
	public function Register($username, $password, $firstname, $lastname, $email) {
	}
	public function Validate($property, $value) {
		switch ($property) {
			case 'username' :
				$query = 'SELECT user_id FROM users WHERE user_username = \'%s\'';
				$query = sprintf ( $query, $value );
				if ($this->db->Query ( $query )) {
					return true;
				} else {
					$this->SetFlash ( 'Invalid Username', 'Please make sure you\'ve entered the correct username' );
					return false;
				}
				break;
			case 'password' :
				$query = 'SELECT user_id FROM users WHERE user_password = \'%s\'';
				$query = sprintf ( $query, Auth::Encrypt ( $value ) );
				if ($this->db->Query ( $query )) {
					return true;
				} else {
					$this->SetFlash ( 'Invalid Password', 'Please make sure you\'ve entered the correct password and check Caps Lock' );
					return false;
				}
				break;
		}
	}
	private function UpdateLastLogin() {
		$query = 'UPDATE users SET user_lastlogon = \'%s\' WHERE user_id = %d';
		$query = sprintf($query,Str::Timestamp(time()), $this->properties['id']);
		$this->db->Query($query);
	}
	public function TestInsert() {
		$this->Insert ();
	}
}