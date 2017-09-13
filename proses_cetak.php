<?php

    include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
        exit;
    }elseif ($_SESSION['user'] == 'admin') {
        die("Anda bukan user! <br>
        <a href='javascript:history.back()''>Back</a>");
    }

    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    
    $sql_vio = mysql_query("SELECT * FROM violation_data WHERE uname='$user' && pass='$pass'");
    $pelanggaran = mysql_fetch_assoc($sql_vio);
    $id = $pelanggaran['tag_id'];
    $ket = $pelanggaran['keterangan'];

    $sql_vehic = mysql_query("SELECT * FROM vehicle_data WHERE tag_id='$id'");
    $kendaraan = mysql_fetch_assoc($sql_vehic);
    
            /* $encode = base64_encode($id);
            $decode = base64_decode($encode);

            function random($panjang)
            {
                $karakter = '$id';
                $karakter .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $string = '';
                for ($i = 0; $i < $panjang; $i++) {
                    $pos = rand(0, strlen($karakter)-1);
                    $string .= $karakter{$pos};
                }
                return $string;
            }
            //cara memanggilnya
            $password = random(5);
            $no_resi = random(8); */

            /* function random($muncul){
                if($muncul == '4'){
                    $random = rand(1111,9999); //*Acak angka 1111 - 9999 menampilkan 4 angka
                }elseif($muncul == '3'){
                    $random = rand(111,999); //*Acak angka 111 - 999 menampilkan 3 angka<br />
                }elseif($muncul == '2'){
                    $random = rand(11,99); //* menampilkan 2 angka
                }else{
                    $random = "Random belum di setting";
                }
                    return $random;
            }
            $pass = random(4); */

	        function random_password($length) {
	        	$chars = '$id';
			    $chars .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			    $password = substr(str_shuffle($chars), 0, $length);
			    return $password;
			}

			$password = random_password(5);
			$no_resi = random_password(8);

            $exp_bayar = gmdate('Y-m-d H:i:s', time()+60*60*7+60*60*24*7);
            $sql = mysql_query("UPDATE violation_data SET no_resi='$no_resi', keterangan='1', batas_bayar='$exp_bayar' WHERE uname='$user' AND pass='$pass'");
            $pesan = "Nomor pembayaran anda $no_resi. Mohon untuk melakukan pembayaran di Bank BRI sebesar Rp 100.000,- sblm $exp_bayar.";
            $query=mysql_query("INSERT INTO outbox (DestinationNumber,TextDecoded,RelativeValidity,CreatorID) VALUES ('".$kendaraan['no_hp']."', '".$pesan."', '255', 'Gammu')");
            if ($sql) {
                echo "<script>window.location='cetak.php?tag_id=$kendaraan[tag_id]'</script>";
                //echo "<script>alert('Berhasil! $no_resi')</script>";
            }else
                echo "<script>alert('Error!')</script>";
    ?>