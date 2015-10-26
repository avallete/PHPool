	<?php
		include 'Ship.php';
		include 'weapon.php';
		include 'game.php';
		if (session_status() == PHP_SESSION_NONE)
			session_start();
	?>
<html>
<head>
      <link rel="stylesheet" type="text/css" href="class.css">

</head>
<body>
  <div id="panel">
    <h2 style="text-align: center;" id="PhaseName">Player panel</h2>
      <p>
      <h3>Ship informations</h3>
      </p>
      <p>
        <form action="pp.php" method="POST">
      	    <select style='width:150px;' name="ship" id="ID">
      	    <?php display_name()?>
      	    </select>
            <select style='width:150px;' name="set_pp" id="ID">
              <option value="pp_set_shield">pp_set_shield</option>
              <option value="pp_set_speed">pp_set_speed</option>
              <option value="pp_repair">pp_repair</option>
            </select>
           <input type='submit' name='submit' value="set">
        </form>
      </p>
        <form action="Attack.php" method="POST">
      	    <select style='width:150px;' name="killer" id="ID">
      	    	<?php display_name()?>
      	    </select>
      	    <select style='width:150px;' name="weapon" id="ID">
      	    	<?php 
      	    		$game = $_SESSION['game'];
      	    		$ship = $game->getShip();
      	    		$weapons = $ship['0']->getWeapons();
      	    		display_weapon_name($weapons);
      	    	?>
      	    </select>
            <select style='width:150px;' name="target" id="ID">
				<?php display_name()?>
            </select>
           <input type='submit' name='submit' value="attack">
        </form>
              <div>
      	<p>Mouvements</p>
      	    <form action="Moves.php" name="move" method="POST">
      	     <select style='width:150px;' name="ship">
      	    <?php display_name()?>
      	    </select>
      		<input type="number" min="0" max="50" name="movenb" id="movenb" placeholder="move">
      		<button type="submit"></button>
      		</form>
			<button type="submit" id="turn_r">left</button>
			<button type="submit" id="turn_l">left</button>
		</div>
      </p>
     </div>
  <div id="mypan" class="panel">
  <div id="shipname" class="shipnamec"></div>
  <div id="shipstats" class="shipstatsc"></div>
  <div id="shipweapons" class="shipweaponsc"></div>
  <button type="submit" id="ChangePhase">Change Phase</button>
  </div>
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="panel.js"></script>
</body>
</html>
<?php 
	$game = $_SESSION['game'];
	foreach ($game->getShip() as $key => $value) {
			posship($value, $key);
	}
 ?>