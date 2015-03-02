<?php
class Mtg {
	public static function ParseMana(&$source) {
		$string = str_replace('{','',$source);
		$arr = explode("}",$string);
		$arr = array_filter ( $arr, "Router::RemoveEmpty" );
		$new = '';
		foreach ($arr as $sym) {
			$new .= "<img style='width:24px;height:24px' src='http://mtgimage.com/symbol/mana/$sym/128.png'>";
		}
		$source = $new;
	}
}
