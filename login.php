<?php
session_start();
//error_reporting(0);
require_once"konmysqli.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="reglogin/css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="reglogin/fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="reglogin/css/style2.css"/>
</head>
<body class="form-v4">
	<div class="page-content">
		<div class="form-v4-content">
		
			<div class="form-left">
				<h2>INFOMATION</h2>
				<p class="text-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Et molestie ac feugiat sed. Diam volutpat commodo.</p>
				<p class="text-2"><span>Eu ultrices:</span> Vitae auctor eu augue ut. Malesuada nunc vel risus commodo viverra. Praesent elementum facilisis leo vel.</p>
			
			</div>
			<form class="form-detail" action="" method="post" id="myform">
				<h2>Login FORM</h2>
				<br><br>
				<div class="form-group">
					<div class="form-row form-row-1 ">
						<label for="username">Username</label>
						<input type="text" name="user" id="username" class="form-control" required>
					</div>
					<div class="form-row form-row-1">
						<label for="password">Password</label>
						<input type="password" name="pass" id="password" class="form-control" required>
					</div>
				</div>
				<br>
				<div class="form-row-last">
					<input type="submit" name="Login" class="register" value="Login">
				</div>
			</form>
		</div>
		
	</div>
	
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

<?php
if(isset($_POST["Login"])){
	$usr=$_POST["user"];
	$pas=$_POST["pass"];
	
		$sql3="select * from `$tbadmin` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		$sql2="select * from `$tbrekanan` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		$sql1="select * from `$tbkaryawan` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		
		if(getJum($conn,$sql1)>0){
			$d=getField($conn,$sql1);
				$kode=$d["id_karyawan"];
				$nama=$d["nama_karyawan"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Karyawan";
		echo "<script>alert('Otentikasi ".$_SESSION["cstatus"]." an ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}
		else if(getJum($conn,$sql2)>0){
			$d=getField($conn,$sql2);
				$kode=$d["id_rekanan"];
				$nama=$d["nama_rekanan"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Rekanan";
		echo "<script>alert('Otentikasi ".$_SESSION["cstatus"]." an ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}
		else if(getJum($conn,$sql3)>0){
			$d=getField($conn,$sql3);
				$kode=$d["id_admin"];
				$nama=$d["nama_admin"];
				$level=$d["level"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]=$level;
		echo "<script>alert('Otentikasi ".$_SESSION["cstatus"]." an ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}
	 
		else{
			session_destroy();
			echo "<script>alert('Otentikasi Login GAGAL !,Silakan cek data Anda kembali...');
			document.location.href='login.php';</script>";
		}
}


?>