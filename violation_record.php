<?php
	include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
        exit;
    }elseif ($_SESSION['user'] != 'admin') {
    	die("Anda bukan admin! <br>
    	<a href='javascript:history.back()''>Back</a>");
    }

    $tag_id = $_GET['tag_id'];

?>
<HTML>
	<HEAD>
		<!--link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<title>ATIVIATOR - Riwayat Pelanggaran</title>
		<link rel="icon" type="image/png" href="img/av.png">

	    <!-- Bootstrap Core CSS -->
	    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	    <!-- Custom CSS -->
    	<link href="css/portfolio-item.css" rel="stylesheet">
	</HEAD>

	<BODY>  <!--for demo wrap-->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	        <div class="container">
	            <!-- Brand and toggle get grouped for better mobile display -->
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>
	                <a class="navbar-brand" href="#">ATIVIATOR</a>
	            </div>
	            <!-- Collect the nav links, forms, and other content for toggling -->
	            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                    <li>
	                        <a href="admin.php">Data Pengendara</a>
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

		<div class="container">
			<div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header">Riwayat Pelanggaran
	                    <!--small>Item Subheading</small-->
	                </h1>
	            </div>
	        </div>

			<div class="row">
		        <div class="table-responsive">
		            <table id="myTable">
		                <thead>
		                    <tr>
		                        <th>No</th>
		                        <th>Tag ID</th>
		                        <th>Nama</th>
		                        <th>Waktu Pelanggaran</th>
		                        <th>Lokasi</th>
		                        <th>Password</th>
		                        <th>Nomor Pembayaran</th>
		                        <th>Status</th>
		                        <th>Masa Aktif Akun</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php
		                        $urut = 0;
		                        $sql_vehic = mysql_query("SELECT * FROM vehicle_data WHERE tag_id='$tag_id'");
		                        while ($kendaraan = mysql_fetch_assoc($sql_vehic)) {
		                           	$id = $kendaraan['tag_id'];
		                            $sql_vio = mysql_query("SELECT * FROM violation_data WHERE tag_id='$id'");
		                            while ($pelanggaran = mysql_fetch_assoc($sql_vio)) {
		                            	$urut++;
		                                    ?>

		                                <tr>
		                                    <td><?php echo $urut;?></td>
		                                    <td><?php echo $kendaraan['tag_id'];?></td>
		                                    <td><?php echo $kendaraan['nama'];?></td>
		                                    <td><?php echo $pelanggaran['waktu'];?></td>
		                                    <td><?php echo $pelanggaran['lokasi'];?></td>
		                                    <td><?php echo $pelanggaran['pass'];?></td>
		                                    <td><?php echo $pelanggaran['no_resi'];?></td>
		                                    <td><?php 
		                                            $status = $pelanggaran['keterangan'];
		                                            if ($status == '0') {
		                                                echo "Belum cetak.";
		                                            }elseif ($status == '1') {
		                                                echo "Sudah cetak.";
		                                            }elseif($status == null){
		                                            	echo "Belum cetak.";
		                                            }
		                                        ?></td>
		                                    <td><?php
		                                    		$status = $pelanggaran['keterangan'];
			                                    	$waktu_skr = gmdate('Y-m-d H:i:s', time()+60*60*7);
												    /* if ($waktu_skr >= $pelanggaran['batas_waktu'] && $status == null) {
												        echo 'Expired!';
											    	}elseif ($waktu_skr >= $pelanggaran['batas_waktu']) {
											    		echo "Masih aktif.";
											    	}elseif ($status == null){
											    		echo "-";
											    	} */
											    	if ($status == '0' || $status == null) {
		                                                echo "-";
		                                            }elseif ($status == '1') {
		                                                if ($waktu_skr >= $pelanggaran['batas_login']) {
												        	echo 'Expired!';
											    		}else {
											    			echo "Masih aktif.";
											    		}
		                                            }
											    ?></td>
		                                </tr>

		                    <?php
		                        }
		                    }
		                    ?>
		                </tbody>
		            </table>
		        </div>
		    </div>
		</div>

		<script>
			$(document).ready(function(){
			    $('#myTable').dataTable();
			});
		</script>
	</BODY>	
</HTML>