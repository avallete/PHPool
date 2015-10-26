<?php
if (session_status() == PHP_SESSION_NONE)
	session_start();
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
  <div id="board">
	<?php
    function one_line(){

      for ($i = 0; $i < 150; $i++)
      {
        echo '<div id="x' . $i . '" style="float: left; border: 1px solid rgba(255,255,255,.1); background-color: #34495e; width:10px; height:10px"></div>';
      }

    }
    for ($i = 0; $i < 100; $i++)
    {
      echo '<div id="y' . $i . '"style="width:1800px;">';
        one_line();
      echo '</div>';
    }
  ?>
  </div>
	</body>
</HTML>
