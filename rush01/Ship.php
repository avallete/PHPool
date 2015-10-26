<?php
	function show_stats_ship(Ship $ship, $key){
			$weapons = $ship->getWeapons();
			echo "<div>";
			echo "<div style='float:left;'>";
		    echo '<h4>[ Name ] : ' . $ship->getName() . '(' . $key . ')' .'</h4>';
      		echo '<ul>';
			echo '<li>[ PV ] : ' . $ship->getPv() . '</li>';
			echo '<li>[ Vitesse ] :' . $ship->getCm() . '</li>';
			echo '<li>[ Manoeuvre ] : ' . $ship->getManeuver() . '</li>';
			echo '<li>[ Shield ] : ' . $ship->getShield()  . '</li>';
			echo '<li>[ PP ] : ' . $ship->getPp() . '</li>';
      		echo '</ul>';
      		echo "<div>";
      		echo '<h4> Weapons</h4>';
      		echo "<ul>";
      		      		show_stats_weapons($weapons);
      		echo '</ul>';
      		echo "</div>";
      		?>
			<p>
	       <form action="weapon.php" method="POST">
	       <?php
	       		echo '<input type="hidden" name="ship" value="'. $key .'"">';
       	?>
	            <select style='width:150px;' name="weapon" id="ID">
					<?php display_weapon_name($weapons)?>
	            </select>
	           <input type='submit' name='submit' value="set_weapon">
	        </form>
	        </p>
		<?php
      		echo "</div>";

      		echo "</div>";
	}
	function posship(Ship $ship, $key){
	$pos = $ship->getPos();
	$size = $ship->getSize();
	$x = $pos['x'] * 10 + 2 * $pos['x'];
	$y = $pos['y'] * 10 + 2 * $pos['y'];
	$width = $size['height'] * 10 + 2 * $size['height'];
	if ($ship->getDirection() == Ship::SOUTH)
		$rotate = 'transform-origin: 50% 50%;transform : rotate(90deg);';
	else if ($ship->getDirection() == Ship::NORTH)
		$rotate = 'transform-origin: 50% 50%;transform : rotate(270deg);';
	else if ($ship->getDirection() == Ship::WEST)
		$rotate = 'transform-origin: 50% 50%;transform : rotateY(180deg);';
	else
		$rotate = "";
	 echo '<div style=" ' . $rotate . 'position: absolute; left:' . $x . '; top:' . $y . ';">
	  	<img src="' . $ship->getSprite() . '" width ="' . $width . 'px" data-ship="'.$key.'"  class="ship"></div>';
}
	function display_name(){
		$game = $_SESSION['game'];
		foreach ($game->getShip() as $key => $value) {
			echo '<option value="'.$key.'">'. $value->getName() . '(' . $key . ')' .'</option>';
		}
	}
?>