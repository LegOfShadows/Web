<?php
abstract class Str extends Core {
	/**
	 * Capitalizes a string
	 *
	 * @param string $string        	
	 * @return string
	 */
	public static function Capitalize($string) {
		$cap = strtoupper ( substr ( $string, 0, 1 ) );
		$rest = strtolower ( substr ( $string, 1, strlen ( $string ) ) );
		return $cap . $rest;
	}
	/**
	 * Converts a string to CamelCase using undescores as separator
	 *
	 * @param string $string        	
	 * @return string
	 */
	public static function Camelize($string) {
		$split = explode ( '_', $string );
		$out = '';
		foreach ( $split as $str ) {
			$out .= Str::Capitalize ( $str );
		}
		return $out;
	}
	/**
	 * Converts a CamelCase string to underscore separated string
	 *
	 * @param unknown $string        	
	 * @return string
	 */
	public static function Undescore($string) {
		return strtolower ( preg_replace ( '/([a-z])([A-Z])/', '$1_$2', $string ) );
	}
	/**
	 * Returns controller name using the base string
	 *
	 * @param string $string        	
	 * @return string
	 */
	public static function Controller($string) {
		return Str::Camelize ( $string ) . 'Controller';
	}
	public static function ModelProperty($string) {
		$model = explode ( '_', $string );
		return $model[1];
	}
	public static function TableCollumn($model, $property) {
		return strtolower ( $model . '_' . $property );
	}
	public static function Timestamp($time) {
		return date ( 'Y-m-d H:i:s', $time );
	}
}