<?php
	Class Lannister{
		const not = "Not even if I'm drunk !";
		const yes = "Let's do this.";
		function sleepWith($partnair){
			if ($partnair instanceof Lannister)
				print Lannister::not.PHP_EOL;
			else
				print Lannister::yes.PHP_EOL;
		}
	}
?>