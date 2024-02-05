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
 
 <link rel="stylesheet" href="jsacordeon/jquery-ui.css">
  <link rel="stylesheet" href="resources/demos/style.css">
<script src="jsacordeon/jquery-1.12.4.js"></script>
  <script src="jsacordeon/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
	

   
<?php  
					
				$id_karyawan=$_SESSION["cid"];  
				$sqlv="select * from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
				$adv=getJum($conn,$sqlv)+0;
				$nama_karyawan="$id_finger";
				$id_karyawan="0"; 
					if($adv>0){
						$dv=getField($conn,$sqlv);
						$id_finger=$dv["id_finger"];
						$id_rekanan=$dv["id_rekanan"];
						$id_karyawan=$dv["id_karyawan"];
						$nama_karyawan=$dv["nama_karyawan"];
						$deskripsi=$dv["deskripsi"];
						$telepon=$dv["telepon"];
						$email=$dv["email"];
					}
		$gabs="<a href='?mnu=absensi&idf=$id_finger'>$nama_karyawan</a> | ";			
	 
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
	<div id="accordion">
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
	<th width="10%"><small>Keterangan</small></td> 
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
	`kalibrasi`='$jnorm' ,`kalibrasi0`='$gnorm' ,
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=absensi_'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=absensi_'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=absensi_'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";

echo"</div>"; 
?>

  </div>