<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="id_rekanan";
$TB=$tbkaryawan;
$item="Karyawan";




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
    <th width="35%"><small>Nama Karyawan</small></td>
    <th width="7%"><small><?php echo $gj1;?></small></td>
    <th width="7%"><small><?php echo $gj2;?></small></td>
    <th width="7%"><small><?php echo $gj3;?></small></td>
    <th width="7%"><small><?php echo $gj4;?></small></td>
	 <th width="40%"><small>Keterangan</small></td>
  </tr>
<?php  
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
			$id_karyawan=$d["id_karyawan"];
				$id_rekanan=$d["id_rekanan"];
				$rekanan=getRekanan($conn,$d["id_rekanan"]);
				$id_finger=$d["id_finger"];
				$nama_karyawan=$d["nama_karyawan"];
				$deskripsi=$d["deskripsi"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$gaji1=RP($d["gaji1"]);
				$gaji2=RP($d["gaji2"]);
				$gaji3=RP($d["gaji3"]);
				$gaji4=RP($d["gaji4"]);
				$gaji5=RP($d["gaji5"]);
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
<td><small>$no</small></td>
<td><small><a href='mailto: $email' title='$email'><b>$nama_karyawan ($id_finger)</b></a>
<br><i>Telp. $telepon, Status $status Catatan: $deskripsi</i></small></td>
<td><small>$gaji1</small></td>
<td><small>$gaji2</small></td>
<td><small>$gaji3</small></td>
<td><small>$gaji4</small></td>
<td><small>$keterangan</small></td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>