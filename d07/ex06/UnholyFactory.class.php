<?php
	Class UnholyFactory {
		private $_list = NULL;
		function __construct()
		{
			$this->_list = array();
		}
		function fabricate($sold)
		{
			foreach ($this->_list as $k => $pers)
			{
				if ($pers->getName() == $sold)
				{
					print "(Factory fabricates a fighter of type ".$sold.')'.PHP_EOL;
					return ($this->_list[$k]);
				}
			}
			print "(Factory hasn't absorbed any fighter of type ".$sold.')'.PHP_EOL;
			return (NULL);
		}
		function absorb($sold)
		{
			if (get_parent_class($sold) == 'Fighter')
			{
				if (in_array($sold, $this->_list))
					print "(Factory already absorbed a fighter of type ".$sold->getName().')'.PHP_EOL;
				else
				{
					array_push($this->_list, $sold);
					print "(Factory absorbed a fighter of type ".$sold->getName().')'.PHP_EOL;
				}
			}
			else
				print "(Factory can't absorb this, it's not a fighter)".PHP_EOL;
		}
	}
?>