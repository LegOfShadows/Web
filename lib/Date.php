<?php
abstract class Date extends Core {
	
	public static function StrToDate($string) {
		$date = date_parse($string);
		return $date['day'].'/'.$date['month'].'/'.$date['year'];
	}
}