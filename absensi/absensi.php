<?php
require_once 'vendor/autoload.php';
use Shuchkin\SimpleXLSX;

$pro="simpan";
$id_absensi="";
$id_mesin="";
$id_finger="";
$tanggal_masuk=WKT(date("Y-m-d"));
$jam_masuk=date("H:i:s");
$tanggal_pulang=WKT(date("Y-m-d"));
$jam_pulang=date("H:i:s");
$status="Masuk";
$keterangan="";
//$PATH="ypathcss";
?> 


<script type="text/javascript">
var xmlHttp;

function showUp(str){ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){
 alert ("Browser tidak support HTTP Request");
 return;
 } 
var url="getMesin.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=SC1;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function SC1() { 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText ;
 } 
}

function showUp2(str){ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){
 alert ("Browser tidak support HTTP Request");
 return;
 } 
var url="getFinger.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=SC2;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function SC2() { 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 document.getElementById("txtHint2").innerHTML=xmlHttp.responseText ;
 } 
}
function GetXmlHttpObject(){
var xmlHttp=null;
try{xmlHttp=new XMLHttpRequest();}
catch (e){
	try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
 	catch (e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
 }
return xmlHttp;
}
</script>
<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('absensi/absensi_printf.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_absensi=$_GET["kode"];
	$sql="select * from `$tbabsensi` where `id_absensi`='$id_absensi'";
	$d=getField($conn,$sql);
				$id_absensi=$d["id_absensi"];
				$id_absensi0=$d["id_absensi"];
				$id_mesin=$d["id_mesin"];
				$id_finger=$d["id_finger"];
				$tanggal_masuk=WKT($d["tanggal_masuk"]);
				$jam_masuk=$d["jam_masuk"];
				$tanggal_pulang=WKT($d["tanggal_pulang"]);
				$jam_pulang=$d["jam_pulang"];
				$status=$d["status"];
				$keterangan=$d["keterangan"]; 
				$pro="ubah";		
}
?>

 <link rel="stylesheet" href="jsacordeon/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
  <script src="jsacordeon/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordiona" ).accordion({
      collapsible: true
    });
  } );
  </script>
	
 

 <h3>Masukan Data Absensi</h3>
  <div>
<form name="import_export_form" method="post" action="" enctype="multipart/form-data">
<table width="60%">
<tr>
<td><label  class="btn btn-dark">Pilih File Data Absensi :</label>
<td><input type="file" id="excelfile" required name="excelfile"  class="btn btn-light"/>
<td><input type="submit" id="import"  value="IMPORT" name="IMPORTY" class="btn btn-warning"/>
<td><a href="downloadgetfile.php?file=cthData.xlsx">
	<input type="button" id="import" value="DOWNLOAD" name="Download" class="btn btn-success"/>
	</a>
</tr>
</table>
</form>	

			
<form action="" method="post" enctype="multipart/form-data">
<table class="table">

<tr>
<td><label for="id_mesin">ID Mesin</label>
<td>:<td><input disabled required name="id_mesin" class="form-control" type="number" id="id_mesin" value="<?php echo $id_mesin;?>" style="width:200px;"   onchange="showUp(this.value)" />
<div id="txtHint"></div>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="id_finger">ID Finger</label>
<td>:<td><input   required name="id_finger" type="number" class="form-control" id="id_finger" value="<?php echo $id_finger;?>" style="width:200px;"   onchange="showUp2(this.value)" />
<div id="txtHint2"></div>
</td>
</tr>

<tr>
<td height="24"><label for="tanggal_masuk">Tanggal Masuk</label>
<td>:<td><input required  name="tanggal_masuk" type="text" class="form-control" id="tanggal_masuk" value="<?php echo $tanggal_masuk;?>" style="width:200px;"   /></td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="jam_masuk">Jam Masuk</label>
<td>:<td><input  required   name="jam_masuk" type="jam_masuk" class="form-control" id="jam_masuk" value="<?php echo $jam_masuk;?>" style="width:200px;"   /></td>

<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){?>
<tr>
<td height="24"><label for="tanggal_pulang">Tanggal Pulang</label>
<td>:<td><input  required name="tanggal_pulang" type="text" class="form-control" id="tanggal_pulang" value="<?php echo $tanggal_pulang;?>" style="width:200px;"   />
</td>
 
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
<td height="24"><label for="jam_pulang">Jam Pulang</label>
<td>:<td><input  required name="jam_pulang" type="jam_pulang" class="form-control" id="jam_pulang" value="<?php echo $jam_pulang;?>" style="width:200px;"   />
</td>
</tr>


<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Masuk" <?php if($status=="Masuk"){echo"checked";}?>/>Masuk 
<input type="radio" name="status" checked id="status" value="Pulang" <?php if($status=="Pulang"){echo"checked";}?>/>Pulang
</td>
<td><label for="keterangan">Keterangan</label>
<td>:<td><input   name="keterangan" type="text" class="form-control" id="keterangan" value="<?php echo $keterangan;?>" style="width:200px;"   />
</td>
</tr>
<?php } ?>
<tr>
<td>
<td>
<td colspan="4"><input name="Simpan" type="submit" class="btn btn-primary"  id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
		<input name="id_mesin" type="hidden" id="id_mesin" value="<?php echo $id_mesin;?>" />
        <input name="id_absensi" type="hidden" id="id_absensi" value="<?php echo $id_absensi;?>" />
        <input name="id_absensi0" type="hidden" id="id_absensi0" value="<?php echo $id_absensi0;?>" />
        <a href="?mnu=absensi"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
  </div>
  
