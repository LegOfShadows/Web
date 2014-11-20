<?php 
class User extends Model {
	public $name = 'User';
	public $table_name = 'users';
	public $properties = array(
			'id',
			'username',
			'password',
			'firstname',
			'lastname',
			'email',
			'created',
			'modified',
			'lastlogon'
	);
	
	public function SelectByID($id) {
		
	}
	public function Register($username, $password, $firstname, $lastname, $email) {
		
	}
	public function Validate() {
		
	}
	public function TestInsert() {
		$this->Insert();
	}
}