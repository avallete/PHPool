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
	
	if (session_status() == PHP_SESSION_NONE)
		session_start();

	if ($_POST['id'])
	{
		$game = $_SESSION['game'][$_POST['id']];
      	$ship = $game->getShip();
      	$weapons = $ship->getWeapons();
      	display_weapon_name($weapons);
	}
?>