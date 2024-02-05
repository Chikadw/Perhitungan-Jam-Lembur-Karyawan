<?php
$id_rekanan=$_SESSION["cid"];
$sql="select * from `$tbrekanan` where `id_rekanan`='$id_rekanan'";
$d=getField($conn,$sql);
	$id_rekanan=$d["id_rekanan"];
	$id_rekanan0=$d["id_rekanan"];
	$nama_rekanan=$d["nama_rekanan"];
	$deskripsi=$d["deskripsi"];
	$alamat=$d["alamat"];
	$logo=$d["logo"];
	$logo0=$d["logo"];
	$id_mesin=$d["id_mesin"];
	$username=$d["username"];
	$password=$d["password"];
	$status=$d["status"];
	$keterangan=$d["keterangan"];
?>

<table >
<tr>
<th rowspan="5">
<?php
echo "<div align='center'><a href='#' onclick='buka(\"rekanan/zoom.php?id=$id_rekanan\")'>
<img src='$YPATH/$logo' width='160' height='150' /></a></div>";

?>
<th><label for="id_rekanan">ID Rekanan</label>
<th >:
<th colspan="2"><b><?php echo $id_rekanan;?></b></tr>
<tr>
<td><label for="nama_rekanan">Nama Rekanan</label>
<td>:<td width="396"><?php echo $nama_rekanan;?>
</td>
</tr>
<tr>
<td ><label for="deskripsi">Deskripsi</label>
<td>:<td><?php echo $deskripsi;?>
</td>
</tr>

<tr>
<td ><label for="alamat">Alamat</label>
<td>:<td><?php echo $alamat;?>
</td>
</tr>

<tr>
<td ><label for="id_mesin">Nomor Mesin</label>
<td>:<td><?php echo "SNM-0".$id_mesin;?></td>
</tr>
 
</table>				
<hr>				