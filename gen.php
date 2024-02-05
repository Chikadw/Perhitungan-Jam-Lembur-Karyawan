<?php
include "konmysqli.php";
$tahun=2023;
$bulan=10;
$periode="Oktober 2023";
$id_mesin=1;

//gen.php?idm=1&bulan=10
if(isset($_GET["idm"])){
	$id_mesin=$_GET["idm"];
}
if(isset($_GET["bulan"])){
	$bulan=$_GET["bulan"];
}
$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
 
$wk=$judul_bln[(int)$bulan];
$periode=$wk." 2023";

$sql="select * from `$tbrekanan` where `id_mesin`='$id_mesin'";
$d=getField($conn,$sql); 
$id_rekanan=$d["id_rekanan"];
$nama_rekanan=$d["nama_rekanan"];
$deskripsi=$d["deskripsi"];
$alamat=$d["alamat"];
$logo=$d["logo"];
$id_mesin=$d["id_mesin"]; 
			
$NF="$id_rekanan-$id_mesin $nama_rekanan $periode";			
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
header("Content-Disposition: attachment; filename=$NF.xlsx");
	
	?>
<center>
 <b>Absensi Mesin <?php echo $NF;?> </b>
</center>
<table border="1">
<tr bgcolor="#000000">
<th width="3%"><small><font color="#ffffff">No</font></small></td>
<th width="5%"><small><font color="#ffffff">IDM</font></small></td>
<th width="5%"><small><font color="#ffffff">IDF</font></small></td>
<th width="15%"><small><font color="#ffffff">Tanggal</font></small></td>
<th width="10%"><small><font color="#ffffff">Masuk</font></small></td>
<th width="10%"><small><font color="#ffffff">Pulang</font></small></td>
</tr>
<?php  
	
	$sqlc="select * from `$tbkaryawan` where `id_rekanan`='$id_rekanan' and `status`='Aktif' order by rand()";
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
			$nomor++;
			$R=rand(0,100);
			if($R<=80){
				$J1=cekR(6,10);
				$J2=cekR(14,24);
				$M1=cekR(1,59);
				$M2=cekR(1,59);
				$D1=cekR(1,59);
				$D2=cekR(1,59);
				
				$tanggal=$i+1;
				if($tanggal<10){$tanggal="0".$tanggal;}
				$tanggal_masuk="$tahun-$bulan-$tanggal";
				$jam_masuk=$J1.":$M1:".$D1;
				$tanggal_pulang=$tanggal_masuk;
				$jam_pulang=$J2.":$M2:".$D2;
				$status="Pulang";
				$keterangan=""; 
						$color="#dddddd";		
						if($nomor %2==0){$color="#eeeeee";}
				echo"<tr bgcolor='$color'>
				<td><small>$nomor</small></td>
				<td><small>$id_mesin</small></td>
				<td><small>$id_finger</small></td>
				<td><small>$tanggal_masuk</td>
				<td><small>$jam_masuk</small></td>
				<td><small>$jam_pulang</small></td>
				</tr>";
			}
			}//for i
}//fore
}//if
 
echo"</table>";
	?>
</body>
</html>