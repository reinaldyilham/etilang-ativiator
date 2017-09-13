<?php
    include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
        exit;
    }elseif ($_SESSION['user'] == 'admin') {
        header('Location:admin.php');
    }

    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];

    $sql_vio = mysql_query("SELECT * FROM violation_data WHERE uname='$user' && pass='$pass'");
    $pelanggaran = mysql_fetch_assoc($sql_vio);
    $id = $pelanggaran['tag_id'];
    $ket = $pelanggaran['keterangan'];

    $sql_vehic = mysql_query("SELECT * FROM vehicle_data WHERE tag_id='$id'");
    $kendaraan = mysql_fetch_assoc($sql_vehic);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ATIVIATOR - Pelanggar</title>
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
                        echo "<a href='index.php?tag_id=$kendaraan[tag_id]'>Informasi Pelanggaran</a>";
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
                        <h1>E-Tilang</h1>
                        <hr class="small">
                        <span class="subheading">Electronic Tilang.<br>Tanpa ribet, hemat waktu.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="box">
    <?php
        $waktu_skr = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $exp_login = gmdate('Y-m-d H:i:s', time()+60*60*7+60*60*24*2);
        if ($pelanggaran['keterangan'] == '1') {
        echo '
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    Mohon maaf, anda telah mencetak nomor pembayaran denda. Silahkan melakukan pembayaran di Bank BRI sebelum '.$pelanggaran['batas_bayar'].'.
                </div>
                <div class="clearfix"></div>
            </div>
            <hr>
        </div>';
        }elseif ($waktu_skr >= $pelanggaran['batas_login']) {
        echo '
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    Mohon maaf, anda tidak dapat mencetak nomor pembayaran dikarenakan melewati masa aktif.<br>
                    Denda pelanggaran lalu lintas yang anda lakukan akan disertakan pada saat pembayaran pajak kendaraan tahunan berikutnya.
                </div>
                <div class="clearfix"></div>
            </div>
            <hr>
        </div>';
        }
    ?>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            ID Pelanggaran : <?php echo $kendaraan['tag_id'];?><br><hr>
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
                            Alamat 
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp :
                            <?php echo $kendaraan['alamat'];?><br><hr>
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
                            Jenis Kendaraan: <?php echo $kendaraan['jenis_kendaraan'];?><br><hr>
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
                <div class="post-preview">
                    <a>
                        <h3 class="post-subtitle">
                            Besar Denda 
                            &nbsp&nbsp&nbsp&nbsp&nbsp: Rp. 100.000,-<br><hr>
                        </h3>
                    </a>
                </div>

                <div class="row">
                    <div class="form-group col-xs-12">
                        <form method="post" action="proses_cetak.php">
                            <!--button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Cetak</button-->
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" <?php 
                                $waktu_skr = gmdate('Y-m-d H:i:s', time()+60*60*7);
                                if ($ket == '1' || $waktu_skr >= $pelanggaran['batas_login']) { ?> disabled
                                <?php
                                    }
                                ?>>Cetak</button>

                                <!-- || $waktu_skr >= $pelanggaran['waktu'] -->

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

                <!-- Pager
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul-->
            </div>
        </div>
    </div>

    <hr>

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