<?php 
 if(isset($_POST['IMPORTX'])){
		require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$filename = $_FILES['excelfile']['tmp_name'];
		$nf = $_FILES['excelfile']['name'];
		$data->read($filename);
	 
	$sql="Truncate $tbabsensi";
	process($conn,$sql);

	
	$n=0;
	for($x =1; $x <=count ($data->sheets[0]["cells"]); $x++){
		$id_mesin = $data->sheets[0]["cells"][$x][1];
		$id_finger= $data->sheets[0]["cells"][$x][2];
		$tanggal_masuk= $data->sheets[0]["cells"][$x][3];
		$jam_masuk= $data->sheets[0]["cells"][$x][4];
		$jam_pulang= $data->sheets[0]["cells"][$x][5]; 
		$tanggal_pulang=$tanggal_masuk; 
		$status="Pulang"; 
		$keterangan="";
		$n++;
  $sql=" INSERT INTO $tbabsensi (
`id_mesin` ,
`id_finger` ,
`tanggal_masuk` ,
`jam_masuk` ,
`tanggal_pulang` ,
`jam_pulang` ,
`status` ,
`keterangan`
) VALUES (
'$id_mesin',
'$id_finger',
'$tanggal_masuk',
'$jam_masuk', 
'$tanggal_pulang',
'$jam_pulang',
'$status',
'$keterangan'
)";
$simpan=process($conn,$sql);
}//for
echo "<script>berhasil('absensi','Import Data absensi dari $nf Sebanyak $n Berhasil');</script>";

}//isset
 


 if(isset($_POST['IMPORTY'])){
$sql="Truncate $tbabsensi";
//process($conn,$sql);
		$filename = $_FILES['excelfile']['tmp_name'];
		$nf = $_FILES['excelfile']['name'];
$sql="select id_absensi from `$tbabsensi` where `keterangan`='$nf'";
$ada=getJum($conn,$sql);
if($ada>0){
	echo "<script>berhasil('absensi','Import Data Absensi $nf Gagal..Karena Sudah diimport sebelumnya...');</script>";
}
else{
$no=0;
$xlsx = new SimpleXLSX($filename);
if ( $xlsx->success() ) {
    foreach( $xlsx->rows() as $r ) {
		$no++;
      if(!empty($r[1])&& $no>2){ 
		$id_mesin=$r[1];
		$id_finger=$r[2];
		$tanggal_masuk=$r[3];
		$tanggal_pulang=$tanggal_masuk;
		$jam_masuk=$r[4];
		$jam_pulang=$r[5];
		$status="Pulang"; 
		$keterangan="$nf";
		
  $sql=" INSERT INTO $tbabsensi (
`id_mesin` ,
`id_finger` ,
`tanggal_masuk` ,
`jam_masuk` ,
`tanggal_pulang` ,
`jam_pulang` ,
`status` ,
`keterangan`
) VALUES (
'$id_mesin',
'$id_finger',
'$tanggal_masuk',
'$jam_masuk', 
'$tanggal_pulang',
'$jam_pulang',
'$status',
'$keterangan'
)";
$simpan=process($conn,$sql);
	  }
    }

echo "<script>berhasil('absensi','Import Data absensi dari $nf Sebanyak $no Berhasil');</script>";
} else {
    echo 'xlsx error: '.$xlsx->error();
}
}
 }
?>			
<div id="accordion">
   
<?php  
  $sqlc="select distinct(`id_finger`) from `$tbabsensi` order by `id_finger` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data absensi belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
	$gabs="| ";
		foreach($arrc as $dc) {						
				$id_finger=$dc["id_finger"];  
				$sqlv="select * from `$tbkaryawan` where `id_finger`='$id_finger'";
				$adv=getJum($conn,$sqlv)+0;
				$nama_karyawan="$id_finger";
				$id_karyawan="0"; 
					if($adv>0){
						$dv=getField($conn,$sqlv);
						$id_rekanan=$dv["id_rekanan"];
						$id_karyawan=$dv["id_karyawan"];
						$nama_karyawan=$dv["nama_karyawan"];
						$deskripsi=$dv["deskripsi"];
						$telepon=$dv["telepon"];
						$email=$dv["email"];
					}
		$gabs.="<a href='?mnu=absensi&idf=$id_finger'>$nama_karyawan</a> | ";			
	}
