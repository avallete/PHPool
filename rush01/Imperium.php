<?php
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        if (!array_key_exists('spent', $_SESSION))
            $_SESSION['spent'] = 0;
        if (isset($_POST['submit'])){
            switch ($_POST['submit']) {
                case 'add_Oberon':
                    $_SESSION['ships'][] = 'Oberon';
                    $_SESSION['spent'] += 300;
                    break;
                case 'add_Exorcist':
                    $_SESSION['ships'][] = 'Exorcist';
                    $_SESSION['spent'] += 100;
                    break;
                case 'add_Firestorm':
                    $_SESSION['ships'][] = 'Firestorm';
                    $_SESSION['spent'] += 50;
                    break;
                default:
                    break;
            }
        }
        if ($_SESSION['Points'] == $_SESSION['spent'])
            header('Location: game.php');

?>

<HTML>
  <HEAD>
    <META charset="utf-8" />
        <link rel="stylesheet" href="font-awesome.min.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" type="text/css" href="class.css" />
    <TITLE>Design+</TITLE>
  </HEAD>
	<body class="necron">
    <h1 style='text-align: center;'> <?php echo  "Spent : " . $_SESSION['spent']; ?> </h1></h1>
    <div class="list_vaisseau">
      <ul>
        <li>
        </br > 
        <h2>Oberon Battleship</h2>
        <div>
          <img src="http://wh40k.lexicanum.com/mediawiki/images/6/6d/OberonClassBattleship.JPG">
        </div>
        <p>The Oberon was designed to be able to deal with any threat, and therefore does not need to be escorted by a squadron of frigates.
         It lacks the swarming effect of the Emperor Class Battleship's attack craft, or the sheer amount of firepower that the Retribution or Apocalypse Class Battleships can deliver.
          The Oberon can, however, deliver a combined attack of ordnance, lances and weapons batteries, that the others cannot.
        </p>
        </br>
        <?php 
        if ($_SESSION['Points'] - $_SESSION['spent'] >= 300)
                {
        ?>
        <form action="Imperium.php" method="POST">
        <button type="submit" name="submit" value="add_Oberon">ADD: 300 Points</button>
        </form>
        <?php
                }
        ?>
        </br>
        </li>
        <li>
                <h2>Exorcist-class Grand Cruiser</h2>
        <div>
          <img src="http://vignette1.wikia.nocookie.net/warhammer40k/images/0/06/Vengance_Class_Grand_Cruiser.jpg/revision/latest?cb=20110719060347">
        </div>
        <p>The Exorcist was originally developed for long range patrols, capable of extended self sufficiency. 
        Operating with a handful of Escorts, Exorcists brought the Imperial flag to far-flung corners of the galaxy. 
        However, over the millennia the Exorcist has been replaced by ships such as the Mars-class Battlecruiser, though some were kept on in reserve fleets or requisitioned for long patrols. 
        This falling out of favour has meant that many Exorcists have ended up in the hands of Rogue Traders, who find their self-sufficiency and large hanger bays quite useful for their needs. 
        Beyond the light of the Imperium, a vessel capable of long cruises and able to defend itself is quite useful, and the rugged Exorcist fits the bill well.
        Some of the Exorcists were kept on by fleets on the fringes of the Imperium, to plough the long lonely patrol routes into the galactic halo. Many Exorcists were used as colonial transports.
        The entire penal colony of Brandt 764 was moved en masse by Exorcist Grand Cruisers to populate and work Tora Alpha, a world beyond the Eastern Fringe, discovered by (and named after) the famous Rogue Trader Foulway Tor.
        The Exorcist squadron, led by the starship named the Light of Ascension, was then used as convoy escorts for the ore transports returning to the Imperium,
        and played a major part in the defence of the star system when it was attacked and eventually overrun by a Tyranid Hive Fleet.
        </p>
        </br>
        <?php 
        if ($_SESSION['Points'] - $_SESSION['spent'] >= 100)
                {
        ?>
        <form action="Imperium.php" method="POST">
        <button type="submit" name="submit" value="add_Exorcist">ADD: 100 Points</button>
        </form>
        <?php
                }
        ?>
        </li>
        <li>
        <h2>Firestorm Frigate</h2>
        <div>
          <img src="http://wh40k.lexicanum.com/mediawiki/images/1/11/FirestormFrigate.jpg">
        </div>
        <p>It is not uncommon to see a squadron of Firestorms supporting independent squadrons of Swords and Cobra Class Destroyers.
         In situations like these, it falls to the Firestorms to deal damage to capital ships, and rival escorts once the other two classes have lowered the enemy's shields. 
         Firestorm Class Frigates are often seen fighting alongside Space Marine formations. Pirate fleets are known to operate Firestorm Frigates as well.
        </p>
        </br>
        <?php 
        if ($_SESSION['Points'] - $_SESSION['spent'] >= 50)
                {
        ?>
        <form action="Imperium.php" method="POST">
        <button type="submit" name="submit" value="add_Firestorm">ADD: 50 Points</button>
        </form>
        <?php
                }
        ?>
        </li>
      </ul>

    </div>
	</body>
</HTML>