<?php
	include_once 'classes/Ship.class.php';
	include_once 'classes/Exorcist-class.class.php';
	include_once 'classes/Oberon.class.php';
	include_once 'classes/Firestorm.class.php';
	include_once 'classes/Shroud.class.php';
	include_once 'classes/Cairn.class.php';
	include_once 'classes/Jackal.class.php';
	include_once 'classes/Ore.class.php';
	include_once 'classes/Porrui.class.php';
	include_once 'classes/Tiger.class.php';	
	include_once 'classes/Weapon.class.php';
	include_once 'classes/Game.class.php';
	include_once 'Ship.php';
	
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if (isset($_POST['ship']))
	{
		$ship = $_SESSION['game']->getShip()[$_POST['ship']];
		$weapons = $ship->getWeapons();
		$weaponstat = [];
		foreach($weapons as $k => $obj)
			array_push($weaponstat, array("id" => $k, "Range" => $obj->getRange(), "Charges" => $obj->getCharges(), "Name" => $obj->getName()));
		$stats = array('Name' => $ship->getName(), 'PV' => $ship->getPv(), 'Vitesse' => $ship->getCm(), 
			'Manoeuvre' => $ship->getManeuver(), 'Shield' => $ship->getShield(), 'PP' => $ship->getPp());
		echo (json_encode(array('ship' => $ship, 'weapons' => $weaponstat, 'stats' => $stats)));
	}
?>