<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";$pk2="";
$field="id_rekanan";
$TB=$tbpenugasan;
$item="Penugasan";



  $sql="select * from `$TB` order by `$field` asc";
  if(isset($_GET["pk"])){
	$pk=$_GET["pk"];
	$pk2=$_GET["pk2"];
		$sql="select * from `$TB` where `$field`='$pk' and `id_karyawan`='$pk2' order by `$field` asc";
  }

  echo "<h3><center>Laporan Data $item ".getRekanan($conn,$pk)." ".getKaryawan($conn,$pk2)."</h3>";
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
				$tanggal=WKT($dv["tanggal"]); 
				$catatan=$dv["catatan"];
				 
					$gab.="<li><small>$tanggal <i>$catatan</small></i></li>";
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
				<td><small><b>$nama_penugasan ($id_penugasan)</b>
				<br><i>$deskripsi, Catatan: $keterangan</i></small>
			$gab
				</td>
				<td><small>$status</td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>