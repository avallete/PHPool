#!/usr/bin/php
<?PHP
	function	filter_all($site, $addr)
	{
		$valid = array();
		preg_match_all("#<img.*? src\s*=\s*[\"'](.*?)[\"'].*?>?#mi", $site, $img);
		foreach ($img[1] as $s)
		{
			if (!(preg_match("#^(https?)://*#mi", $s)))
			{
				if ($s[0] == '/')
					array_push($valid, $addr.$s);
				else
					array_push($valid, $addr.'/'.$s);
			}
			else
				array_push($valid, $s);
		}
		return ($valid);
	}
	function 	down_img($srclink, $dst)
	{
		$ch = curl_init($srclink);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		if (file_exists($dst) === FALSE)
		{
			$fp = fopen($dst, 'x');
			fwrite($fp, $data);
			fclose($fp);
		}
	}
	function 	download_all($tab, $dirname)
	{
		if (file_exists($dirname) === FALSE)
			@mkdir($dirname);
		foreach ($tab as $s)
		{
			$dst = $dirname.'/'.end(explode('/', $s));
			down_img($s, $dst);
		}
	}
	if ($argc == 2)
	{
		$dirname = preg_replace("#https?://#", "", $argv[1]);
		$dirname = array_filter(explode('/', $dirname));
		$dirname = $dirname[0];
		$cu = curl_init($argv[1]);
		if ($cu !== FALSE)
		{
			curl_setopt($cu, CURLOPT_URL, $argv[1]);
			curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
			if ($site = @curl_exec($cu))
			{
				$tab = filter_all($site, $argv[1]);
				download_all($tab, $dirname);
				curl_close($cu);
			}
		}
	}
?>
