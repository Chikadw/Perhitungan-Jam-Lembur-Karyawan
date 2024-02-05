<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
session_start();
error_reporting(0);
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";

  ?>


 

<table width="98%" border="0">
  <tr>
  <th width="3%"><small>No</small></td>
    <th width="80%"><small>Nama Penugasan</small></td>
	<th width="5%"><small>Status</small></td>
  </tr>
<?php  
$sql = "select * from `$tbpenugasan` JOIN `$tbpenugasan_detail` ON `$tbpenugasan`.id_penugasan = `$tbpenugasan_detail`.id_penugasan where  `$tbpenugasan_detail`.id_karyawan='".$_SESSION['cid']."' ";
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$id_penugasan=$d["id_penugasan"];
				$nama_penugasan=ucwords($d["nama_penugasan"]);
				$deskripsi=$d["deskripsi"];
				$id_rekanan=$d["id_rekanan"];
				$rekanan=getRekanan($conn,$d["id_rekanan"]);
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				$id_karyawan=$d["id_karyawan"];
				$nama_karyawan=getKaryawan($conn,$id_karyawan);
				
	
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small><b>$nama_karyawan (NIK-0$id_karyawan)
				->$nama_penugasan ($id_penugasan)</b>
				<br><i>$deskripsi, Catatan: $keterangan</i></small>
				</td>
				<td><small>$status</td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>