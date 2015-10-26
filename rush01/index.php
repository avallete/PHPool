<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	if (isset($_POST['submit'])){
		switch ($_POST['submit']) {
			case '500':
				$_SESSION['Points'] = 500;
				break;
			case '1000':
				$_SESSION['Points'] = 1000;
				break;
			case '1500':
				$_SESSION['Points'] = 1500;
				break;
			case 'Necron':
				$_SESSION['Army'] = 'Necron';
				header("Location: necron.php");
				break;
			case 'Tau':
				$_SESSION['Army'] = 'Tau';
				header("Location: tau.php");
				break;
			case 'Imperium':
				$_SESSION['Army'] = 'Imperium';
				header("Location: Imperium.php");
				break;
			default:
				break;
		}
	}
?>
<HTML>
  <HEAD>
    <META charset="utf-8" />
        <link rel="stylesheet" href="font-awesome.min.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" type="text/css" href="class.css" />
    <TITLE>Design+</TITLE>
  </HEAD>
	<body>
	<div class="banner">
		<img class="banner" src="http://vignette1.wikia.nocookie.net/warhammer40k/images/6/66/Title_warhammer_2.png/revision/latest?cb=20110802232935">
		<?php if (!isset($_SESSION['Points']))
				{
		?>
		<form action="index.php" method="POST">
        	<button type="submit" name="submit" value="500">500 Points</button>
        	<button type="submit" name="submit" value="1000">1000 Points</button>
        	<button type="submit" name="submit" value="1500">1500 Points</button>
        </form>	
        <?php
    		}
        	else
        	{
        ?>
        <form action="index.php" method="POST">
        	<button type="submit" name="submit" value="Necron">Necrons</button>
        	<button type="submit" name="submit" value="Tau">Tau</button>
        	<button type="submit" name="submit" value="Imperium">Imperium</button>
        </form>		
        <?php
        	}
        ?>
	</div>

	</body>
</HTML>
