<?php
error_reporting(0);

include "konmysqli.php";
$id_rekanan=$_GET["q"];
	$sql = "select * from `$tbrekanan` where `id_rekanan`='$id_rekanan'";
	$d = getField($conn, $sql);
	$id_rekanan=$d["id_rekanan"];
	$nama_rekanan=$d["nama_rekanan"];
	$deskripsi=$d["deskripsi"];
	$alamat=$d["alamat"];
?>


<table width="100%">
<tr>

 
<td><label for="id_rekanan">Nama Rekanan</label>
<td>:<td><small><?php echo "$nama_rekanan - $id_rekanan";?></td>
<tr>
<td height="24"><label for="deskripsi">Deskripsi</label>
<td>:<td><small><?php echo $deskripsi;?>
</td>
</tr>  
<tr>
<td height="24"><label for="alamat">Alamat</label>
<td>:<td><small><?php echo $alamat;?>
</td>
</tr> 
</table> 
<hr>


	