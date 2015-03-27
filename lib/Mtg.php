<?php
class Mtg {
	public static $types = array('Artifact','Creature','Enchantment','Instant','Land','Planeswalker','Tribal','Sorcery');
	public static $supertypes = array('Basic','Legendary','Snow','World');
	
	public static function ParseMana(&$source) {
		$string = str_replace('{','',$source);
		$arr = explode("}",$string);
		$arr = array_filter ( $arr, "Router::RemoveEmpty" );
		$new = '';
		foreach ($arr as $sym) {
			//$sym = strtolower($sym);
			switch ($sym) {
				case 'r':
				case 'g':
				case 'b':
				case 'u':
				case 'w':
                    // Add mana image
					$new .= $sym;
					break;
				case '0':
				case '1':
				case '2':
				case '3':
				case '4':
				case '5':
				case '6':
				case '7':
				case '8':
				case '9':
				case '10':
                    // Add number mana image
					$new .= $sym;
					break;
				default:
					$new .= $sym;
					break;
			}
		}
		$source = $new;
	}
	
	public static function ParseText(&$source) {
		$new = nl2br($source);
		$source = $new;
	}
	
	public static function ParseType(&$type)
    {
        $arr = explode(',', $type);
        $dash = false;
        $new = '';
        foreach ($arr as $type) {
            if ($dash == false) {
                if (!in_array($type, self::$types) && !in_array($type, self::$supertypes) && strlen($new) > 0) {
                    $dash = true;
                    $new .= ' - ';
                }
            }
            $new .= $type . ' ';
        }
        $new = rtrim($new);
        $type = $new;
    }
}