<?php

Class Phase {

	private $_phase;
	const PP = 'PP';
	const MOVE = 'MOVE';
	const ATTACK = 'ATTACK';

	public function __construct()
	{
		$this->_phase = self::PP;
	}
	public function getPhase(){ return $this->_phase; }

	public function nextPhase(){
		switch ($this->getPhase()) {
			case 'PP':
				$this->_phase = self::MOVE;
				break;
			case 'MOVE':
				$this->_phase = self::ATTACK;
				break;
			case 'ATTACK':
				$this->_phase = self::PP;
				break;
			default:
				break;
		}
	}
	public function __destruct (){

	}
}
?>