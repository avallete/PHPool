<?php
abstract class Ship {

	const NORTH = 'NORTH';
	const SOUTH = 'SOUTH';
	const EST = 'EST';
	const WEST = 'WEST';
	const IMPERIUM = 'IMPERIUM';	

	private $_sprite;
	private $_pv;
	private $_cm;
	private $_maneuver;
	private $_weapons;
	private $_size;
	private $_name;
	private $_shield;
	private $_pos;
	private $_pp;
	private $_direction = self::EST;
	private $_move = False;


	public function getSprite(){ return $this->_sprite; }
	public function getPp(){ return $this->_pp; }
	public function getPv(){ return $this->_pv; }
	public function getCm(){ return $this->_cm; }
	public function getManeuver(){ return $this->_maneuver; }
	public function getWeapons(){ return $this->_weapons; }
	public function getSize(){ return $this->_size; }
	public function getName(){ return $this->_name; }
	public function getShield(){ return $this->_shield; }
	public function getPos(){ return $this->_pos; }
	public function getDirection(){ return $this->_direction; }

	protected function check_range(Ship $target, Weapon $weapon){
		$x = $target->getPos()['x'] - $this->getPos()['x'];
		$y = $target->getPos()['y'] - $this->getPos()['y'];
		$distance = sqrt( pow($x, 2) +  pow($y, 2));
		if ($distance != 0)
		{
			if ($distance < $weapon->getRange()['short'])
				return 1;
			else if ($distance < $weapon->getRange()['mid'])
				return 2;
			else if ($distance < $weapon->getRange()['long'])
				return 3;
			else
				return 0;
		}
	}
	public function setPp(){
		$this->_pp = static::PP;
	}
	public function receive_dmg(){ 
		if ($this->_shield > 0)
			$this->_shield -= 1;
		else
			$this->_pv -= 1;
	}
	public function pp_set_shield(){ 
		if ($this->_pp > 0)
		{
			$this->_shield += 1;
			$this->_pp -= 1;
		}
	}
	public function pp_set_speed(){
		if ($this->_pp > 0)
		{
			$dice = rand(1, 6);
			$this->_cm += $dice;
			$this->_pp -= 1;
		}
	}
	public function pp_set_weapon($key){
		if ($this->_pp > 0)
		{
			$this->_weapons[$key]->setCharges();
			$this->_pp -= 1;
		}
	}
	public function pp_repair(){
		if ($this->_move === False && $this->_pp > 0)
		{
			$dice = rand(1, 6);
			if ($dice == 6)
				$this->_pv = static::PV;
			else
			{
				$this->_pv += $dice;
				if ($this->_pv > static::PV)
					$this->_pv = static::PV;
				$this->_pp -= 1;
			}
		}
	}
	public function __construct (array $kwargs){
		if (array_key_exists('pv', $kwargs) &&
			array_key_exists('cm', $kwargs) &&
			array_key_exists('weapons', $kwargs) &&
			array_key_exists('maneuver', $kwargs) &&
			array_key_exists('size', $kwargs) &&
			array_key_exists('name', $kwargs) &&
			array_key_exists('pos', $kwargs) &&
			array_key_exists('pp', $kwargs))
			{
				$this->_pp = $kwargs['pp'];
				$this->_pos = $kwargs['pos'];
				$this->_sprite = $kwargs['sprite'];
				$this->_pv = $kwargs['pv'];
				$this->_cm = $kwargs['cm'];
				$this->_maneuver = $kwargs['maneuver'];
				$this->_size['width'] = $kwargs['size']['width'];
				$this->_size['height'] = $kwargs['size']['height'];
				$this->_name = $kwargs['name'];
				$this->_weapons = $kwargs['weapons'];
			}
	}
	public static function doc(){
		if (file_exists('../docs/Ship.doc.txt'))
			$doc = file_get_contents('../docs/Ship.doc.txt');
		return $doc;
	}
	public function move_on($nb){
		switch ($this->getDirection()) {
			case 'NORTH':
				$this->_pos['y'] -= $nb;
				break;
			case 'SOUTH':
				$this->_pos['y'] += $nb;
				break;
			case 'EST':
				$this->_pos['x'] += $nb;
				break;
			case 'WEST':
				$this->_pos['x'] -= $nb;
				break;
			default:
				break;
			if ($this->_pos['y'] < 0)
				$this->_pos['y'] = 0;
			if ($this->_pos['x'] < 0)
				$this->_pos['x'] = 0;
		}
		$this->_cm -= $nb;
	}
	public function turn($dir)	{
		$this->_direction = $dir;
	}
	abstract public function shoot(Ship $target, Weapon $weapon);
	public function __destruct (){
	}
	public function __toString (){
		return 'holla' . PHP_EOL;
	}	
}
?>