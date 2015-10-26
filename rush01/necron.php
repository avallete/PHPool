<?php
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        if (!array_key_exists('spent', $_SESSION))
            $_SESSION['spent'] = 0;
        if (isset($_POST['submit'])){
            switch ($_POST['submit']) {
                case 'add_Cairn-class':
                    $_SESSION['ships'][] = 'Cairn';
                    $_SESSION['spent'] += 300;
                    break;
                case 'add_Jackal':
                    $_SESSION['ships'][] = 'Jackal';
                    $_SESSION['spent'] += 100;
                    break;
                case 'add_Shroud':
                    $_SESSION['ships'][] = 'Shroud';
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
    <h1 style='text-align: center;'> 
    <?php echo  "Spent : " . $_SESSION['spent']; ?> </h1>
    <div class="list_vaisseau">
      <ul>
        <li>
        </br > 
        <h2> Cairn-class Tomb Ship</h2>
        <div>
          <img src="http://wh40k-fr.lexicanum.com/mediawiki/images/9/92/Vaisseau-Tombe_Cairn.jpg">
        </div>
        <p>De toute la Flotte Nécron, les Vaisseaux-Tombes de classe Cairn sont les plus imposants. Ces vaisseaux sont terriblement bien armés et peuvent faire face a n'importe quel autres vaisseaux de la Flotte Impériale. Pour une raison encore inconnue, les Vaisseaux-Tombes ne sont pas constamment présent dans une flotte Nécron, et n'ont été aperçus que très rarement. Sur les sept fois où ils ont été vus, ils faisaient partie d'une flotte de taille importante et étaient escortés par au moins trois Vaisseaux Moissonneurs de classe Scythe. A en juger les rapports impériaux, les Vaisseaux-Tombes seraient tous construit sur le même modèle et aucune source fiable n'indique d'autre classe hormis la classe Cairn.
        </p>
        </br>
        <?php 
        if ($_SESSION['Points'] - $_SESSION['spent'] >= 300)
                {
        ?>
        <form action="necron.php" method="POST">
        <button type="submit" name="submit" value="add_Cairn-class">ADD: 300 Points</button>
        </form>
        <?php
                }
        ?>
        </br>
        </li>
        <li>
                <h2> Raider Jackal</h2>
        <div>
          <img src="http://wh40k-fr.lexicanum.com/mediawiki/images/8/89/Raider_Jackal.jpg">
        </div>
        <p>Le Jackal est équivalent à un Escorteur Impérial au niveau de ça taille. Ce petit vaisseau est toujours présent dans une Flotte Nécron en quantité importante et n'a été observé que très rarement seul, car il se pourrait qu'il soit contrôlé par des Vaisseaux-Tombes ou des Vaisseaux Moissonneurs. Sur les deux types d'escorteurs Nécron rencontré à ce jour, le Jackal est la plus grand. L'autre étant le Dirge. 
        </p>
        </br>
        <?php if ($_SESSION['Points'] - $_SESSION['spent'] >= 100)
                {
        ?>
        <form action="necron.php" method="POST">
        <button type="submit" name="submit" value="add_Jackal">ADD: 100 Points</button>
        </form>
        <?php
                }
        ?>
        </li>
                <li>
                <h2> Night Shroud</h2>
        <div>
          <img src="http://vignette1.wikia.nocookie.net/warhammer40k/images/5/59/Doomscythe1.jpg/revision/latest?cb=20130402064458">
        </div>
        <p>Le Night Shroud est un bombardier de taille un peu plus grande que le Faucheur et le Moissonneur, aux côtés desquelles il opère. Ses origines remontent à la bataille de la Guerre Céleste, il y a d'innombrables éons. 
            Il fut construit pour transporter une relique de cet ancien conflit apocalyptique; la Sphère de la Mort. 
        </p>
        </br>
        <?php if ($_SESSION['Points'] - $_SESSION['spent'] >= 50)
                {
        ?>
        <form action="necron.php" method="POST">
        <button type="submit" name="submit" value="add_Shroud">ADD: 50 Points</button>
        </form>
        <?php
                }
        ?>
        </li>
      </ul>

    </div>
	</body>
</HTML>