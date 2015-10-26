<?php
	require_once('Color.class.php');
	Class Vertex
	{
		static $verbose = FALSE;
		private $_x = 0.0;
		private $_y = 0.0;
		private $_z = 0.0;
		private $_w = 1.0;
		private $_color = NULL;
		function 	__get($var){
			print "You can't get ".$var.", sorry :'(.\n";
		}
		function 	__set($value, $var){
			print "We can't assign".$var." at ".$value."sorry.\n";
		}
		public function 	getX(){return $this->_x;}
		public function 	getY(){return $this->_y;}
		public function 	getZ(){return $this->_z;}
		public function 	getW(){return $this->_w;}
		public function 	getColor(){return $this->_color;}
		public function 	setX($value){$this->_x = floatval($value);}
		public function 	setY($value){$this->_y = floatval($value);}
		public function 	setZ($value){$this->_z = floatval($value);}
		public function 	setW($value){$this->_w = floatval($value);}
		public function 	setColor($value){
			if ($value instanceof Color)
				$this->_color = $value;}
		public static function doc(){
			if (file_exists('Vertex.doc.txt'))
				return (file_get_contents('Vertex.doc.txt').PHP_EOL);
		}
		function 	__construct(array $kwargs)
		{
			$this->setX($kwargs["x"]);
			$this->setY($kwargs["y"]);
			$this->setZ($kwargs["z"]);
			$this->getColor();
			if (array_key_exists('w', $kwargs))
				$this->setW($kwargs['w']);
			if (array_key_exists('color', $kwargs))
				$this->setColor($kwargs['color']);
			else
				$this->_color = new Color(['rgb' => 0xFFFFFF]);
			if (self::$verbose === TRUE)
				print $this.' constructed'.PHP_EOL;
		}
		function 	__destruct(){
			self::$verbose === TRUE ? print $this.' destructed'.PHP_EOL : 0;}
		function 	__tostring(){
			$str = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f", $this->getX(), $this->getY(), $this->getZ(), $this->getW());
			if (self::$verbose === TRUE)
				$str = $str.', '.$this->getColor();
			$str = $str.' )';
			return ($str);
		}
	}
?>