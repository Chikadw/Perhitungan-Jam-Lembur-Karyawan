<style type="text/css">body {width: 100%;} </style> 
<body OnLoad="window.print()" OnFocus="window.close()"> 
<?php
include "../konmysqli.php";
echo"<link href='../ypathcss/$css' rel='stylesheet' type='text/css' />";
$YPATH="../ypathfile/";
$pk="";
$field="id_finger";
$TB=$tbabsensi;
$item="Absensi";

$id_karyawan=$_GET["pk"];
$ara=array();
  $sqlv="select `$tbpenugasan_detail`.`tanggal` from `$tbpenugasan_detail`,`$tbpenugasan`
 where  
 `$tbpenugasan_detail`.id_penugasan=`$tbpenugasan`.id_penugasan
 and 
 `$tbpenugasan`.`id_karyawan`='$id_karyawan' 
 order by `$tbpenugasan_detail`.`ipd` asc";
$adv=getJum($conn,$sqlv)+0;
$ara[0]="";
if($adv>0){
	$arrv=getData($conn,$sqlv); 
	$k=0;
		foreach($arrv as $dv) {		
		$ara[$k]=$dv["tanggal"];
		$k++;
		}
}

$sql="select *  from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
	$d=getField($conn,$sql);
$id_finger=$d["id_finger"];
$nama_karyawan=$d["nama_karyawan"];
		
$sql = "select * from `$tbabsensi` where  `id_finger`='$id_finger' 
order by `id_absensi` asc ";
$jum = getJum($conn, $sql); ;
	?>
	<div id="accordion">
		<h3>Data Absensi <?php echo "$nama_karyawan /Finger-$id_finger ($jum Data)"?>:</h3>
<div>				
 

<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
	<th width="20%"><small>Tanggal</small></td>
    <th width="5%"><small>IDKRY</small></td>
	<th width="20%"><small>Nama Karyawan</small></td>
    <th width="5%"><small>Masuk</small></td>
    <th width="5%"><small>Pulang</small></td>
	<th width="5%"><small>Lama</small></td>
	<th width="5%"><small>Lembur</small></td>
	<th width="5%"><small>Norm</small></td> 
	<th width="20%"><small>Keterangan</small></td> 
  </tr>
