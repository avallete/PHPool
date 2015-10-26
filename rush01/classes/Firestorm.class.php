<?php
require_once 'Ship.class.php';
require_once 'navalspear.class.php';
require_once 'Weapon.class.php';
class Firestorm extends Ship {

	const PP = 5;
	const PV = 3;

	public function __construct (array $kwargs){
			$value = array();
			$value['sprite'] = 'http://wh40k.lexicanum.com/mediawiki/images/1/11/FirestormFrigate.jpg';
			$value['pv'] = Firestorm::PV;
			$value['cm'] = 18;
			$value['pp'] = Firestorm::PP;
			$value['maneuver'] = 1;
			$value['weapons']['1'] = new navalspear();
			$value['weapons']['2'] = new navalspear();
			$value['size']['width'] = 1;
			$value['size']['height'] = 2;
			$value['name'] = 'Firestorm Frigate';
			$value['pos'] = $kwargs['pos'];
			parent::__construct($value);
	}
	public static function doc(){
		if (file_exists('../docs/Firestorm.doc.txt'))
			$doc = file_get_contents('../docs/Firestorm.doc.txt');
		return $doc;
	}
	public function shoot(Ship $target, Weapon $weapon) {
		if ($weapon->getCharges() > 1)
		{
			$dice = rand(1 , 6);
			$range = $this->check_range($target, $weapon);
			if ($range == 1 && $dice >= 4)
				$target->receive_dmg();
			else if ($range == 2 && $dice >= 5)
				$target->receive_dmg();
			else if ($range == 3 && $dice >= 6)
				$target->receive_dmg();
			$weapon->subCharge();
		}
	}

}
?>