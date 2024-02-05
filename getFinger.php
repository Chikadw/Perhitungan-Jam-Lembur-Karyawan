<?php
error_reporting(0);

include "konmysqli.php";
$id_finger=$_GET["q"];
	$sql = "select * from `$tbkaryawan` where `id_finger`='$id_finger'";
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

<small><i>
<?php echo "$nama_karyawan  ($id_karyawan-$id_finger)";?><br>
<?php echo $deskripsi;?> <br>
Telp. <?php echo $telepon;?>
</small></i>
	