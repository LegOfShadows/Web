<?php
class User extends Model {
	public function Login() {
		$id = $this->db->Result();
		$id = $id[0][0];
		$this->Load ( $id );
		$_SESSION['User'] = $this->properties;
		$this->SetFlash('Login', MSG_LOGIN_SUCCESS);
		$this->UpdateLastLogin();
	}
	public function Register($data) {
		$first = $data['firstname'];
		$last = $data['lastname'];
		$user = $data['username'];
		$pass = sha1($data['password1']);
		$email = $data['email'];
		
		$query = 'INSERT INTO users (user_username, user_password, user_firstname, user_lastname, user_email)';
		$query .= ' VALUES (\'%s\',\'%s\',\'%s\',\'%s\',\'%s\')';
		$query = sprintf($query,$user,$pass,$first,$last,$email);
		if ($this->db->Query($query)) {
			$this->SetFlash('Success','Registration complete');
		} else {
			$this->SetFlash('Failure','There was an error during the process, please try again');
		}
	}
	public function Validate($property, $value) {
		switch ($property) {
			case 'username' :
				$query = 'SELECT user_id FROM users WHERE user_username = \'%s\'';
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
				$query = 'SELECT user_id FROM users WHERE user_password = \'%s\'';
				$query = sprintf ( $query, Auth::Encrypt ( $value ) );
				$result = $this->db->Query ( $query );
				if ($result->num_rows > 0) {
					return true;
				} else {
					$this->SetFlash ( 'Invalid Password', MSG_LOGIN_WRONG_PASSWORD );
					return false;
				}
				break;
			case 'registration':
				$verdict = true;
				$missing = '';
				foreach ($value as $k => $v) {
					if (!isset($v) || $v === '') {
						$missing .= $k.'; ';
						$verdict = false;
					}
				}
				if ($verdict === false) {
					$this->SetFlash('Missing',$missing);
				}
				if ($value['password1'] !== $value['password2']){
					$this->SetFlash('Password','Passwords don\'t match');
					$verdict = false;
				}
				$query = 'SELECT user_id FROM users WHERE user_username = \'%s\' OR user_email = \'%s\'';
				$query = sprintf($query,$value['username'],$value['email']);
				$result = $this->db->Query ($query);
				if ($result->num_rows > 0) {
					$this->SetFlash('Not Unique','Username or email already in use');
					$verdict = false;
				}
				return $verdict;
				break;
		}
	}
	private function UpdateLastLogin() {
		$query = 'UPDATE users SET user_lastlogon = \'%s\' WHERE user_id = %d';
		$query = sprintf($query,String::Timestamp(time()), $this->properties['id']);
		$this->db->Query($query);
	}
	public function TestInsert() {
		$this->Insert ();
	}
}