<?php

    /*mysql_connect('localhost','teeepisc_rei','laststand12!@');
    mysql_select_db('teeepisc_coba');
     // query pencarian data mahasiswa
     $query = "SELECT * FROM mahasiswa WHERE 1";
     $hasil = mysql_query($query);
     while ($data = mysql_fetch_array($hasil))
     {
          // menyimpan data hasil pencarian dalam array
          $result[] = array('nim' => $data['nim'], 'nama' => $data['nama'], 'alamat' => $data['alamat']);
		  $up = mysql_query("update mahasiswa set cek='1' where nim='$data[nim]'");
     }
     // mereturn array hasil pencarian
     print_r($result);
     */
     

    $servername = "localhost";
    $username = "teeepisc_rei";
    $password = "laststand12!@";
    /* $dbname = "teeepisc_coba";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    
    $sql = "SELECT * FROM mahasiswa";
    $result = $conn->query($sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($data = $result->fetch_assoc()) {
            $results[] = array('nim' => $data['nim'], 'nama' => $data['nama'], 'alamat' => $data['alamat']);
            $conn->query("update mahasiswa set cek='1' where nim='".$data['nim']."'");
            echo "update mahasiswa set cek='1' where nim='".$data['nim']."'".'<br/>';
        }
    } else {
        echo "0 results";
    } */
    $dbname = "teeepisc_ativiator";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    
    $sql = "SELECT * FROM outbox";
    $result = $conn->query($sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($data = $result->fetch_assoc()) {
            //$results[] = array('nim' => $data['nim'], 'nama' => $data['nama'], 'alamat' => $data['alamat']);
            $results[] = array('DestinationNumber' => $data['DestinationNumber'], 'TextDecoded' => $data['TextDecoded'], 'RelativeValidity' => $data['RelativeValidity'], 'CreatorID' => $data['CreatorID']);
            //$conn->query("update mahasiswa set cek='1' where nim='".$data['nim']."'");
            //echo "update mahasiswa set cek='1' where nim='".$data['nim']."'".'<br/>';
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    print_r($results);   
?>