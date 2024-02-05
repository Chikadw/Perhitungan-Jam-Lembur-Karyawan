<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="id_mesin";
$TB=$tbabsensi;
$item="Absensi";



  $sql="select * from `$TB` order by `$field` asc";
  if(isset($_GET["pk"])){
	$pk=$_GET["pk"];
		$sql="select * from `$TB` where `$field`='$pk' order by `$field` asc";
  }

  echo "<h3><center>Laporan Data $item ".getMesin($conn,$pk)."</h3>";
  ?>


 

<table width="98%" border="0">
  <tr>
 <th width="3%"><small>No</small></td>
    <th width="5%"><small>IDKRY</small></td>
	<th width="20%"><small>Nama Karyawan</small></td>
    <th width="20%"><small>Masuk</small></td>
    <th width="20%"><small>Pulang</small></td>
	 <th width="20%"><small>Keterangan</small></td>
  </tr>
<?php  
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$id_absensi=$d["id_absensi"];
				$id_mesin=$d["id_mesin"];
				$id_finger=$d["id_finger"];
				$tanggal_masuk=WKT($d["tanggal_masuk"]);
				$jam_masuk=$d["jam_masuk"];
				$tanggal_pulang=WKT($d["tanggal_pulang"]);
				$jam_pulang=$d["jam_pulang"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			$sqlv="select * from `$tbkaryawan` where `id_finger`='$id_finger'";
			$dv=getField($conn,$sqlv);
				$id_rekanan=$dv["id_rekanan"];
				$id_finger=$dv["id_finger"];
				$id_karyawan=$dv["id_karyawan"];
				$nama_karyawan=$dv["nama_karyawan"];
				$deskripsi=$dv["deskripsi"];
				$telepon=$dv["telepon"];
				$email=$dv["email"];
				
				
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$id_karyawan-$id_finger</small></td>
				<td><small>$nama_karyawan</small></td>
				<td><small>$tanggal_masuk $jam_masuk</small></td>
				<td><small>$tanggal_pulang $jam_pulang</small></td>
				<td><small>$keterangan</small></td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>