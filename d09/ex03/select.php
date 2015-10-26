<?php
$ret = array();
if ($fd = fopen('list.csv', 'r'))
{
	while ($db = fgetcsv($fd, 0, ';'))
		$ret[$db[0]] = $db[1];
	fclose($fd);
}
echo json_encode($ret);
?>