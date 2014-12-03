<?php
/**
 * Includes all functions needed to authorize users
 * @author Ivan
 *
 */
class Auth extends Core {
	public static $Levels = array('banned','basic','author','moderator','administrator');
	/**
	 * Checks if current user's level is at least equal to $level
	 * @param unknown $level
	 * @return boolean
	 */
	public static function Check($level) {
		return ($_SESSION['User']['accesslevel'] >= $level ? true : false);
	}
	/**
	 * Returns string equivalent of user's Access Level
	 * @param integer $level
	 * @return string
	 */
	public static function AccessLevel($level) {
		$array = Auth::$Levels;
		return String::Capitalize($array[$level]);
	}
	/**
	 * Returns the encrypted SHA1 string (CHAR(40))
	 * @param input $string
	 * @return string HASH
	 */
	public static function Encrypt($string) {
		return sha1($string);
	}
	/**
	 * Checks if a page requires login to use
	 * Redirects the user to the login page if check fails
	 * @param Controller Action $action
	 * @param Access Settings $array :: 'action' => 'allow'||'deny';
	 */
	public static function RequiresLogin($action, $array) {
		$access = AUTH_DEFAULT;
		if (isset($array['all'])) {
			$access = $array['all'];
		}
		if (key_exists($action,$array)) {
			$access = $array[$action];	
		}
		if ($access == 'deny' && !isset($_SESSION['User']['id'])) {
			Core::SetFlash('Login required',MSG_LOGIN_REQUIRED);
			Core::Redirect('user/login');
		}
	}
}