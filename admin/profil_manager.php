
<?php
$id_admin = $_SESSION["cid"];
$sql = "select * from `$tbadmin` where `id_admin`='$id_admin'";
$d = getField($conn, $sql);
				$id_admin=$d["id_admin"];
				$nama_admin=$d["nama_admin"];
				$level=$d["level"];
				$deskripsi=$d["deskripsi"];
				$username=$d["username"];
				$password=$d["password"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
?>


<section class="project-detail section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 mr-lg-auto mt-lg-5 col-12" data-aos="fade-up" data-aos-delay="200">
					<h3>Profil</h3>
				<hr>
				<ul class="list-detail">
					<li><span>Nama : <?php echo $nama_admin; ?></span></li>
					<li><span>Telepon: <?php echo $telepon; ?></span></li>
					<li><span>Email: <?php echo $email; ?></span></li>
					<li><span>Username: <?php echo md5($username); ?></span></li>
					<li><span>Password: <?php echo md5($password); ?></span></li>
				</ul>
			</div>


			<div class="col-lg-6 col-md-6 mr-lg-auto mt-lg-5 col-12" data-aos="fade-up" data-aos-delay="200">
				<h3>Ubah Profil</h3>
				<hr>
				<form action="#" method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form" enctype="multipart/form-data">
					<div class="row">

						<div class="col-lg-12 col-12">
							<label>Nama</label>
							<input type="text" class="form-control" name="nama_admin" value="<?php echo $nama_admin; ?>" placeholder="Nama Manager">
						</div>
					
						<div class="col-lg-6 col-12">
							<label>Telepon</label>
							<input type="text" class="form-control" name="telepon" value="<?php echo $telepon; ?>" placeholder="Telepon">
						</div>

						<div class="col-lg-6 col-12">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email">
						</div>
						<div class="col-lg-6 col-12">
							<label>Username</label>
							<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Username">
						</div>

						<div class="col-lg-6 col-12">
							<label>Password</label>
							<input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="Password">
						</div>



						<div class="col-lg-5 mx-auto col-7">
							<br>
							<button type="simpan" class="btn btn-success" name="Simpan" name="simpan">Update Profil</button>
							<input name="id_admin" type="hidden" id="id_admin" value="<?php echo $id_admin; ?>" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
        function berhasilubah() {
           swal({
                title: "Terimakasih",
               text: "Data Telah Diubah",
                icon: "success",
                button: true

            }).then((result) => {
		document.location.href='?mnu=profil_manager';
		});
        }
    </script>
	<script type="text/javascript">
        function gagalubah() {
           swal({
                title: "Error",
               text: "Data Gagal Diubah",
                icon: "success",
                button: true

            }).then((result) => {
		document.location.href='?mnu=profil_manager';
		});
        }
    </script>
<?php
if (isset($_POST["Simpan"])) {
	$id_admin = strip_tags($_SESSION["cid"]);
	$nama_admin = strip_tags($_POST["nama_admin"]);
	$email = strip_tags($_POST["email"]);
	$telepon = strip_tags($_POST["telepon"]);
	$username = strip_tags($_POST["username"]);
	$password = strip_tags($_POST["password"]);
	

	$sql = "update `$tbadmin` set 
	`nama_admin`='$nama_admin',
	`email`='$email',
	`telepon`='$telepon',
	`username`='$username',
	`password`='$password'
	 where `id_admin`='$id_admin'";
	$ubah = process($conn, $sql);
	if($ubah) {echo "<script>berhasilubah();</script>";}
		else{echo"<script>gagalubah();</script>";}
} //else simpan
?>