<?php  
		if($jum > 0){
//--------------------------------------------------------------------------------------------
$batas   = 10000;
$page=1;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
if(empty($page)){$posawal  = 0;$page = 1;}
else{$posawal = ($page-1) * $batas;}


$sql2 = $sql." LIMIT $posawal,$batas";
$no = $posawal+1;
//--------------------------------------------------------------------------------------------									
	$arr=getData($conn,$sql2);
		foreach($arr as $d) {						
				$id_absensi=$d["id_absensi"];
				$id_mesin=$d["id_mesin"];
				$id_finger=$d["id_finger"];
				$TM=$d["tanggal_masuk"];
				
				$cek=cekTugas($ara,$TM);
				$tanggal_masuk=WKTP($TM);
				if($cek==1){$tanggal_masuk="<strike><font color='red'>$tanggal_masuk</font></strike>";}
				$jam_masuk=$d["jam_masuk"];
				$tanggal_pulang=WKTP($d["tanggal_pulang"]);
				$jam_pulang=$d["jam_pulang"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
				$kalibrasi=$d["kalibrasi"];
				$lembur=$d["lembur"];
				$catatan=$d["catatan"];
				
				$arj2=explode(":",$jam_pulang);
				$j2=$arj2[0];
				if($j2=="00"){
					$jam_pulang="24:00:00";
					}
				
				$arj1=explode(":",$jam_masuk);
				$arj2=explode(":",$jam_pulang);
				$j1=$arj1[0];
				$m1=$arj1[1];
				$j2=$arj2[0];
				$m2=$arj2[1];
				$selj=($j2-$j1);
				$selm=abs($m2-$m1);
				$selmm=0;if($selm>30){$selmm=0.5;}
				$lamakerja=($selj+$selmm);
				$lembur=($lamakerja-$jamkerja);
				if($lembur<=0){$selmm=0;$lembur=0;}
				
				$hari=getHari($TM);
				$tambah=1;
				if($selmm<30){$tambah=0;}
				else if($selmm<45){$tambah=0.5;}
				else if($selmm<=59){$tambah=0.75;}
					
				$kategori=cekWeek($hari); 
				$norm=0; 
				$lamakerja1=$lamakerja+$tambah;
				$jnorm=0;
				$knorm="$lamakerja1 Jam Tidak Mencukupi";
					if(floor($lamakerja1)>0){
						if($kategori=="Weekday"){
							$lamakerja0=$lamakerja1;
							$lamakerja1=$lamakerja1-9;//9 jam acuan kerja minimum
							$sisakal=$lamakerja1-1;
							if($lamakerja1<0){$lamakerja1=0;$sisakal=0;}
							$norm1=0;
							if($lamakerja1>=1){
								$norm1=1*1.5;
							}
							$norm2=$sisakal*2;
							$jnorm=$norm1+$norm2;
							$knorm="1Jam pertama @1.5,$sisakal Jam berikutnya @2=$jnorm";
						}
						else{
							$lamakerja0=$lamakerja1;
							if($lamakerja1>9){
								$sisakal=$lamakerja1-9;//12
								//dikurangi 9 krn 1 dan 8 
								$norm1=8*2;//jam 1-8
								$norm2=1*3;//jam ke-9
								$norm3=$sisakal*4;//jam ke-10 dst
								$jnorm=$norm1+$norm2+$norm3;
								$knorm="8Jam pertama @2,Jam ke-9 @3, Sisanya $sisakal Jam @4=$jnorm";
							}
							else if($lamakerja1>8){ 
								$sisakal=$lamakerja1-8;//12
								$norm1=8*2;//jam 1-8
								$norm2=$sisakal*3;//jam ke-9
								$norm3=0;//jam ke-10 sd 12 dst
								$jnorm=$norm1+$norm2+$norm3;
								$knorm="8Jam pertama @2,Jam ke-9 @3, Sisanya $sisakal Jam @4=$jnorm";
							}
							else if($lamakerja1>0){
								$norm1=$lamakerja1*2;//jam 1-8
								$norm2=0;//jam ke-9
								$norm3=0;//jam ke-10 sd 12 dst
								$jnorm=$norm1+$norm2+$norm3;
								$knorm="$lamakerja1 Jam pertama @2 @4=$jnorm";
							}
						}//else weekend
					}//lamakerja1>0
/*				
- Untuk yang kurang dari 30 menit maka tidak dihitung 
- Untuk yang sama dengan 30 menit maka dihitung 0,5
- Untuk yang sama dengan 45 menit maka dihitung 0,75

Rumus lembur di hari kerja
- 1 jam pertama : 1,5 x upah lembur per jam
- Jam kerja berikutnya : 2 x upah lembur per jam

Rumus weekend,
Jam ke-1 hingga jam ke-8 : 2 x upah lembur per jam
Jam ke-9 : 3 x upah lembur per jam
Jam ke-10 hingga jam ke-12 : 4 x upah lembur per jam

*/
			$catatan="$kategori, $lamakerja1 jam $selmm menit";
			
				
		$sqld="update `$tbabsensi` set 
	`hari`='$hari',`kategori`='$kategori',
	`lamakerja`='$lamakerja0',
	`lembur`='$lamakerja1' ,
	`kalibrasi`='$jnorm' ,
	`catatan`='$catatan, $knorm' where `id_absensi`='$id_absensi'";
	process($conn,$sqld);
	
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small><label title='$knorm'>$no</label></small></td>
				<td><small>$hari,$tanggal_masuk</small></td>
				<td><small>$id_karyawan-$id_finger</small></td>
				<td><small>$nama_karyawan</small></td>
				<td><small>$jam_masuk</small></td>
				<td><small>$jam_pulang</small></td>
				<td><small>$lamakerja</small></td>
				<td><small>$lembur</small></td>
				<td><small>$norm</small></td>
				<td><small><small><i>$catatan</i></small></small></td>
				

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data absensi belum tersedia...</blink></td></tr>";}
?>
</table>
