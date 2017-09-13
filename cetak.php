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

    //include 'koneksi.php';
    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    
    //tampilkan data
    $sql_vio = mysql_query("SELECT * FROM violation_data WHERE uname='$user' && pass='$pass'");
    $pelanggaran = mysql_fetch_assoc($sql_vio);
    $id = $pelanggaran['tag_id'];
    $ket = $pelanggaran['keterangan'];

    //$sql = mysql_query("SELECT * FROM vehicle_data ORDER BY tag_id DESC LIMIT 1");
    $sql_vehic = mysql_query("SELECT * FROM vehicle_data WHERE tag_id='$id'");
    $kendaraan = mysql_fetch_assoc($sql_vehic);

    /* $waktu_skr = gmdate('Y-m-d H:i:s', time()+60*60*7);
    if ($waktu_skr >= $pelanggaran['batas_waktu']) {
        $val = 'Expired';
    } */
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ATIVIATOR - Cetak</title>
    <link rel="icon" type="image/png" href="img/av.png">

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Main Content -->
    <div class="container">
        <div class="row">   
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <h2 class="intro-text text-center"><strong>Pemberitahuan</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <?php echo $pelanggaran['batas_waktu'];?>
                    Sukses! Nomor pembayaran denda anda <?php echo $pelanggaran['no_resi'];?>. Segera lakukan 
                    pembayaran sebelum <?php echo $pelanggaran['batas_bayar'];?>.
                    <div class="modal-footer">
                        <form method="post">
                            <input type="submit" class="btn btn-danger" name="cetak" value="Kembali" onclick="history.back(-1)">
                            <!--button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button-->
                        </form>
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>

            <hr>
        </div>
    </div>

    <!-- Bootstrap Modal -->
                <!--div id="myModal" class="modal fade" role="dialog" tabindex="-1">
                    <div class="modal-dialog">
                        
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Pemberitahuan</h4>
                            </div>
                            
                            <div class="modal-body">
                                <p>Sukses! Nomor pembayaran anda <?php echo $pelanggaran['no_resi'];?></p>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" name="cetak">Ya</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div-->

    <hr>

    <?php
        if (isset($_POST['cetak'])) {
            $encode = base64_encode($id);
            $decode = base64_decode($encode);

            function random($panjang)
            {
                $karakter= '$id';
                $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $string = '';
                for ($i = 0; $i < $panjang; $i++) {
                    $pos = rand(0, strlen($karakter)-1);
                    $string .= $karakter{$pos};
                }
                return $string;
            }
            //cara memanggilnya
            $password = random(5);
            $no_resi = random(8);

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

            //echo "<script>alert('$id $encode $decode $password $no_resi')</script>";
            /* $sql = mysql_query("INSERT INTO user_data SET uname='$encode', pass='$password', no_resi='$no_resi', keterangan='1', tag_id = (
                SELECT tag_id
                FROM vehicle_data
                WHERE tag_id = '$id')"); */
            /* $sql = mysql_query("INSERT INTO user_data SET no_resi='$no_resi', keterangan='1', tag_id = (
                SELECT tag_id
                FROM vehicle_data
                WHERE tag_id = '$id')"); */

            $waktu_exp = gmdate('Y-m-d H:i:s', time()+60*60*7+60*2);
            //$sql = mysql_query("UPDATE violation_data SET no_resi='$no_resi', keterangan='1', batas_waktu='$waktu_exp' WHERE tag_id='$id'");
            /* if ($sql) {
                echo '<script>$("#myModal").modal("show");</script>';
            } */

            /* $pesan = "Nomor pembayaran anda $no_resi. Mohon untuk melakukan pembayaran di Bank BRI.";
            //$query=mysql_query("INSERT INTO outbox (DestinationNumber,TextDecoded,RelativeValidity,CreatorID) VALUES ('".$kendaraan['no_hp']."', '".$pesan."', '255', 'Gammu')"); */
            /* if($query){
                echo "<script>alert('Sukses kirim sms')</script>";
            } */
        }
    ?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="http://twitter.com/ativiator/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.facebook.com/ativiator/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="http://instagram.com/ativiator/">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; EMC Laboratory 2017</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
