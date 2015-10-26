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
	if (isset($_POST['submit']) && $_POST['submit'] == 'set'){
		if (isset($_POST['set_pp']))
		{
			switch ($_POST['set_pp']) {
				case 'pp_set_shield':
					{
						$game = $_SESSION['game'];
						$ship = $game->getShip();
						$ship[$_POST['ship']]->pp_set_shield();
					}
					break;
				case 'pp_set_speed':
					{
						$game = $_SESSION['game'];
						$ship = $game->getShip();
						$ship[$_POST['ship']]->pp_set_speed();
					}
					break;
				case 'pp_set_speed':
					{
						$game = $_SESSION['game'];
						$ship = $game->getShip();
						$ship[$_POST['ship']]->pp_set_speed();
					}
				case 'pp_repair':
					{
						$game = $_SESSION['game'];
						$ship = $game->getShip();
						$ship[$_POST['ship']]->pp_repair();
					}
					break;
				default:
					break;
			}
		}
	}
	header('Location: index.php');
?>