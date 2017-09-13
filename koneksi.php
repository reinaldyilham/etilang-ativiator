<?php
	/* $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "pensemc1_dbrei"; */

	$dbhost = "localhost";
    $dbuser = "teeepisc_rei";
    $dbpass = "laststand12!@";
    $dbname = "teeepisc_ativiator";

	$con = mysql_connect($dbhost, $dbuser, $dbpass);
	if (!$con) {
		die("Not Connected!");
		mysql_close($con);
	}
	
	$my_db = mysql_select_db($dbname, $con);
	if (!$my_db) {
		die("Can't connect to selected Database!");
	}
?>