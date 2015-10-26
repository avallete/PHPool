<?php
	include_once 'include.php';
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	$game = $_SESSION['game'];
	$phase = $game->getGamePhase();
	if ($_POST['submit'] == 'get')
		echo ($phase->getPhase());
	if ($_POST['submit'] == 'next')
		$phase->nextPhase();
?>