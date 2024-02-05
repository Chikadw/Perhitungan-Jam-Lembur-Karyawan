<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="status";
$TB=$tbrekanan;
$item="Rekanan";



  $sql="select * from `$TB` order by `$field` asc";
  if(isset($_GET["pk"])){
	$pk=$_GET["pk"];
		$sql="select * from `$TB` where `$field`='$pk' order by `$field` asc";
  }

  echo "<h3><center>Laporan Data $item $pk</h3>";
  ?>


 

<table width="98%" border="0">
  <tr>
    <th width="3%"><small>No</small></td>
    <th width="10%"><small>Logo</small></td>
    <th width="50%"><small>Nama Rekanan</small></td>
    <th width="3%"><small>IDM</small></td>
	 <th width="20%"><small>Keterangan</small></td>
  </tr>
<?php  
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$id_rekanan=$d["id_rekanan"];
				$nama_rekanan=ucwords($d["nama_rekanan"]);
				$deskripsi=$d["deskripsi"];
				$alamat=$d["alamat"];
				$logo=$d["logo"];
				$logo0=$d["logo"];
				$id_mesin=$d["id_mesin"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><div align='center'>";
			echo "<a href='#' onclick='buka(\"rekanan/zoom.php?id=$id_rekanan\")'>
<img src='$YPATH/$logo' width='40' height='40' /></a></div>";
			echo "</td>
				<td><small>$nama_rekanan ($id_rekanan)<i> |$deskripsi</i><br>Alamat: $alamat</small></td>
				<td><small>$id_mesin</td>
				<td><small>$keterangan</small></td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>