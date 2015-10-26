<?php
	include_once 'classes/Game.class.php';
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

	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if (isset($_POST['submit']) && $_POST['submit'] == 'set_weapon'){
			$game = $_SESSION['game'];
			$ships = $game->getShip();
			$ship = $ships[$_POST['ship']];
			$ship->pp_set_weapon($_POST['weapon']);
	}
	header('Location: index.php');

?>