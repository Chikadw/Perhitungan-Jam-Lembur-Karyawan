<?php
error_reporting(0);

include "konmysqli.php";
$id_karyawan="";
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
<tr>
<td height="24"><label for="id_rekanan">Pilih Karyawan</label>
<td>:<td><select class="form-control"  name="id_karyawan" id="id_karyawan" style="width: 250px;">
  <?php
   echo"<option value='$id_karyawan' ";  echo"> $id_karyawan</option>";
	  $s="select * from `tb_karyawan` where `status`='Aktif' and `id_rekanan`='$id_rekanan'";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_karyawan0=$d["id_karyawan"];
				$nama_karyawan=$d["nama_karyawan"];
	echo"<option value='$id_karyawan0' ";if($id_karyawan0==$id_karyawan){echo"selected";} echo"> $nama_karyawan (NIK-0$id_karyawan0)  </option>";
	}
	?>
</select>
</td>
</tr>


</table> 
<hr>


	