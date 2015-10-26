<?PHP
if (session_status() == PHP_SESSION_NONE)
	session_start();
	$_SESSION['log_on_user'] = NULL;
	$_SESSION['cart'] = NULL;
	$_SESSION['admin'] = 0;
	function iget_database()
	{
		$ret = array();
		if (file_exists('../private/bde.csv'))
		{
			if ($fd = fopen('../private/bde.csv', 'r'))
			{
				if (flock($fd, LOCK_SH | LOCK_NB))
				{
					while ($db = fgetcsv($fd, 0, ';'))
						$ret[$db[5]] = ['location' => $db[0], 'categories' => $db[1], 'name' => $db[2], 'price' => $db[3], 'description' => $db[4], 'id' => $db[5]];
					flock($fd, LOCK_UN);
				}
				fclose($fd);
			}
			return ($ret);
		}
		else
		{
			$ret[0] = ['location' => NULL, 'categories' => NULL, 'name' => NULL, 'price' => NULL, 'description' => NULL];;
			return ($ret);
		}
	}
	function icreate_dbo($location, $categories, $name, $price, $description, $id)
	{
		$categories = implode(' ', array_filter(explode(',', $categories)));
		$dbo = ['location' => $location, 'categories' => $categories, 'name' => $name, 'price' => $price, 'description' => $description, 'id' => $id];
		return $dbo;
	}
	function iadd_database($db, $obj)
	{
		if ($fd = fopen('../private/bde.csv', 'a+'))
		{
			fputcsv($fd, $obj, ';');
			flock($fd, LOCK_UN);
			fclose($fd);
		}
	}
	function 	iaccount_create($mail, $passwd)
	{
		if (!(file_exists('../private/passwd')))
			touch('../private/passwd');
		if ($filecontent = file_get_contents('../private/passwd'))
		{
			$db = unserialize($filecontent);
			foreach ($db as $k)
			{
				if ($k['mail'] == $mail)
				{
					$_POST['mail'] = "'Username already used'"; 
				 	return false;
				 }
			}
		}
		$account = [];
		$account['mail'] = $mail;
		$account['passwd'] = hash('whirlpool', $passwd);
		$account['admin'] = 0;
		$db[] = $account;
		file_put_contents('../private/passwd', serialize($db));
		return true;
	}
	if (file_exists('../private/passwd'))
		unlink('../private/passwd');
	if (file_exists('../private/bde.csv'))
		unlink('../private/bde.csv');
	if (file_exists('../private/cmd'))
		unlink('../private/cmd');
	if (!(file_exists('../private')))
		mkdir('../private');
	if (!(file_exists('../private/bde.csv')))
		touch('../private/bde.csv');
	if (!(file_exists('../private/passwd')))
		touch('../private/passwd');
	if (!(file_exists('../private/cmd')))
		touch('../private/cmd');
	iaccount_create('root@gmail.com', 'root');
	iaccount_create('user@gmail.com', 'user');
	$filecontent = file_get_contents('../private/passwd');
	$db = unserialize($filecontent);
	$db[0]['admin'] = 1;
	file_put_contents('../private/passwd', serialize($db));
	iadd_database(iget_database(), icreate_dbo("https://images.indiegogo.com/file_attachments/1088590/files/20141211023858-shift.gif?1418294338", "gadget,hight-tech,design,music", "Bluetooh levitating speakers", "760", "The Latest Fusion of Music and Design: a Levitating Portable Bluetooth Speaker with Hi-Fi Sound.", "1"));
	iadd_database(iget_database(), icreate_dbo("http://s3-us-west-2.amazonaws.com/tokyoflash/pages/000465/images/vortex_led_watch_smoke_r1.jpg", "gadget,hight-tech,design,gear", "Kisai Vortex LCD Watch", "175", "Kisai Vortex has an animation feature that can be turned on or off. When activated, a spiralling animation will appear once every five minutes.", "2"));
	iadd_database(iget_database(), icreate_dbo("http://o.aolcdn.com/hss/storage/midas/9df9683f1f885ab34510a0112a901243/200839212/pebble1.jpg", "gear,gadget", "Pebble", "179", "Montre de ouf !", "3"));
	iadd_database(iget_database(), icreate_dbo("http://a.tgcdn.net/images/products/frontsquare/htik_mega_man_helmet.gif", "gadget,geek,toy", "Mega Man Helmet", "99", "Every time Mega Man takes out an evil robot, he gains that the use of that robot's weapon. Unfortunately, Mega Man had just beaten Shrinking Man and then used his shrink ray on Mirror Man.", "4"));
	iadd_database(iget_database(), icreate_dbo("http://a.tgcdn.net/images/products/zoom/f2da_mass_effect_exclusive_carnifex.jpg", "geek,toy,gadget,gift", "Mass Effect Carnifex", "399", "Now you can have Carnifex by your side with this full scale replica of the M-6 pistol. The artisans at TriForce have really gone above and beyond with this hand-finished and hand-painted weapon replica. It's absolutely gorgeous and a must-have for cosplayers or video game weapon enthusiasts. You can also grab it when you answer the door if solicitors come calling. However you use it, the M-6 will make an impression.", "5"));
	iadd_database(iget_database(), icreate_dbo("http://a.tgcdn.net/images/products/zoom/181e_black_flash_600_camera.jpg", "gadget,retro,geek", "Impossible Black Flash 600 Camera Kit", "139", "What world the world have been without Polaroids? How would the local grocery store have recognized their Employees of the Month? Outkast's 'Hey Ya!' would make absolutely no sense. And the guy in Memento would be totally lost. It would be madness!", "6"));
	iadd_database(iget_database(), icreate_dbo("http://a.tgcdn.net/images/products/zoom/hrom_solarbotics_perp_motion_kit.jpg", "geek,science,toy", "Solarbotics Perpetual Motion Marble Kit", "39", "Ever since motion was invented, people have wanted to build machines where it never stops. Alas, there are many things which prevent this from happening (which we can sum up in one word: science). BUT, there are a lot of people out in the world who don't know about this science thing, and who will believe anything anyone tells them or sort of shows them. Your job is to get this Solarbotics Perpetual Motion Marble Kit, enjoy putting it together, and then show it to these believers of bunk and convince them you've created perpetual motion. Just for fun.", "7"));
	iadd_database(iget_database(), icreate_dbo("http://a.tgcdn.net/images/products/zoom/1522_captain_jules_useless_box.gif", "geek,toy,funny", "Captain Jules's Useless Box", "40", "Captain Jules travels near and far, hither and yon, searching for the most curious curiosities the world has to offer. Sometimes these things are cursed; sometimes they fight back with poisoned tentacles. But never before has a device captured the good Captain's fancy like this Useless Box. So much so, in fact, that he had us make replicas for you, calling them (quite humbly, we might add) the Captain Jules's Useless Box.", "8"));
	iadd_database(iget_database(), icreate_dbo("http://www.wired.com/wp-content/uploads/2015/04/ebike-inline-582x437.jpg", "Bike,Sport,GPS ", "Stromer ST2 E-Bike", "7000", "The bike automatically launches into Theft Mode. The lights flash, and you can spot the bike on a map using GPS. Theft Mode can also be launched remotely, via the mobile app.", "16"));
	iadd_database(iget_database(), icreate_dbo("http://www.wired.com/wp-content/uploads/2015/04/large_p02.jpg", "Photo,Video,High-Tech,Sport,4K", "DJI Phantom 3 Professional", "1300", "The flying machine—an update to DJI’s previous, popular Phantom drones—comes equipped with an integrated 4K camera mounted on a three-axis gimbal that keeps footage as butter-smooth as it is tack-sharp. In 4K mode, the camera captures at either 24 or 30 frames per second. It also shoots 1080p video at 24, 30, or 60fps.", "17"));
	iadd_database(iget_database(), icreate_dbo("http://www.wired.com/wp-content/uploads/2015/04/XC10_675x450_Front1.jpg", "Photo,Video,High-Tech,4K", "Canon XC10", "2500", "At its highest resolution setting, it captures 3840×2160 video at 30 frames per second. It will also record 1080p clips at up to 60fps, and 720p clips at up to 120fps for those slow-motion sequences. For the Ultra HD video, the camera uses Canon’s proprietary XF-AVC codec, which is also used in its just-announced Cinema EOS C100 Mark II professional camera. Here’s the kicker: That codec supports a bitrate of up to an insane 305Mbps.", "18"));
	header('Location: index.php');
	print "Database SETUP\n";
?>
