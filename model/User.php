<?php 
class User extends Model {
	public $id;
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	public $email;
	public $created;
	public $modified;
	public $lastlogon;
	
	public function SelectByID($id) {
			
	}
	public function Register($username, $password, $firstname, $lastname, $email) {
		
	}
}