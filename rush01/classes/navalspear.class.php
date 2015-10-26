<?php
	require_once 'Weapon.class.php';
class navalspear extends Weapon{
		const RADIUS = 1;
		const NAME = 'Naval spear';
		const CHARGES = 3;
		public function __construct (){
			$value = array();
			$value['range'] = ['short' => 30 , 'mid' => 60, 'long' => 90];
			$value['radius'] = self::RADIUS;
			$value['name'] = self::NAME;
			parent::__construct($value);
	}
	public static function doc(){
		if (file_exists('../docs/navalspear.doc.txt'))
			$doc = file_get_contents('../docs/navalspear.doc.txt');
		return $doc;
	}
	public function shoot($target) {
		return True;
	}
}

?>