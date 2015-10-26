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
	if (isset($_POST['submit']) && $_POST['submit'] == 'attack')
	{
		$game = $_SESSION['game'];
		$ships = $game->getShip();
		$killer = $ships[$_POST['killer']];
		$target = $ships[$_POST['target']];
		$weapons = $ships[$_POST['killer']]->getWeapons();
		$weapon = $weapons[$_POST['weapon']];
		$killer->shoot($target, $weapon);
	}
	header('Location: main_page.php');
?>