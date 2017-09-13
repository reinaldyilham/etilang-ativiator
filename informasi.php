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
    $sql_vio = mysql_query("SELECT * FROM violation_data WHERE uname='$user'");
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

    <title>ATIVIATOR - Informasi</title>
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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only"></span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.php">ATIVIATOR</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php 
                        echo "<a href='index.php?tag_id=$kendaraan[tag_id]'>Data Pelanggar</a>";
                        ?>
                    </li>
                    <li>
                        <?php 
                        echo "<a href='informasi.php?tag_id=$kendaraan[tag_id]'>Informasi Pelanggaran</a>";
                        ?>
                    </li>
                    <li>
                        <a href="logout.php">Change User</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Informasi Pelanggaran</h1>
                        <hr class="small">
                        <span class="subheading">Berisikan informasi mengenai pelanggaran yang terjadi.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            ID Pelanggaran :
                            <?php echo $kendaraan['tag_id'];?><br><hr>
                        </h3>
                    </a>
                </div>
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            Nama 
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : 
                            <?php echo $kendaraan['nama'];?><br><hr>
                        </h3>
                    </a>
                </div>
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            No. Telepon 
                            &nbsp&nbsp&nbsp&nbsp&nbsp :
                            <?php echo $kendaraan['no_hp'];?><br><hr>
                        </h3>
                    </a>
                </div>
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            No. Polisi 
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp :
                            <?php echo $kendaraan['nomer_polisi'];?><br><hr>
                        </h3>
                    </a>
                </div>
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            No. STNK 
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp :
                            <?php echo $kendaraan['nomer_stnk'];?><br><hr>
                        </h3>
                    </a>
                </div>
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            Lokasi &nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $pelanggaran['lokasi'];?><br><hr>
                        </h3>
                    </a>
                </div>
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            Waktu 
                            &nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $pelanggaran['waktu'];?><br><hr>
                        </h3>
                    </a>
                </div>

                <!-- Pager
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul-->
                <div class="row">
                    <div class="form-group col-xs-12">
                        <form method="post" action="proses_cetak.php">
                            <!--button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Cetak</button-->
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" <?php 
                                $waktu_skr = gmdate('Y-m-d H:i:s', time()+60*60*7);
                                if ($ket == '1' || $waktu_skr >= $pelanggaran['waktu']) { ?> disabled
                                <?php
                                    }
                                ?>>Cetak</button>
                            <!--input type="submit" class="btn btn-default" value="Cetak" name="cetak"<?php 
                                if ($ket == '1') { ?> disabled
                                <?php
                                    }
                                ?>-->

                <!-- Bootstrap Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Konfirmasi</h4>
                            </div>
                            
                            <div class="modal-body">
                                <p>Apakah anda yakin untuk mencetak nomor pembayaran denda?</p>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger" name="cetak">Ya</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>

                            <!--input type="button" value="Add to Cart" <?php if ($prod_qty == '0'){ ?> disabled <?php   } ?> onclick="addtocart(<?php echo $row["prod_id"]?>)" /-->
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                <?php
                    if ($pelanggaran['lokasi'] == 'prapen') {
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7914.708747764613!2d112.75440562210453!3d-7.314028428885434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb030a29e83b%3A0xbbb3ca3a38d35eec!2sPrapen%2C+Tenggilis+Mejoyo%2C+Surabaya+City%2C+East+Java!5e0!3m2!1sen!2sid!4v1497685317001" width="1175" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
                    }elseif ($pelanggaran['lokasi'] == 'kertajaya') {
                        echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7915.268453006762!2d112.75174767210383!3d-7.282392528974869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbc943266e4f%3A0x60f872fa7b33ed2b!2sKertajaya%2C+Gubeng%2C+Surabaya+City%2C+East+Java!5e0!3m2!1sen!2sid!4v1497685543198" width="1175" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
                    }
                ?>
        </div>
    </div>

    <hr>
    <?php
        /* if (isset($_POST['cetak'])) {
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
                WHERE tag_id = '$id')"); *

            $waktu_exp = gmdate('Y-m-d H:i:s', time()+60*60*7+60*2);
            $sql = mysql_query("UPDATE violation_data SET no_resi='$no_resi', keterangan='1', batas_waktu='$waktu_exp' WHERE tag_id='$id'");
            if ($sql) {
                echo "<script>window.location='cetak.php?tag_id=$kendaraan[tag_id]'</script>";
                //echo "<script>alert('Berhasil! $no_resi')</script>";
            }else
                echo "<script>alert('Error!')</script>";

            /* $pesan = "Nomor pembayaran anda $no_resi. Mohon untuk melakukan pembayaran di Bank BRI.";
            $query=mysql_query("INSERT INTO outbox (DestinationNumber,TextDecoded,RelativeValidity,CreatorID) VALUES ('".$kendaraan['no_hp']."', '".$pesan."', '255', 'Gammu')"); */
            /* if($query){
                echo "<script>alert('Sukses kirim sms')</script>";
            } *
        } */
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

    <!--script type="text/javascript">
        var auto_refresh = setInterval(
        function () {
           $('#load_content').load('informasi.php').fadeIn("slow");
        }, 10000); // refresh setiap 10000 milliseconds
    
    </script>
    <div id="load_content"></div-->
</body>

</html>
