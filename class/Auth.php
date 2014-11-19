<?php
<?php
/**
 * Includes all functions needed to authorize users
 * @author Ivan
 *
 */
class Auth {
	public static function Encrypt($string) {
		return sha1($string);
	}
	public static function ValidateUsername($string) {
		$db->query('SELECT 1');
		return $db->GetData();
	}
}