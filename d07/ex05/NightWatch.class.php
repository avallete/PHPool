<?php
	Class NightWatch{
		private $_member = array();
		function recruit($member)
		{
			$this->_member[] = $member;
		}
		function fight()
		{
			foreach($this->_member as $act)
				$act->fight();
		}
	}
?>