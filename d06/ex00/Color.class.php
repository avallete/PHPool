<?php
	Class Color
	{	
		static $verbose = FALSE;
		public $red = 0;
		public $green = 0;
		public $blue = 0;
		public static function doc()
		{
			if (file_exists('Color.doc.txt'))
				return (file_get_contents('Color.doc.txt').PHP_EOL);
		}
		private function _check_value()
		{
			$this->red &= 0xff;
			$this->blue &= 0xff;
			$this->green &= 0xff;
		}
		function __construct(array $kwargs)
		{
			if (isset($kwargs['rgb']))
			{
				$col = intval($kwargs['rgb']);
				$this->red = ($col >> 16) & 0xff;
				$this->green = ($col >> 8) & 0xff;
				$this->blue = $col & 0xff;
			}
			else if (isset($kwargs['red']) && isset($kwargs['green']) && isset($kwargs['blue']))
			{
				$this->red = intval($kwargs['red']);
				$this->green = intval($kwargs['green']);
				$this->blue = intval($kwargs['blue']);
			}
			$this->_check_value();
			if (self::$verbose === TRUE)
				print $this.' constructed.'.PHP_EOL;
		}
		function __destruct()
		{
			if (self::$verbose === TRUE)
				print $this.' destructed.'.PHP_EOL;
		}
		function __toString()
		{
			return sprintf('Color( red: %0 3d, green: %0 3d, blue: %0 3d )', $this->red, $this->green, $this->blue);
		}
		function add(Color $param)
		{
			$str = array('red' => ($this->red + $param->red), 'green' => ($this->green + $param->green), 'blue' => ($this->blue + $param->blue));
			$new = new Color($str);
			return ($new);
		}
		function sub(Color $param)
		{
			$str = array('red' => ($this->red - $param->red), 'green' => ($this->green - $param->green), 'blue' => ($this->blue - $param->blue));
			$new = new Color($str);
			return ($new);
		}
		function mult($factor)
		{
			$str = array('red' => ($this->red * $factor), 'green' => ($this->green * $factor), 'blue' => ($this->blue * $factor));
			$new = new Color($str);
			return ($new);	
		}
	}
?>