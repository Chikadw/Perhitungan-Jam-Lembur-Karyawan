<?php

include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$tahun=2023;
$bulan=10;
$periode="Oktober 2023";
$id_mesin=1;

//absen.php?idf=1&bulan=10
if(isset($_GET["bulan"])){
	$bulan=$_GET["bulan"];
}
$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
$wk=$judul_bln[(int)$bulan];
$periode=$wk." 2023";

$id_finger=1;
if(isset($_GET["idf"])){
	$id_finger=$_GET["idf"];
}
	$sql="select * from `$tbkaryawan` where `id_finger`='$id_finger'";
	$d=getField($conn,$sql);
	$id_karyawan=$d["id_karyawan"];
	$id_rekanan=$d["id_rekanan"];
	$id_finger=$d["id_finger"];
	$nama_karyawan=$d["nama_karyawan"];
	$deskripsi=$d["deskripsi"];
	$telepon=$d["telepon"];
	$email=$d["email"];
	
$sql="select * from `$tbrekanan` where `id_rekanan`='$id_rekanan'";
	$d=getField($conn,$sql);
		$nama_rekanan=$d["nama_rekanan"];
		$deskripsi=$d["deskripsi"];
		$alamat=$d["alamat"]; 
		$logo=$d["logo"];
		$id_mesin=$d["id_mesin"];
		$status=$d["status"];
		$keterangan=$d["keterangan"];	
	$GBR="../ypathfile/$logo";	
?>
 
<table width="98%" border="1">
<tr>
<th colspan="2" align='center'>
<?php echo '<img title="'.$nama_rekanan.'"  src="'.$GBR.'" width="80" height="80">';?>
</th>
<th colspan="2" align="left">
FiID<br>
FiCode<br>
FiName
</th>
<th colspan="4" align="left">
<?php echo "IDF-$id_finger<br>KRY0-$id_karyawan<br>$nama_karyawan";?>
</th>
<th colspan="3" align="left">
Emp. Title<br>
Hire Date<br>
Department
</th>
<th colspan="5" align="left">
<?php echo "$nama_rekanan<br>$alamat, <br>ID-Mesin: $id_mesin";?>
</th>

</tr>
<tr>
	<th><small>No</small></th>
	<th><small>Day</small></th>
	<th><small>Data</small></th>
	<th><small>Working-Hour</small></th>
	<th><small>Act</small></th>
	<th><small>On</small></th>
	<th><small>Off</small></th>
	<th><small>Late</small></th>
	<th><small>Early</small></th>
	<th><small>Effective</small></th>
	<th><small>TEffective</small></th>
	<th><small>Lembur</small></th>
	<th><small>Norm</small></th>
	<th><small>Duration</small></th>
	<th><small>Note</small></th>
</tr>
<?php
$a_date = "$tahun-$bulan-01";
$lastdate= date('t',strtotime($a_date));//Y-m-t
for($i=1;$i<=$lastdate;$i++){
	$no=$i;
	$tanggal="$tahun-$bulan-$no";
	
	$sql="select * from `$tbabsensi` where `id_finger`='$id_finger' and `id_mesin`='$id_mesin' and `tanggal_masuk`='$tanggal'";
	$ada=getJum($conn,$sql);
	$notes="<font color='red'>Absent</font>";
	$late="";
	$early="";
	$effect="";
	$jam_masuk="";
	$jam_pulang="";
	$status="";
	$keterangan="";
		$lamakerja=0; 
		$lembur=0; 
		$kalibrasi=0; 
		$catatan=""; 
		
	$hari=getHari($tanggal);
	$tanggal_masuk=WKT($tanggal);
	if($ada>0){
	$d=getField($conn,$sql);
		$id_absensi=$d["id_absensi"];
		$tanggal_masuk=WKT($d["tanggal_masuk"]);
		$jam_masuk=$d["jam_masuk"];
		$jam_pulang=$d["jam_pulang"];
		$status=$d["status"];
		$keterangan=$d["keterangan"]; 
		$hari=$d["hari"]; 
		$kategori=$d["kategori"]; 
		$lamakerja=$d["lamakerja"]; 
		$lembur=$d["lembur"]; 
		$kalibrasi=$d["kalibrasi"]; 
		$catatan=$d["catatan"]; 
		
		$notes="Working Hour";
		
		$ar1=explode(":",$jam_masuk);
		$j1=$ar1[0]+0;if($j1==0){$j1=24;}
		$m1=$ar1[1];
		$selj=$jammasuknormal-$j1;
		$menj=60-$m1;
		$early="$selj:$menj";
		if($selj<0){//terlambat
			$late=abs($selj).":$menj";
			$early="";
		} 
		else{
			$late="";
		}
		$ar2=explode(":",$jam_pulang);
		$j2=$ar2[0]+0;if($j2==0){$j2=24;}
		$m2=$ar2[1];
		$selj=$j2-$j1;
		$selm=abs($m2-$m1);if($selm<10){$selm="0".$selm;}
		$effect="$selj:$selm";
	}
				
	echo"<tr>
	<td><small>$no</small></td>
	<td><small>$hari</small></td>
	<td><small>$tanggal_masuk</small></td>
	<td><small>09:00-18:00</small></td>
	<td><small>Work</small></td>
	<td><small>$jam_masuk</small></td>
	<td><small>$jam_pulang</small></td>
	<td><small>$late</small></td>
	<td><small>$early</small></td>
	<td><small>$effect</small></td>
	<td><small>$lamakerja</small></td>
	<td><small>$lembur</small></td>
	<td><small>$kalibrasi</small></td>
	<td><small>$catatan</small></td>
	<td><small>$notes</small></td>
	
	</tr>";
	
	
}
?>
</table>