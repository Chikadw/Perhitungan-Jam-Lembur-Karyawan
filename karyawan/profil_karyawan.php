
<?php
$id_karyawan = $_SESSION["cid"];
$sql = "select * from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
$d = getField($conn, $sql);
				$id_karyawan=$d["id_karyawan"];
				$id_rekanan=$d["id_rekanan"];
				$id_finger=$d["id_finger"];
				$nama_karyawan=$d["nama_karyawan"];
				$deskripsi=$d["deskripsi"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$gaji1=$d["gaji1"];
				$gaji2=$d["gaji2"];
				$gaji3=$d["gaji3"];
				$gaji4=$d["gaji4"];
				$gaji5=$d["gaji5"];
?>


<section class="project-detail section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 mr-lg-auto mt-lg-5 col-12" data-aos="fade-up" data-aos-delay="200">
					<h3>Profil</h3>
				<hr>
				<ul class="list-detail">
					<li><span>Rekanan: <?php echo getRekanan($conn,$id_rekanan); ?></span></li>
					<li><span>ID Finger: <?php echo $id_finger; ?></span></li>
					<li><span>Nama : <?php echo $nama_karyawan; ?></span></li>
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
							<input type="text" class="form-control" name="nama_karyawan" value="<?php echo $nama_karyawan; ?>" placeholder="Nama karyawan">
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
							<input name="id_karyawan" type="hidden" id="id_karyawan" value="<?php echo $id_karyawan; ?>" />
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
		document.location.href='?mnu=profil_karyawan';
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
		document.location.href='?mnu=profil_karyawan';
		});
        }
    </script>
<?php
if (isset($_POST["Simpan"])) {
	$id_karyawan = strip_tags($_SESSION["cid"]);
	$nama_karyawan = strip_tags($_POST["nama_karyawan"]);
	$email = strip_tags($_POST["email"]);
	$telepon = strip_tags($_POST["telepon"]);
	$username = strip_tags($_POST["username"]);
	$password = strip_tags($_POST["password"]);
	

	$sql = "update `$tbkaryawan` set 
	`nama_karyawan`='$nama_karyawan',
	`email`='$email',
	`telepon`='$telepon',
	`username`='$username',
	`password`='$password'
	 where `id_karyawan`='$id_karyawan'";
	$ubah = process($conn, $sql);
	if($ubah) {echo "<script>berhasilubah();</script>";}
		else{echo"<script>gagalubah();</script>";}
} //else simpan
?>