<?php
	require_once('Color.class.php');
	require_once('Vertex.class.php');
	require_once('Vector.class.php');
	Class Matrix{
	static 	$verbose = FALSE;	
	const 	IDENTITY = 'IDENTITY';
	const 	SCALE = 'SCALE';
	const 	RX = 'RX';
	const 	RY = 'RY';
	const 	RZ = 'RZ';
	const 	TRANSLATION = 'TRANSLATION';
	const 	PROJECTION = 'PROJECTION';
	private $_M = 0;
	public static function doc(){
		if (file_exists('Matrix.doc.txt'))
			return (file_get_contents('Matrix.doc.txt').PHP_EOL);
	}
	private function _create_identity()
	{
		$vtcX = new Vector(['dest' => new Vertex(array('x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'w' => 0.0))]);
		$vtx0 = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	private function _create_translation(Vector $vec)
	{
		$vtcX = new Vector(['dest' => new Vertex(array('x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 1.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 1.0, 'w' => 0.0))]);
		$vtx0 = new Vertex(array('x' => $vec->getX(), 'y' => $vec->getY(), 'z' => $vec->getZ(), 'w' => 1.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	private function _create_scale($factor)
	{
		$vtcX = new Vector(['dest' => new Vertex(array('x' => $factor, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => $factor, 'z' => 0.0, 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => $factor, 'w' => 0.0))]);
		$vtx0 = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	private function _create_rx($angle)
	{

		$vtcX = new Vector(['dest' => new Vertex(array('x' => 1.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => cos($angle), 'z' => sin($angle), 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => -sin($angle), 'z' => cos($angle), 'w' => 0.0))]);
		$vtx0 = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	private function _create_ry($angle)
	{

		$vtcX = new Vector(['dest' => new Vertex(array('x' => cos($angle), 'y' => 0.0, 'z' => -sin($angle), 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 1.0, 'z' => 0, 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => sin($angle), 'y' => 0, 'z' => cos($angle), 'w' => 0.0))]);
		$vtx0 = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	private function _create_rz($angle)
	{

		$vtcX = new Vector(['dest' => new Vertex(array('x' => cos($angle), 'y' => sin($angle), 'z' => 0.0, 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => -sin($angle), 'y' => cos($angle), 'z' => 0, 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => 0, 'y' => 0, 'z' => 1, 'w' => 0.0))]);
		$vtx0 = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	private function _create_projection($fov, $ratio, $near, $far)
	{
		$rad = deg2rad($fov);
		$yscale = 1.0 / tan(($rad / 2));
		$xscale = $yscale / $ratio;
		$nearmfar = $near - $far;
		$vtcX = new Vector(['dest' => new Vertex(array('x' => $xscale, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0))]);
		$vtcY = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => $yscale, 'z' => 0.0, 'w' => 0.0))]);
		$vtcZ = new Vector(['dest' => new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => (($far + $near) / $nearmfar), 'w' => -1.0))]);
		$vtx0 = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => ((2 * $far * $near) / $nearmfar), 'w' => 0.0));
		$this->_M = array('vtcX' => $vtcX, 'vtcY' => $vtcY, 'vtcZ' => $vtcZ, 'vtx0' => $vtx0);
	}
	function __construct(array $kwargs)
	{
		if ($kwargs['preset'] == Matrix::IDENTITY)
			$this->_create_identity();
		else if ($kwargs['preset'] == Matrix::TRANSLATION)
			$this->_create_translation($kwargs['vtc']);
		else if ($kwargs['preset'] == Matrix::SCALE)
			$this->_create_scale($kwargs['scale']);
		else if ($kwargs['preset'] == Matrix::RX)
			$this->_create_rx($kwargs['angle']);
		else if ($kwargs['preset'] == Matrix::RY)
			$this->_create_ry($kwargs['angle']);
		else if ($kwargs['preset'] == Matrix::RZ)
			$this->_create_rz($kwargs['angle']);
		else if ($kwargs['preset'] == Matrix::PROJECTION)
			$this->_create_projection($kwargs['fov'], $kwargs['ratio'], $kwargs['near'], $kwargs["far"]);
		if (Matrix::$verbose === TRUE)
			print $kwargs['preset']." instance constructed".PHP_EOL;
	}
	function __destruct(){
		if (Matrix::$verbose === TRUE)
			print "Matrix instance destructed".PHP_EOL;
	}
	function __tostring(){
		$l1 = "M  | vtcX  | vtcY  | vtcZ  | vtxO  |\n------------------------------------\n";
		$x = "x  |  ".sprintf('%.2f', $this->_M['vtcX']->getX())."  |  ".sprintf('%.2f', $this->_M['vtcY']->getX())."  |  ".sprintf('%.2f', $this->_M['vtcZ']->getX())."  |  ".sprintf('%.2f', $this->_M['vtx0']->getX())."  |\n";
		$y = "y  |  ".sprintf('%.2f', $this->_M['vtcX']->getY())."  |  ".sprintf('%.2f', $this->_M['vtcY']->getY())."  |  ".sprintf('%.2f', $this->_M['vtcZ']->getY())."  |  ".sprintf('%.2f', $this->_M['vtx0']->getY())."  |\n";
		$z = "z  |  ".sprintf('%.2f', $this->_M['vtcX']->getZ())."  |  ".sprintf('%.2f', $this->_M['vtcY']->getZ())."  |  ".sprintf('%.2f', $this->_M['vtcZ']->getZ())."  |  ".sprintf('%.2f', $this->_M['vtx0']->getZ())."  |\n";
		$w = "w  |  ".sprintf('%.2f', $this->_M['vtcX']->getW())."  |  ".sprintf('%.2f', $this->_M['vtcY']->getW())."  |  ".sprintf('%.2f', $this->_M['vtcZ']->getW())."  |  ".sprintf('%.2f', $this->_M['vtx0']->getW())."  |\n";
		$str = $l1.$x.$y.$z.$w."\n";
		return $str;
	}
	function mult(Matrix $rhs)
	{
		$result = clone $rhs;
		$vtxx = $result->_M['vtcX']->getX() * $rhs->_M['vtcX']->getX();
		$vtxy = $result->_M['vtcX']->getY() * $rhs->_M['vtcX']->getY();
		$vtxz = $result->_M['vtcX']->getZ() * $rhs->_M['vtcX']->getZ();
		$vtxw = $result->_M['vtcX']->getW() * $rhs->_M['vtcX']->getW();
		$result->_M['vtcX'] = new Vector(['dest' => new Vertex(array('x' => $vtxx, 'y' => $vtxy, 'z' => $vtxz, 'w' => $vtxw))]);
		return ($result);
	}
}
?>