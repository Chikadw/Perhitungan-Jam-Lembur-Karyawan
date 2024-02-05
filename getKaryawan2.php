<?php
error_reporting(0);

include "konmysqli.php";
$id_karyawan=$_GET["q"];
$periode=$_GET["periode"];
$per=cekPer($periode);//Agustus 2023=agustus 2023=2023-08-
$awal=$per."1";
$ahir=$per."31";
$range=WKT($awal)." s/d ".WKT($ahir);

	$sql = "select * from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
	$d = getField($conn, $sql);
	$id_karyawan=$d["id_karyawan"];
	$id_rekanan=getRekanan($conn,$d["id_rekanan"]);
	$id_finger=$d["id_finger"];
	$nama_karyawan=$d["nama_karyawan"];
	$deskripsi=$d["deskripsi"];
	$telepon=$d["telepon"];
	$email=$d["email"];
	$username=$d["username"];
	$password=$d["password"];
	$gaji1=$d["gaji1"];
	$gaji2=$d["gaji2"];
	$gaji3=$d["gaji3"];
	$gaji4=$d["gaji4"];
	$gaji5=0;//$d["gaji5"];
	
	$gaji1_=RP($gaji1);
	$gaji2_=RP($gaji2);
	$gaji3_=RP($gaji3);
	$gaji4_=RP($gaji4);
	$gaji5_="Formulasi...";///RP($gaji5);
	
	$sql = "select count(`id_absensi`) as `absen` from `$tbabsensi` 
	where  `id_finger`='$id_finger' and 
	`tanggal_masuk` between '$awal' and '$ahir'";
	$d=getField($conn,$sql);
	$absen=$d["absen"];
	
	$sql = "select sum(`kalibrasi`) as `Jkalibrasi` from `$tbabsensi` 
	where  `id_finger`='$id_finger' and 
	`tanggal_masuk` between '$awal' and '$ahir'";
	$d=getField($conn,$sql);
	$Jkalibrasi0=$d["Jkalibrasi"];
	$Jkalibrasi=$Jkalibrasi0;
	if($Jkalibrasi0>60){$Jkalibrasi=60;}
	
	//$absen=rand(15,26);
	//$Jkalibrasi=rand(100,200);
	
	$sgaji1=$gaji1*$absen;
	$sgaji2=$gaji2*$absen;
	
	$sgaji3=$gaji3*1;//tunjangan
	$sgaji4=$gaji4*1;//gaji pokok
	$sgaji5=(($gaji3+$gaji4)/173)*$Jkalibrasi;
	$sgaji5_="(($gaji3+$gaji4)/173)*$Jkalibrasi";
	
	$ttl=$sgaji1+$sgaji2+$sgaji3+$sgaji4+$sgaji5;
	$pa1=($ttl * 3/100);//Ketenagakerjaan
	$pa2=($ttl * 1/100);//Kesehatan
	$pa3=($ttl * 2/100);//pph
	
	$pajak=$pa1+$pa2+$pa3;
	//pph dan BPJS Ketenagakerjaan BPJS Kesehatan
	$gaji=$ttl-$pajak;
	
/*	
$gj1="Uang Makan";
$gj2="Uang Transport";
$gj3="Uang Tunjangan";
$gj4="Gaji Tetap";
$gj5="Uang Lembur";
*/
?>

<?php echo "Info Penggajian $range";?>
<table width="100%">
<tr>

 
<td><label for="id_karyawan">Nama Karyawan</label>
<td>:<td><small><?php echo $nama_karyawan." ($id_karyawan-$id_finger)";?></td>
<tr>
<td height="24"><label for="id_finger">Penugasan</label>
<td>:<td><small><?php echo $id_rekanan." ".$deskripsi;?>
</td>
</tr>  
<tr>
<td height="24"><label for="telepon">Kontak</label>
<td>:<td><small><?php echo "Telp. $telepon. Email. $email";?>
</td>
</tr> 
</table>  

<table>
<tr>
<td height="24"><label for="id_finger">Data Gaji</label>
<td>:<td colspan="5"><small><?php echo "$gj1: $gaji1_ , $gj2: $gaji2_ <br>$gj3: $gaji3_ , $gj4: $gaji4_ , $gj5: $gaji5_";?>
</td>
</tr>  

<tr>
<td height="24"><label for="id_finger">Data Absensi/Hadir</label>
<td>:<td><small><?php echo "$absen";?> Hari
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="id_finger">Jumlah Lembur</label>
<td>:<td><small><?php echo "<label title='$sgaji5_'>$Jkalibrasi0 ($Jkalibrasi)";?> Jam</label>
</td>
</tr>   
 
<tr>
<td height="24"><label for="sgaji1">Sub-<?php echo $gj1;?></label>
<td>:<td><?php echo RP($sgaji1);?></td>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="sgaji1">Sub-<?php echo $gj2;?></label>
<td>:<td><?php echo RP($sgaji2);?></td>
</tr>

<tr>
<td height="24"><label for="sgaji1">Sub-<?php echo $gj3;?></label>
<td>:<td><?php echo RP($sgaji3);?></td>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="sgaji1">Sub-<?php echo $gj4;?></label>
<td>:<td><?php echo RP($sgaji4);?></td>
</tr>

<tr>
<td height="24"><label for="sgaji1">Sub-<?php echo $gj5;?></label>
<td>:<td><label title='<?php echo $sgaji5_;?>'><?php echo RP($sgaji5);?></label></td>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="pajak">Total Gaji</label>
<td>:<td><?php echo RP($ttl);?>
</td>
</tr>	


<tr>
<td height="24"><label for="sgaji1">BPJS Ketenagakerjaan (3%)</label>
<td>:<td><?php echo RP($pa1);?></td>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td ><label for="pajak">BPJS Kesehatan (1%)</label>
<td>:<td><?php echo RP($pa2);?>
</td>
</tr> 


<tr>
<td height="24"><label for="sgaji1">PPH Pajak (2%)</label>
<td>:<td><?php echo RP($pa3);?></td>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td ><label for="pajak">Gaji Bersih</label>
<td>:<td><?php echo RP($gaji);?> //Home Pay
</td>
</tr> 
</table>