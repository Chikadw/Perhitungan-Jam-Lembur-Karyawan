<?php
include "konmysqli.php";

$periode="Oktober 2023";
$id_rekanan=$_GET["q"];
$sql="select * from `$tbrekanan` where `id_rekanan`='$id_rekanan'";
$d=getField($conn,$sql);
	$id_rekanan=$d["id_rekanan"]; 
	$nama_rekanan=$d["nama_rekanan"];
	$deskripsi=$d["deskripsi"];
	$alamat=$d["alamat"];
	$logo=$d["logo"];
	$logo0=$d["logo"];
	$id_mesin=$d["id_mesin"]; 
			
$NF="$id_rekanan $nama_rekanan $periode";			
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $header;?></title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;

	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=$NF.xls");
	
	
	?>
<center>
 <h2>Absensi IDM <?php echo $NF;?> 
</center>
	<table border="1">
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
	
	$sqlc="select * from `$tbkaryawan` where `id_mesin`='$id_mesin' and `status`='Aktif'";
	$jumc=getJum($conn,$sqlc);
	if($jumc <1){
		echo"<h1>Maaf data Karyawan Aktif belum tersedia</h1>";
	}
	else{
		$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {	
			$id_karyawan=$dc["id_karyawan"]; 
			$id_finger=$dc["id_finger"];
			$nama_karyawan=$dc["nama_karyawan"];
			$deskripsi=$dc["deskripsi"];
	$nomor=0;	
for($i=0;$i<=30;$i++){	
	$nomor=$i+1;
	$J1=rand(6,10);
	$J2=rand(14,24);
	$M1=rand(1,59);
	$M2=rand(1,59);
	
	$tanggal_masuk=date("Y-m-d");
	$jam_masuk=$J1.":$M1:".date("s");
	$tanggal_pulang=date("Y-m-d");
	$jam_pulang=$J2.":$M2:".date("s");
	$status="Pulang";
	$keterangan="";
	$hari=getHari($tanggal_masuk);
	$selisihM=($M2-$M1);
	$selisihJ=($J2-$J1);
	$kalK=0;
	$kalL=0;
	$kal=0;
	
	if($hari=="Sabtu"||$hari=="Minggu"){
		
	}
	
	
	
			$color="#dddddd";		
			if($nomor %2==0){$color="#eeeeee";}
	echo"<tr bgcolor='$color'>
	<td><small>$nomor</small></td>
	<td><small>$hari</small></td>
	<td><small>$id_mesin</small></td>
	<td><small>$id_finger</small></td>
	<td><small>$id_karyawan</small></td>
	<td><small>$nama_karyawan</small></td>
	<td><small>".WKT($tanggal_masuk)."<small>Hari</small></td>
	<td><small>$lembur <small>Jam</small></td>
	<td><small>$sgaji1</small></td>
	<td><small>$sgaji2</small></td>
	<td><small>$sgaji3</small></td>
	<td><small>$sgaji4</small></td>
	<td><small>$sgaji5</small></td>
	<td><small>$total</small></td>
	<td><small>$keterangan</small></td>
	</tr>";
}//for i
}//fore
}//if
 
echo"</table>";
	?>
</body>
</html>