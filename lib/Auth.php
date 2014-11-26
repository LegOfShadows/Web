<?php
/**
 * Includes all functions needed to authorize users
 * @author Ivan
 *
 */
class Auth extends Core {
	public $Levels = array('banned','basic','author','moderator','administrator');
	public static function Encrypt($string) {
		return sha1($string);
	}
}