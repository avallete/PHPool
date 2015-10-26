<?php
require_once 'Ship.class.php';
require_once 'navalspear.class.php';
require_once 'Weapon.class.php';
class Cairn extends Ship {

	const PP = 12;
	const PV = 8;

	public function __construct (array $kwargs){
			$value = array();
			$value['sprite'] = 'http://wh40k-fr.lexicanum.com/mediawiki/images/9/92/Vaisseau-Tombe_Cairn.jpg';
			$value['pv'] = Cairn::PV;
			$value['cm'] = 10;
			$value['pp'] = Cairn::PP;
			$value['maneuver'] = 5;
			$value['weapons']['1'] = new navalspear();
			$value['weapons']['2'] = new navalspear();
			$value['size']['width'] = 3;
			$value['size']['height'] = 7;
			$value['name'] = 'Cairn-class Tomb Ship';
			$value['pos'] = $kwargs['pos'];
			parent::__construct($value);
	}
	public static function doc(){
		if (file_exists('../docs/Cairn.doc.txt'))
			$doc = file_get_contents('../docs/Cairn.doc.txt');
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