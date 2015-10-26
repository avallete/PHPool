<?php
	include 'header.php';
	include 'items.php';

	function 	get_categorie_items()
	{
		if (isset($_SESSION['categories']))
		{
			if ($_SESSION['categories'] == 'all')
				return (get_database());
			else
			{
				$ret = array();
				$db = get_database();
				foreach($db as $obj)
				{
					$clist = array_filter(explode(' ', $obj['categories']));
					if (in_array($_SESSION['categories'], $clist))
						array_push($ret, $obj);
				}
				return $ret;
			}
		}
	}
	function 	create_itemdiv()
	{
		$str = NULL;
		$list = get_categorie_items();
		foreach($list as $obj)
		{
			$new = '<div class="item_index"><img src="'.$obj['location'].'"><p>'.$obj['name'].'</p><p>'.number_format ( $obj['price'] , 2 , "," , " " ).' $</p><p>'.$obj['description'].'</p>';
			if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
				$new = $new.'<p>id: '.$obj['id'].'</p>';
			$new = $new.
			'<form action="cart.php" method="POST">
			<input type="hidden" name="id" value="'.$obj['id'].'">
			<input type="number" min="0" name="nb">
			<button style="margin-top:10px;" type="submit" name="submit" value="add_o" id="add_to_cart">Add to cart</button>
			</form></div>';
			$str = $str.'<br/>'.$new;
		}
		return ($str);
	}
	function 	set_categorie()
	{
		if (isset($_POST['submit']) && $_POST['submit'] == 'set')
			$_SESSION['categories'] = $_POST['categories'];
		else
			$_SESSION['categories'] = 'all';
	}
	function 	categorie_list()
	{
		$list = array();
		$db = get_database();
		$list[] = "all";
		foreach ($db as $obj)
		{
			$cats = array_filter(explode(' ', $obj['categories']));
			foreach($cats as $c)
			{
				if (!(in_array($c, $list)))
					array_push($list, $c);
			}
		}
		return ($list);
	}
	function 	display_categorie()
	{
		$list = categorie_list();
		foreach ($list as $obj)
		{
			print '<option value="'.$obj.'">'.$obj.'</option>';
		}
	}
	set_categorie();
?>
<html>
<body>
	<div>
		<div style='margin-left:15px;margin-top:125px'>
		<form action="shop.php" method="POST">
       <label for="categories">Categories</label><br />
       <select style='width:150px;' name="categories" id="country">
       <?=display_categorie();?>
       </select>
       <input type='submit' name='submit' value='set'>
       </form>
		<p><?=create_itemdiv();?></p>
		</div>
	</div>
</body>
</html>