echo $gabs;
if(isset($_GET["idf"])){
	$id_finger=$_GET["idf"];
	$sqlv="select * from `$tbkaryawan` where `id_finger`='$id_finger'";
				$adv=getJum($conn,$sqlv)+0;
				$nama_karyawan="$id_finger";
				$id_karyawan="0"; 
					if($adv>0){
						$dv=getField($conn,$sqlv);
						$id_rekanan=$dv["id_rekanan"];
						$id_karyawan=$dv["id_karyawan"];
						$nama_karyawan=$dv["nama_karyawan"];
						$deskripsi=$dv["deskripsi"];
						$telepon=$dv["telepon"];
						$email=$dv["email"];
					}
}

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
		
$sql = "select * from `$tbabsensi` where  `id_finger`='$id_finger' 
order by `id_absensi` asc ";
$jum = getJum($conn, $sql); ;
	?>
		<h3>Data Absensi <?php echo "$nama_karyawan /Finger-$id_finger ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_karyawan;?>')"> |
<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
	<th width="15%"><small>Tanggal</small></td>
    <th width="5%"><small>IDKRY</small></td>
	<th width="20%"><small>Nama Karyawan</small></td>
    <th width="5%"><small>Masuk</small></td>
    <th width="5%"><small>Pulang</small></td>
	<th width="5%"><small>Lama</small></td>
	<th width="5%"><small>Lembur</small></td>
	<th width="10%"><small>Norm</small></td> 
	<th width="20%"><small>Keterangan</small></td>
    <th width="13%"><small>Menu</small></td>
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
				if($cek==0){$tanggal_masuk="<strike><font color='red'>$tanggal_masuk</font></strike>";}
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

if($jnorm<0){$jnorm=0;}
$gnorm=$jnorm;	
if($cek==0){$gnorm=0;}
		$sqld="update `$tbabsensi` set 
	`hari`='$hari',`kategori`='$kategori',
	`lamakerja`='$lamakerja0',
	`lembur`='$lamakerja1' ,
	`kalibrasi`='$gnorm' ,`kalibrasi0`='$jnorm' ,
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
				<td><small>$jnorm ->$gnorm</small></td>
				<td><small><small><i>$catatan</i></small></small></td>
				<td><div align='center'>
<a href='?mnu=absensi&pro=ubah&kode=$id_absensi'><img src='ypathicon/ub.png' title='ubah'></a>
 <a href='#' onclick='deleteData(\"$id_absensi\")'><img src='ypathicon/ha.png' title='hapus'></a>

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data absensi belum tersedia...</blink></td></tr>";}
?>
</table>

<?php
$jmldata = $jum;
if($jmldata>0){
	if($batas<1){$batas=1;}
	$jmlhal  = ceil($jmldata/$batas);
	echo "<div class=paging>";
	if($page > 1){
		$prev=$page-1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=absensi'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=absensi'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=absensi'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";

echo"</div>"; 
?>

  </div>

	
	
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$id_absensi=strip_tags($_POST["id_absensi"]);
	$id_absensi0=strip_tags($_POST["id_absensi0"]);
	$id_mesin=strip_tags($_POST["id_mesin"]);
	$id_finger=strip_tags($_POST["id_finger"]);
	$tanggal_masuk=date("Y-m-d");
	$jam_masuk=date("H:i:s");
	$tanggal_pulang=date("Y-m-d");
	$jam_pulang=date("H:i:s");
	
	
	
if($pro=="simpan"){
 $sql=" INSERT INTO `$tbabsensi` (
`id_mesin` ,
`id_finger` ,
`tanggal_masuk` ,
`jam_masuk` ,
`tanggal_pulang` ,
`jam_pulang` ,
`status` ,
`keterangan`
) VALUES (
'$id_mesin',
'$id_finger',
'$tanggal_masuk',
'$jam_masuk', 
'$tanggal_pulang',
'$jam_pulang',
'Masuk',
'-'
)";
	
$simpan=process($conn,$sql);
	if($simpan === TRUE) {
	echo"<script>berhasil('absensi','Sukses Simpan');</script>";}
		else{
			echo"<script>gagal('absensi','Gagal Simpan');</script>";}
	}
	else{
		$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbabsensi` set 
	`id_mesin`='$id_mesin',
	`id_finger`='$id_finger',
	`tanggal_pulang`='$tanggal_pulang' ,
	`jam_pulang`='$jam_pulang',
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_absensi`='$id_absensi0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('absensi','Sukses Ubah');</script>";}
		else{echo"<script>gagal('absensi','Gagal Ubah');</script>";}
	}//else simpan
}
?>

<?php
if (isset($_POST['delete'])) {
    $id_absensi = $_POST['delete_id'];

    $sql = "DELETE FROM `$tbabsensi` WHERE `id_absensi`='$id_absensi'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire('Sukses', 'Data telah dihapus!', 'success').then(() => {
                location.reload();
            });
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<script>
function deleteData(id_absensi) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Anda tidak akan dapat mengembalikannya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(window.location.href, {
                method: 'POST',
                body: `delete=1&delete_id=${id_absensi}`,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            }).then(response => {
                if (response.status === 200) {
                    Swal.fire('Sukses', 'Data telah dihapus!', 'success').then(() => {
                        window.location.reload(); // Refresh the page
                    });
                }
            });
        }
    });
}
</script>