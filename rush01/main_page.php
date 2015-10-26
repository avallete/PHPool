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
	include 'classes/Game.class.php';
	include 'header.php';
	include 'panel.php';
	include 'Ship.php';
	include 'weapon.php';

	if (session_status() == PHP_SESSION_NONE)
		session_start();
		?>
		<link rel="stylesheet" type="text/css" href="class.css" />

