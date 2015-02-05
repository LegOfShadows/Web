<?php
/**
 * Class for creating a HTML Document
 * @author Ivan
 */
class Html extends Core {
	/**
	 * Generates a string containing all HTML link elements with the extra styles for the document
	 *
	 * @return string
	 */
	public static function Style($url) {
		echo '<link rel="stylesheet" type="text/css" href="' . $url . '">';
	}
	/**
	 * Generates a string containing all HTML script elements with the included scripts for the document
	 *
	 * @return string
	 */
	private static function Script() {
		echo '<script type="text/javascript" src="' . $url . '">';
	}
	/**
	 * TODO finish the notification module using sessions
	 *
	 * @return boolean
	 */
	public static function Flash() {
		if (Core::HasFlash ()) {
			$inner = '';
			foreach ( Core::GetFlash () as $k => $v ) {
				$inner .= Html::CreateElement ( 'span', $k, array (
						'class' => 'ctrlNotificationTitle' 
				) ) . ' : ';
				$inner .= Html::CreateElement ( 'span', $v, array (
						'class' => 'ctrlNotificationText' 
				) ) . '<br>';
			}
			$outer = Html::CreateElement ( 'div', $inner, array (
					'id' => 'wrpNotification' 
			) );
			echo $outer;
		}
	}
	/**
	 * Pulls a named element from template/element folder into the document
	 *
	 * @param string $name        	
	 */
	public static function GetElement($name) {
		include ELEMENT_DIR . $name . '.php';
	}
	public static function CreateElement($tag, $text, $options = array()) {
		$elem = '<' . $tag;
		foreach ( $options as $k => $v ) {
			$elem .= " $k=\"$v\"";
		}
		$elem .= '>' . $text . '</' . $tag . '>';
		return $elem;
	}
	public static function CreateLink($text, $url, $options = array()) {
		$options['href'] = $url;
		$link = Html::CreateElement('a',$text,$options);
		return $link;
	}
	public static function CreateTable($data, $header = false, $options ) {
		$table = '';
		foreach ( $data as $row ) {
			$trow = '';
			foreach ( $row as $cell ) {
				$tag = 'td';
				if ($header) {
					$tag = 'th';
				}
				$trow .= Html::CreateElement ( $tag, $cell );
			}
			$header = false;
			$table .= Html::CreateElement ( 'tr', $trow );
		}
		return Html::CreateElement ( 'table', $table, $options );
	}
}