<?php
/**
 * Includes all functions needed to authorize users
 * @author Ivan
 *
 */
class Auth extends Core {
	public static $Levels = array('banned','basic','author','moderator','administrator');
	public static function Check($level) {
		return ($_SESSION['User']['accesslevel'] >= $level ? true : false);
	}
	public static function GetAccessLevel($level) {
		$array = Auth::$Levels;
		return String::Capitalize($array[$level]);
	}
	public static function Encrypt($string) {
		return sha1($string);
	}
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