<?php
include 'koneksi.php';


if(isset($_POST['add']))
{
    $conn = mysql_connect('localhost', $dbuser, $dbpass) or die ('Error connecting to mysql');
	if(! $conn )
	{
	  die('Could not connect: ' . mysql_error());
	}
	
	if(! get_magic_quotes_gpc() )
	{
	   $tag_id = addslashes ($_POST['tag_id']);
	   $date_time = addslashes ($_POST['waktu']);
	   $lokasi = addslashes ($_POST['lokasi']);
	   $id_pelanggaran = ''; 
	}
	else
	{
		$tag_id = $_POST['tag_id'];
		$date_time = $_POST['waktu'];
		$lokasi = $_POST['lokasi'];
		$id_pelanggaran = '';
	}

	function random_password($length) {
	    $chars = '$id';
		$chars .= "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr(str_shuffle($chars), 0, $length);
		return $password;
	}
	$pass = random_password(5);
}

	$sql_vehic = mysql_query("SELECT * FROM vehicle_data WHERE tag_id='$tag_id'");
	$kendaraan = mysql_fetch_assoc($sql_vehic);
	$tag = $kendaraan['tag_id'];
	$hp = $kendaraan['no_hp'];
	
	$exp_login = gmdate('Y-m-d H:i:s', time()+60*60*7+60*60*24*2);
	$pesan = "Anda tlh melanggar lampu lalu lintas. Masukkan usrname=$tag_id dan pass=$pass pd etilang.te-eepis.com utk mndptkan nmr pmbayaran denda sblm $exp_login.";
	
	$sql = "INSERT INTO violation_data (tag_id, waktu, lokasi, uname, pass, batas_login) VALUES ('$tag_id','$date_time', '$lokasi', '$tag_id', '$pass', '$exp_login')";
	//$sql = "INSERT INTO violation_data (tag_id, waktu, lokasi, uname, pass) VALUES ('$tag_id','$date_time', '$lokasi', '$tag_id', '$pass')";
	
	$sql1 = "INSERT INTO outbox (DestinationNumber,TextDecoded,RelativeValidity,CreatorID) VALUES ('".$hp."', '".$pesan."', '255', 'Gammu')";
    
	mysql_select_db($dbname);
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	$retval = mysql_query( $sql1, $conn );
	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	echo "Success...\n";
	mysql_close($conn);

?>