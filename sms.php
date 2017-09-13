<form method="post">
<label>No HP Format +62xxxxxxx </label>
<input type="text" name="nohp">
<label>Pesan</label>
<input type="text" name="pesan">
<input type="submit" name="button" value="Kirim">
</form>
<?php
if(isset($_POST['button']))
{
    $con = mysql_connect("localhost","teeepisc_rei","laststand12!@");
    if (!$con) {
		die("Not Connected!");
		mysql_close($con);
	}
    $my_db = mysql_select_db("teeepisc_ativiator");
    if (!$my_db) {
		die("Can't connect to selected Database!");
	}
    //include 'koneksi.php';
    $creator = "Gammu";
    $rel = '255';
    $query=mysql_query("INSERT INTO outbox (DestinationNumber,TextDecoded,RelativeValidity,CreatorID) VALUES ('".$_POST['nohp']."', '".$_POST['pesan']."', '".$rel."', '".$creator."')");
    if($query)
    {
        echo "<script>alert('Sukses kirim sms')</script>";
    }else
    	echo "<script>alert('Gagal kirim sms')</script>";
}
?>