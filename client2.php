<HTML>
    <head>
        <meta http-equiv="refresh" content="60">
    </head>
</HTML>
<?php
	require_once('lib/nusoap.php');
	/* $client = new soapclient( "http://etilang.te-eepis.com/server2.php " );
	$data = $client -> call('hello');
	echo $data; */

    // baca key
    $key = 'o';
    // instansiasi obyek untuk class nusoap client, arahkan URL ke script server.php di server A
    $client = new soapclient('http://etilang.te-eepis.com/server.php');
    // proses call method 'search' dengan parameter key di script server.php yang ada di server A
    $result = $client->call('search', array('key' => $key));
    // jika data hasil $result ada, maka tampilkan
    if (is_array($result)){
		mysql_connect('localhost', 'root', '');
     	mysql_select_db('pensemc1_dbrei');
		
		foreach($result as $data){
            //$result[] = array('nim' => $data['nim'], 'nama' => $data['nama'], 'alamat' => $data['alamat']);
            //$result[] = array('DestinationNumber' => $data['DestinationNumber'], 'TextDecoded' => $data['TextDecoded'], 'RelativeValidity' => $data['RelativeValidity'], 'CreatorID' => $data['CreatorID']);
            $ins = mysql_query("INSERT INTO outbox SET DestinationNumber='$data[DestinationNumber]',TextDecoded='$data[TextDecoded]',RelativeValidity='$data[RelativeValidity]',CreatorID='$data[CreatorID]'");
			//$ins = mysql_query("INSERT INTO mahasiswa SET nim='$data[nim]',nama='$data[nama]',alamat='$data[alamat]'");
        }
    }
?>