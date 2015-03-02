<?php
abstract class String extends Core {
	/**
	 * Capitalizes a string
	 *
	 * @param string $string        	
	 * @return string
	 */
	public static function Capitalize($string) {
		$cap = strtoupper ( substr ( $string, 0, 1 ) );
		$rest = String::Lower ( substr ( $string, 1, strlen ( $string ) ) );
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
			$out .= String::Capitalize ( $str );
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
		return String::Camelize ( $string ) . 'Controller';
	}
	public static function View($controller, $action) {
		return String::Camelize ( $controller ) . DS . $action;
	}
	public static function TableCollumn($model, $property) {
		return strtolower ( $model . '_' . $property );
	}
	public static function Timestamp($time) {
		return date ( 'Y-m-d H:i:s', $time );
	}
	public static function Lower($string) {
		return strtolower ( $string );
	}
	public static function Table($string) {
		return String::Lower ( $string ) . 's';
	}
	public static function TrimLast($string) {
		return substr ( $string, 0, strlen ( $string ) - 1 );
	}
	
}