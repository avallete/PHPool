<?php
	abstract Class Fighter{
		protected $_name;
		function __construct($str){
			$this->_name = $str;
		}
		function getName(){return $this->_name;}
		abstract public function fight($target);
	}
?>