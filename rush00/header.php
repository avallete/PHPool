<?php
if (session_status() == PHP_SESSION_NONE)
	session_start();
include 'cart.php';
?>
<HTML>
  <HEAD>
    <META charset="utf-8" />
        <link rel="stylesheet" href="font-awesome.min.css" />
        <link rel="stylesheet" href="style.css" />
    <TITLE>Design+</TITLE>
  </HEAD>
	<body>
		<div class="logs">
		<a href="my_account.php">
		<div id="cart"><br /><i class="fa fa-shopping-cart fa-2x"></i><span >
			<?php print_cart_total(); ?>
			<?php print_cart_nb();
			 ?></span></div></a>
		<?php 
		if (!$_SESSION['log_on_user'])
		{
			?>
		<ul>
			<li class="up_menu_li"><a href="login.php"><i class="fa fa-sign-in"></i> login</a></li>
			<li class="up_menu_li"><a href="create.php">signup</a></li>
		</ul>
		<?php
			}
			else
			{
		?>
			<div id="profil"><span class="test"><?php echo $_SESSION['log_on_user'];?></span><i class="fa fa-user fa-2x"></i> 
				<div class="div_profil">
				<ul>
					<li id="menu_profil"><a href="my_account.php">Mon compte</a></li>
					<li id="menu_profil"><a href="logout.php"><i class="fa fa-power-off fa2x"></i> Deconnexion</a></li>
				</ul>
				</div>
			</div>
		<?php
			}
		?>
		</div>
		<div class="div_desgn"><a href='index.php' id="title_design"><h2>Design+</h2></a></div>
		<nav class="nav_menu">
			<ul>
				<li class="up_menu_li"><a href="acceuil.php">Accueil</a></li>
				<li class="up_menu_li"><a href="shop.php">Shop</a></li>
				<li class="up_menu_li"><a href="about.php">About</a></li>
			</ul>

		</nav>
		<div id="h_bar_midhight"><br /></div>
	</body>
</HTML>
