<?php
	require_once('Color.class.php');
	require_once('Vertex.class.php');
	Class Vector{
		static 	$verbose = FALSE;
		private $_x = 0.0;
		private $_y = 0.0;
		private $_z = 0.0;
		private $_w = 0.0;
		public static function doc(){
			if (file_exists('Vector.doc.txt'))
				return (file_get_contents('Vector.doc.txt').PHP_EOL);
		}
		function getX(){return $this->_x;}
		function getY(){return $this->_y;}
		function getZ(){return $this->_z;}
		function getW(){return $this->_w;}
		function __construct(array $kwargs)
		{
			$this->_x = $kwargs['dest']->getX();
			$this->_y = $kwargs['dest']->getY();
			$this->_z = $kwargs['dest']->getZ();
			if (array_key_exists('orig', $kwargs) && $kwargs['orig'] instanceof Vertex)
			{
				$this->_x -= $kwargs['orig']->getX();
				$this->_y -= $kwargs['orig']->getY();
				$this->_z -= $kwargs['orig']->getZ();
			}
			else
				$vertex = new Vertex(['x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0]);
			if (self::$verbose === TRUE)
				print $this.' constructed'.PHP_EOL;
		}
		function __destruct(){
			if (self::$verbose === TRUE)
				print $this.' destructed'.PHP_EOL;
		}
		function __tostring(){
			return sprintf('Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )', $this->getX(), $this->getY(), $this->getZ(), $this->getW());
		}
		function magnitude(){
			return (floatval(sqrt((pow($this->getX(), 2)) + pow($this->getY(), 2) + pow($this->getZ(), 2))));
		}
		function normalize(){
			$magnitude = $this->magnitude();
			if ($magnitude != 0)
			{
				$x = $this->getX() / $magnitude;
				$y = $this->getY() / $magnitude;
				$z = $this->getZ() / $magnitude;
				$vert = new Vertex(['x' => $x, 'y' => $y, 'z' => $z, 'w' => 0]);
				return (new Vector(['dest' => $vert]));
			}
			else
			{
				$vert = new Vertex(['x' => $this->getX(), 'y' => $this->getY, 'z' => $this->getZ, 'w' => $this->getW()]);
				return (new Vector(['dest' => $vert]));
			}
		}
		function add(Vector $rhs){
			$vert = new Vertex(['x' => $this->getX() + $rhs->getX(), 'y' => $this->getY() + $rhs->getY(), 'z' => $this->getZ() + $rhs->getZ(), 'w' => 0]);
			return (new Vector(['dest' => $vert]));
		}
		function sub(Vector $rhs){
			$vert = new Vertex(['x' => $this->getX() - $rhs->getX(), 'y' => $this->getY() - $rhs->getY(), 'z' => $this->getZ() - $rhs->getZ(), 'w' => 0]);
			return (new Vector(['dest' => $vert]));
		}
		function opposite(){
			$vert = new Vertex(['x' => -$this->getX(), 'y' => -$this->getY(), 'z' => -$this->getZ(), 'w' => 0]);
			return (new Vector(['dest' => $vert]));
		}
		function scalarProduct($k){
			$vert = new Vertex(['x' => $this->getX() * $k, 'y' => $this->getY() * $k, 'z' => $this->getZ() * $k, 'w' => 0]);
			return (new Vector(['dest' => $vert]));
		}
		function dotProduct(Vector $rsh){
			return (floatval(($this->getX() * $rsh->getX()) + ($this->getY() * $rsh->getY()) + ($this->getZ() * $rsh->getZ())));
		}
		function cos(Vector $rsh){
			return floatval(($this->dotProduct($rsh) / ($this->magnitude() * $rsh->magnitude())));
		}
		function crossProduct(Vector $rsh){
			$x = $this->getY() * $rsh->getZ() - $this->getZ() * $rsh->getY();
			$y = $this->getZ() * $rsh->getX() - $this->getX() * $rsh->getZ();
			$z = $this->getX() * $rsh->getY() - $this->getY() * $rsh->getX();
			$vert = new Vertex(['x' => $x, 'y' => $y, 'z' => $z, 'w' => 0]);
			return (new Vector(['dest' => $vert]));
		}
	}
?>