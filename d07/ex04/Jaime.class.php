<?php
	Class Jaime extends Lannister{
		function sleepWith($partnair){
			if ($partnair instanceof Cersei)
				print "With pleasure, but only in a tower in Winterfell, then".PHP_EOL;
			else
				parent::sleepWith($partnair);
		}
	}
?>