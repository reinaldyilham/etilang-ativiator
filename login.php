<?php
    session_start();
    if ($_SESSION) {
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ATIVIATOR - Log In</title>
        <link rel="icon" type="image/png" href="img/av.png">

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                        <img src="img/ativicon.png">
                            <!--h1>Log In</h1>
                            <div class="description">
                            	<p>
	                            	This is a free responsive <strong>"login and register forms"</strong> template made with Bootstrap. 
	                            	Download it on <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a>, 
	                            	customize and use it as you like!
                            	</p>
                            </div-->
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to <strong>Ativiator</strong></h3>
	                            		<p>Enter username and password!</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-lock"></i>
	                        		</div>
	                            </div>

	                            <div class="form-bottom">
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Username</label>
				                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
				                        </div>
                                        <div class="form-group">
                                            <select name="level" class="form-control" required>
                                                <option value="">--Pilih Level User--</option>
                                                <option value="1">Administrator</option>
                                                <option value="2">Pelanggar</option>
                                            </select>
                                        </div>
				                        <button type="submit" class="btn" name="login">Sign in!</button>
				                    </form>

                                    <?php
                                    if (isset($_POST['login'])) {
                                        include 'koneksi.php';

                                        $uname = $_POST['username'];
                                        $pass = $_POST['password'];
                                        $level = $_POST['level'];
                                        $is_login_false = 0;

                                        if ($level == "1") {
                                            $sql_admin = mysql_query("SELECT * FROM admin_data WHERE username='$uname' AND password='$pass'");
                                            if (mysql_num_rows($sql_admin) > 0) {
                                                /* $baris = mysql_fetch_assoc($sql);
                                                $_SESSION['uname'] == $baris['username'];
                                                $_SESSION['level'] == $baris['level']; */
                                                while ($admin = mysql_fetch_assoc($sql_admin)) {
                                                    if ($admin['hak_akses'] == '1') {
                                                        $_SESSION['user'] = $admin['username'];
                                                        $_SESSION['pass'] = $admin['password'];
                                                        echo "<script>window.location='index.php'</script>";
                                                    }
                                                }
                                            }else
                                                echo "Username error";

                                        }elseif ($level == '2') {
                                            $sql_user = mysql_query("SELECT * FROM violation_data WHERE uname='$uname' AND pass='$pass'");
                                            if (mysql_num_rows($sql_user) > 0) {
                                                while ($kendaraan = mysql_fetch_assoc($sql_user)) {
                                                    $_SESSION['user'] = $kendaraan['uname'];
                                                    $_SESSION['pass'] = $kendaraan['pass'];
                                                    echo "<script>window.location='index.php?tag_id=".$kendaraan['tag_id']."'</script>";
                                                }
                                            }else
                                                echo "Username error";
                                        }else{
                                            echo "ERROR!!!";
                                        }

                                        /* include 'functions.php';
                                        //$waktu_login = date('Y-m-d H:i:s', time());
                                        $ip = info_client_ip_getenv();

                                        $sql = mysql_query("INSERT INTO login_record VALUES ('','764909',NOW(),'$ip') ");
                                        if ($sql) {
                                            echo "Berhasil";
                                        }else
                                            echo "Gagal"; */
                                    }
                                    ?>

			                    </div>
		                    </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<!--p>Made by Anli Zaimi at <a href="http://azmind.com" target="_blank"><strong>AZMIND</strong></a> 
        					having a lot of fun. <i class="fa fa-smile-o"></i></p-->
                        <p>Copyright &copy; <strong>EMC Laboratory</strong> 2017<br>
                        </p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>