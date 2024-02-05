<?php
error_reporting(0);

include "konmysqli.php";
$id_mesin=$_GET["q"];
	$sql = "select * from `$tbrekanan` where `id_mesin`='$id_mesin'";
	$d = getField($conn, $sql);
	$id_rekanan=$d["id_rekanan"];
	$nama_rekanan=$d["nama_rekanan"];
	$deskripsi=$d["deskripsi"];
	$alamat=$d["alamat"];
?>
<small><i>
<?php echo "$nama_rekanan - $id_rekanan";?><br>
<?php echo $deskripsi;?> <br>
Alamat <?php echo $alamat;?>
</small></i>