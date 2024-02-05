<?php
error_reporting(0);

include "konmysqli.php";
$id_karyawan=$_GET["q"];
	$sql = "select * from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
	$d = getField($conn, $sql);
	$id_karyawan=$d["id_karyawan"];
	$id_rekanan=getRekanan($conn,$d["id_rekanan"]);
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


<table width="100%">
<tr>

 
<td><label for="id_karyawan">Nama Karyawan</label>
<td>:<td><small><?php echo $nama_karyawan." ($id_karyawan-$id_finger)";?></td>
<tr>
<td height="24"><label for="id_finger">Penugasan</label>
<td>:<td><small><?php echo $id_rekanan." ".$deskripsi;?>
</td>
</tr>  
<tr>
<td height="24"><label for="telepon">Kontak</label>
<td>:<td><small><?php echo "Telp. $telepon. Email. $email";?>
</td>
</tr> 
</table> 
<hr>


	