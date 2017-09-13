<?php
	echo date("Y-m-d H:i:s");
	echo "<br>";
	echo gmdate("Y-m-d H:i:s", time()+60*60*7);
	echo "<br>";
	echo gmdate("Y-m-d H:i:s");
	echo "<br>";
	//detik, menit, jam
	$waktu = gmdate('Y-m-d H:i:s', time()+60*60*7);
	$waktu1 = gmdate('Y-m-d H:i:s', time()+60*60*7+60*2);
	echo $waktu." & ".$waktu1;
?>