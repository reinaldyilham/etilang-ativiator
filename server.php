<?php
require_once('lib/nusoap.php');
$server = new soap_server;
// registrasi method 'search'
$server->register('search');
// detail method 'search' dengan parameter $key
function search($key)
{
    // koneksi ke database
	mysql_connect('localhost', 'teeepisc_rei', 'laststand12!@');
    //mysql_select_db('teeepisc_coba');
    mysql_select_db('teeepisc_ativiator');
    // query pencarian data mahasiswa
    //$query = "SELECT * FROM mahasiswa WHERE cek <> 1";
    $query = "SELECT * FROM outbox WHERE Cek <> 1";
    $hasil = mysql_query($query);
    while ($data = mysql_fetch_array($hasil))
    {
        // menyimpan data hasil pencarian dalam array
        //$result[] = array('nim' => $data['nim'], 'nama' => $data['nama'], 'alamat' => $data['alamat']);
        $result[] = array('DestinationNumber' => $data['DestinationNumber'], 'TextDecoded' => $data['TextDecoded'], 'RelativeValidity' => $data['RelativeValidity'], 'CreatorID' => $data['CreatorID']);
        //$result[] = array('nim' => $data['nim'], 'nama' => $data['nama'], 'alamat' => $data['alamat']);
	    $up = mysql_query("update outbox set Cek='1' where TextDecoded='$data[TextDecoded]'");
    }
     // mereturn array hasil pencarian
     return $result;
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>