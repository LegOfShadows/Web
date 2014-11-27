<?php
/**
 * Includes all functions needed to authorize users
 * @author Ivan
 *
 */
class Auth extends Core {
	public static $Levels = array('banned','basic','author','moderator','administrator');
	public static function GetAccessLevel($level) {
		$array = Auth::$Levels;
		return String::Capitalize($array[$level]);
	}
	public static function Encrypt($string) {
		return sha1($string);
	}
}