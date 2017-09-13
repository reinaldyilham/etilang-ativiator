<?php
	//include 'cekadmin.php';
	include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
        exit;
    }elseif ($_SESSION['user'] != 'admin') {
    	die("Anda bukan admin! <br>
    	<a href='javascript:history.back()''>Back</a>");
    }
?>
<HTML>
	<HEAD>
		<!--link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
		<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<title>ATIVIATOR - Data Pengendara</title>
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
	                        <a href="#">Data Pengendara</a>
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
	                <h1 class="page-header">Data Pengendara
	                    <!--small>Item Subheading</small-->
	                </h1>
	            </div>
	        </div>

			<div class="row">
		        <div class="table-responsive">
		            <table id="myTable">
		                <thead>
		                    <tr>
		                        <th>Tag ID</th>
		                        <th>ID KTP</th>
		                        <th>Nama</th>
		                        <th>Alamat</th>
		                        <th>Nomor HP</th>
		                        <th>Nomor Polisi</th>
		                        <th>Nomor STNK</th>
		                        <th>Keterangan</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php
		                        $sql_vehic = mysql_query("SELECT * FROM vehicle_data");
		                        while ($kendaraan = mysql_fetch_assoc($sql_vehic)) {
		                           	$id = $kendaraan['tag_id'];
		                            $sql_vio = mysql_query("SELECT * FROM violation_data WHERE tag_id='$id'");
		                            echo "
		                            <tr>
			                            <td>$kendaraan[tag_id]</td>
			                            <td>$kendaraan[no_ktp]</td>
			                            <td>$kendaraan[nama]</td>
			                            <td>$kendaraan[alamat]</td>
			                            <td>$kendaraan[no_hp]</td>
			                            <td>$kendaraan[nomer_polisi]</td>
			                            <td>$kendaraan[nomer_stnk]</td>
		                                <td><a href='violation_record.php?tag_id=$kendaraan[tag_id]'>Show more</a></td>
		                            </tr>";
		                        	/* while ($pelanggaran = mysql_fetch_assoc($sql_vio)) {
		                                echo "
		                                <tr>
		                                    <td><a href='violation_record.php?tag_id=$kendaraan[tag_id]'>$kendaraan[tag_id]</a></td>
		                                    <td>$kendaraan[no_ktp]</td>
		                                    <td>$kendaraan[nama]</td>
		                                    <td>$kendaraan[alamat]</td>
		                                    <td>$kendaraan[no_hp]</td>
		                                    <td>$kendaraan[nomer_polisi]</td>
		                                    <td>$kendaraan[nomer_stnk]</td>
		                                </tr>";

		                                /*<!--tr>
		                                    <td><a href='#'><?php echo $kendaraan['tag_id'];?></a></td>
		                                    <td><?php echo $kendaraan['no_ktp'];?></td>
		                                    <td><?php echo $kendaraan['nama'];?></td>
		                                    <td><?php echo $kendaraan['alamat'];?></td>
		                                    <td><?php echo $kendaraan['no_hp'];?></td>
		                                    <td><?php echo $kendaraan['nomer_polisi'];?></td>
		                                    <td><?php echo $kendaraan['nomer_stnk'];?></td>
		                                    <!--td><?php 
		                                            $status = $pelanggaran['keterangan'];
		                                            if ($status == '0') {
		                                                echo "Belum cetak.";
		                                            }elseif ($status == '1') {
		                                                echo "Sudah cetak.";
		                                            }
		                                        ?></td>
		                                </tr-->
		                        	} */
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