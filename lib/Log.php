<?php
class Log extends Core {
	/**
	 * Logs variables into debug output;
	 * @param string $name: Variable name;
	 * @param string $value: Variable value;
	 * @param [optional] number $indent: Sets the indent amount for clear display;
	 */
	public static function Add($name, $value, $indent = 20) {
		$GLOBALS ['debug'] .= "<div style=\"margin-left:$indent\px\"><span>" . $name . '</span> => ';
		switch (gettype ( $value )) {
			case 'string' :
			case 'boolean' :
			case 'integer' :
				$GLOBALS ['debug'] .= $value;
				break;
			case 'array' :
			case 'object' :			
				foreach ( $value as $key => $val ) {
					Log::Add ( $key, $val, $indent + 20 );
				}
		}
		$GLOBALS ['debug'] .= '</div>';
	}
}