<?php
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        if (!array_key_exists('spent', $_SESSION))
            $_SESSION['spent'] = 0;
        if (isset($_POST['submit'])){
            switch ($_POST['submit']) {
                case 'add_Ore':
                    $_SESSION['ships'][] = 'Ore';
                    $_SESSION['spent'] += 300;
                    break;
                case 'add_Porrui':
                    $_SESSION['ships'][] = 'Porrui';
                    $_SESSION['spent'] += 100;
                    break;
                case 'add_Tiger':
                    $_SESSION['ships'][] = 'Tiger';
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
        <h2>Or'es El'leath Class Battleship</h2>
        <div>
          <img src="http://i57.servimg.com/u/f57/16/63/10/54/517.jpg">
        </div>
        <p>The Or'es El'leath class battleship is the largest ship of the Kor'Or'Vesh, the newest generation of Tau ships.
         Also named the Custodian it retains the heavy carrier ability of its predecessor, the Gal'leath, and adds an array of port and starboard Railgun Batteries and Ion Cannons,
          has improved engine output and shielding capabilities and sports Deflector technology which significantly improves the armour value of the prow.
        </p>
        </br>
        <?php
          if ($_SESSION['Points'] - $_SESSION['spent'] >= 300)
                {
        ?>
        <form action="tau.php" method="POST">
        <button type="submit" name="submit" value="add_Ore">ADD: 300 Points</button>
        </form>
        <?php
                }
        ?>
        </br>
        </li>
        <li>
                <h2>Il'Porrui Class Cruiser</h2>
        <div>
          <img src="http://img4.wikia.nocookie.net/__cb20121103025521/warhammer40k/images/6/6a/Manta9.jpg">
        </div>
        <p>The Il'Porrui Class Cruiser (also known as the Emissary) is the first vessel created for the renovation of the Tau Fleet.
         It was designed primarily for transport for Water Caste dignitaries, Tau Commanders and Ethereals, and secondly for battle. 
         They are also used as large merchant vessels. Despite its size, the Emissary is well equipped and perfectly capable of looking after itself against all but the largest capital ships.
          These ships are now becoming common within the Tau Empire. As this class was the first of the renovation program and their versatile role, their number may increase in the Kor'vattra.
        </p>
        </br>
        <?php
          if ($_SESSION['Points'] - $_SESSION['spent'] >= 100)
                {
        ?>
        <form action="tau.php" method="POST">
        <button type="submit" name="submit" value="add_Porrui">ADD: 100 Points</button>
        </form>
        <?php
                }
        ?>
        </li>
        <li>
                <h2>Tiger Shark</h2>
        <div>
          <img src="http://wh40k.lexicanum.com/mediawiki/images/2/28/TigerSharkArt.jpg">
        </div>
        <p>The Tiger Shark is usually encountered flying in support of Tau Hunter Cadres during major operations,
         it is faster and more manoeuvrable than the Imperium's direct equivalent - the Marauder Bomber - but lacks the large bomb payload.
        </p>
        </br>
        <?php
          if ($_SESSION['Points'] - $_SESSION['spent'] >= 50)
                {
        ?>
        <form action="tau.php" method="POST">
        <button type="submit" name="submit" value="add_Tiger">ADD: 100 Points</button>
        </form>
        <?php
                }
        ?>
        </li>
      </ul>

    </div>
	</body>
</HTML>