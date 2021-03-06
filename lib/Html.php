<?php
/**
 * Class for creating a HTML Document
 * @author Ivan
 */
class Html extends Core {
    /**
     * @param string $url
     * @param bool $media add specific media settings for stylesheet
     *
     * @out echoes <link> tag for CSS
     */
    public static function Style($url,$media = false) {
        $link = '<link rel="stylesheet" type="text/css" href="';
        $link .= $url;
        if ($media) {
            $link .= '" media="'.$media;
        }
        $link .= '">';
		echo $link;
	}
	/**
	 * Generates a string containing all HTML script elements with the included scripts for the document
	 *
	 * @return string
	 */
	private static function Script($url) {
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
				$inner .= Html::CreateElement ( 'strong', $k) . ' : ';
				$inner .= Html::CreateElement ( 'em', $v) . '<br>';
			}
			$outer = Html::CreateElement ( 'div', $inner);
			echo $outer;
		}
	}
	/**
	 * Pulls a named element from template/element folder into the document
	 *
	 * @param string $name        	
	 */
	public static function GetElement($name,$data = null) {
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