<?php
class User extends Model {
	public function Login() {
		$id = $this->db->Result ();
		$id = $id [0] [0];
		$this->Load ( $id );
		if ($this->properties ['accesslevel'] != 0) {
			$_SESSION ['User'] = $this->properties;
			$this->SetFlash ( 'Login', MSG_LOGIN_SUCCESS );
			$this->UpdateLastLogin ();
		} else {
			$this->SetFlash ( 'Login', MSG_LOGIN_BANNED );
		}
	}
	public function Register($data) {
		$first = $data ['firstname'];
		$last = $data ['lastname'];
		$user = $data ['username'];
		$pass = sha1 ( $data ['password1'] );
		$email = $data ['email'];
		
		$query = 'INSERT INTO users (username, password, firstname, lastname, email)';
		$query .= ' VALUES (\'%s\',\'%s\',\'%s\',\'%s\',\'%s\')';
		$query = sprintf ( $query, $user, $pass, $first, $last, $email );
		if ($this->db->Query ( $query )) {
			$this->SetFlash ( 'Success', MSG_REGISTER_SUCCESS );
		} else {
			$this->SetFlash ( 'Failure', MSG_REGISTER_FAILURE );
		}
	}
	public function Validate($property, $value) {
		switch ($property) {
			case 'username' :
				$query = 'SELECT id FROM users WHERE username = \'%s\'';
				$query = sprintf ( $query, $value );
				$result = $this->db->Query ( $query );
				if ($result->num_rows > 0) {
					return true;
				} else {
					$this->SetFlash ( 'Invalid Username', MSG_LOGIN_WRONG_USERNAME );
					return false;
				}
				break;
			case 'password' :
				$query = 'SELECT id FROM users WHERE password = \'%s\'';
				$query = sprintf ( $query, Auth::Encrypt ( $value ) );
				$result = $this->db->Query ( $query );
				if ($result->num_rows > 0) {
					return true;
				} else {
					$this->SetFlash ( 'Invalid Password', MSG_LOGIN_WRONG_PASSWORD );
					return false;
				}
				break;
			case 'registration' :
				$verdict = true;
				$missing = '';
				foreach ( $value as $k => $v ) {
					if (! isset ( $v ) || $v === '') {
						$missing .= $k . '; ';
						$verdict = false;
					}
				}
				if ($verdict === false) {
					$this->SetFlash ( 'Missing', $missing );
				}
				if ($value ['password1'] !== $value ['password2']) {
					$this->SetFlash ( 'Password', MSG_REGISTER_PASS_MISSMATCH );
					$verdict = false;
				}
				$query = 'SELECT id FROM users WHERE username = \'%s\' OR email = \'%s\'';
				$query = sprintf ( $query, $value ['username'], $value ['email'] );
				$result = $this->db->Query ( $query );
				if ($result->num_rows > 0) {
					$this->SetFlash ( 'Not Unique', MSG_REGISTER_NOT_UNIQUE );
					$verdict = false;
				}
				return $verdict;
				break;
		}
	}
	private function UpdateLastLogin() {
		$query = 'UPDATE users SET lastlogon = \'%s\' WHERE id = %d';
		$query = sprintf ( $query, String::Timestamp ( time () ), $this->properties ['id'] );
		$this->db->Query ( $query );
	}
	public function GetAll() {
		$query = 'SELECT * FROM users';
		$this->db->Query ( $query );
		$this->all = $this->db->Result ( true );
	}
	public function ChangePassword($pass) {
		$id = $this->properties ['id'];
		$pass = sha1 ( $pass );
		$query = 'UPDATE users SET password = \'%s\' WHERE id = %d';
		$query = sprintf ( $query, $pass, $id );
		$this->db->Query ( $query );
	}
	public function ChangeAccessLevel($lvl) {
		$id = $this->properties ['id'];
		$query = 'UPDATE users SET accesslevel = %d WHERE id = %d';
		$query = sprintf ( $query, $lvl, $id );
		$this->db->Query ( $query );
	}
}