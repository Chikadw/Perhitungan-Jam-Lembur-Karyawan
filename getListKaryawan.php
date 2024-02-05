<?php
//error_reporting(0);
$id_karyawan="";
include "konmysqli.php";
$id_rekanan=$_GET["q"];
	?>
<select class="form-control"  name="id_karyawan" id="id_karyawan" style="width: 250px;" onchange="showUp2(this.value)">
  <?php
   echo"<option value='$id_karyawan' ";  echo"> $id_karyawan</option>";
	  $s="select * from `tb_karyawan` where `status`='Aktif'
	  and `id_rekanan`='$id_rekanan'
	  ";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_karyawan0=$d["id_karyawan"];
				$nama_karyawan=$d["nama_karyawan"];
	echo"<option value='$id_karyawan0' ";if($id_karyawan0==$id_karyawan){echo"selected";} echo"> $nama_karyawan</option>";
	}
	?>
</select><div id="txtHint2"></div>
	