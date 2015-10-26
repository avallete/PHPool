<?php

	require_once 'Ship.class.php';
	require_once 'Phase.class.php';

class Game {

	private $_ship = array();
	private $_phase;

	public function getGamePhase(){ return $this->_phase; }
	public function getShip(){ return $this->_ship; }

	public function destroyShip($key){
		unset($this->_ship[$key]);
	}
	public function add_ship(Array $ship){
			switch ($ship['name']) {
				case 'Cairn':
				$this->_ship[] = new Cairn($ship);
					break;
				case 'Jackal':
				$this->_ship[] = new Jackal($ship);
					break;
				case 'Shroud':
				$this->_ship[] = new Shroud($ship);
					break;
				case 'Ore':
				$this->_ship[] = new Ore($ship);
					break;
				case 'Porrui':
				$this->_ship[] = new Porrui($ship);
					break;
				case 'Tiger':
				$this->_ship[] = new Tiger($ship);
					break;
				case 'Oberon':
				$this->_ship[] = new Oberon($ship);
					break;
				case 'Exorcist':
				$this->_ship[] = new Exorcistclass($ship);
					break;
				case 'Firestorm':
				$this->_ship[] = new Firestorm($ship);
					break;
				default:
					break;
			}

	}
	public function __construct(){
				$this->_phase = new Phase();
	}
	public static function doc(){
		if (file_exists('../docs/Phase.doc.txt'))
			$doc = file_get_contents('../docs/Phase.doc.txt');
		return $doc;
	}
	public function __destruct (){
	}
	public function __toString (){
		return ;
	}	
}
?>