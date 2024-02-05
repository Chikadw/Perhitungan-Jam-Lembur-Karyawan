<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="id_rekanan";
$TB=$tbpenggajian;
$item="Penggajian";
 

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
	<th width="20%"><small>Periode</small></td>
	<th width="20%"><small>Karyawan</small></td>
    <th width="5%"><small>Absen</small></td>
    <th width="5%"><small>Lembur</small></td>
    <th width="10%"><small><?php echo $gj1;?></small></td>
    <th width="10%"><small><?php echo $gj2;?></small></td>
    <th width="10%"><small><?php echo $gj3;?></small></td>
    <th width="10%"><small><?php echo $gj4;?></small></td>
    <th width="10%"><small><?php echo $gj5;?></small></td>
	 <th width="10%"><small>Total</small></td>
	 <th width="20%"><small>Keterangan</small></td>
  </tr>
<?php  
  $jum=getJum($conn,$sql);
  $no=0;
		if($jum > 0){
	$arr=getData($conn,$sql);
		foreach($arr as $d) {								
		$no++;
				$id_penggajian=$d["id_penggajian"];
				$id_rekanan=$d["id_rekanan"];
				$rekanan=getRekanan($conn,$d["id_rekanan"]);
				$id_karyawan=$d["id_karyawan"];
				$karyawan=getKaryawan($conn,$d["id_karyawan"]);
				$periode=$d["periode"];
				$absen=$d["absen"];
				$lembur=$d["lembur"];
				$pajak=$d["pajak"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$sgaji1=RP($d["sgaji1"]);
				$sgaji2=RP($d["sgaji2"]);
				$sgaji3=RP($d["sgaji3"]);
				$sgaji4=RP($d["sgaji4"]);
				$sgaji5=RP($d["sgaji5"]);
				$subtotal=$d["subtotal"];
				$total=RP($d["total"]);
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$periode</small></td>
				<td><small>$karyawan (KRY0$id_karyawan)</small></td>
				<td><small>$absen <small>Hari</small></td>
				<td><small>$lembur <small>Jam</small></td>
				<td><small>$sgaji1</small></td>
				<td><small>$sgaji2</small></td>
				<td><small>$sgaji3</small></td>
				<td><small>$sgaji4</small></td>
				<td><small>$sgaji5</small></td>
				<td><small>$total</small></td>
				<td><small>$keterangan</small></td>
				</tr>";
				}
		}//if
		else{echo"<tr><td colspan='7'><blink>Maaf, Data $item belum tersedia...</blink></td></tr>";}
	
	echo"</table>";
	?>