<?php
abstract class Weapon {

	private $_range = array();
	private $_radius;
	private $_charges;
	private $_name;


	public function getRange(){ return $this->_range; }
	public function getRadius(){ return $this->_radius; }
	public function getCharges(){ return $this->_charges; }
	public function getName(){ return $this->_name; }
	
	public function setCharges(){
		$this->_charges += static::CHARGES;
	}
	public function subCharge(){
		$this->_charges -= 1;
	}	
	public function __construct (array $kwargs){
		if (array_key_exists('range', $kwargs) &&
			array_key_exists('radius', $kwargs) &&
			array_key_exists('name', $kwargs))
			{
				$this->_radius = $kwargs['radius'];
				$this->_range = $kwargs['range'];
				$this->_name = $kwargs['name'];
				$this->_charges = 0;
			}
	}
	public static function doc(){
		if (file_exists('../docs/Weapon.doc.txt'))
			$doc = file_get_contents('../docs/Weapon.doc.txt');
		return $doc;
	}
	public function __destruct (){
	}
	public function __toString (){
		return ;
	}	
}
?>