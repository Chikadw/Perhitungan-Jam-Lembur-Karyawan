<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="id_rekanan";
$TB=$tbpenugasan;
$item="Penugasan";



  $sql="select * from `$TB` order by `$field` asc";
  if(isset($_GET["pk"])){
	$pk=$_GET["pk"];
		$sql="select * from `$TB` where `$field`='$pk' order by `$field` asc";
  }

  echo "<h3><center>Laporan Data $item ".getRekanan($conn,$pk)."</h3>";
  ?>


 

<table width="98%" border="0">
  <tr>
  <th width="3%"><small>No</small></td>
    <th width="80%"><small>Nama Penugasan</small></td>
	<th width="5%"><small>Status</small></td>
  </tr>
<?php  
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
				
	$sqlv="select * from `$tbpenugasan_detail` where `id_penugasan`='$id_penugasan'";
	$sdh=getJum($conn,$sqlv);
	$gab="";
	if($sdh>0){
	$arrv=getData($conn,$sqlv);
	$gab="<ol>";
		foreach($arrv as $dv) {		
				$id_penugasan=$dv["id_penugasan"];
				$id_karyawan=$dv["id_karyawan"]; 
				$catatan=$dv["catatan"];
				
				$sqld="select * from `$tbkaryawan` where  `id_karyawan`='$id_karyawan' ";
				$dd=getField($conn,$sqld);
					$id_finger=$dd["id_finger"];
					$nama_karyawan=$dd["nama_karyawan"];
					$gab.="<li><small>$nama_karyawan ($id_karyawan-$id_finger) <i>$catatan</small></i></li>";
		}
		$gab.="</ol>";
	}//jum
	else{
		$gab="<small>Data Penugasan Belum Tersedia</small>";
	}
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small><b>$nama_karyawan (NIK-0$id_karyawan)
				->$nama_penugasan ($id_penugasan)</b>
				<br><i>$deskripsi, Catatan: $keterangan</i></small>
				<br>$gab
				</td>
				<td><small>$status</td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>