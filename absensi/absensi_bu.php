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
win=window.open('absensi/absensi_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

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
    $( "#accordion" ).accordion({
      collapsible: true
    });
  } );
  </script>
	
	
    <div id="accordion">
<?php  
  $sqlc="select distinct(`id_mesin`) from `$tbabsensi` JOIN `$tbkaryawan` ON `$tbabsensi`.id_finger = `$tbkaryawan`.id_finger where  `$tbkaryawan`.id_karyawan='".$_SESSION['cid']."' order by `$tbabsensi`.status asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data absensi belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$id_mesin=$dc["id_mesin"];
				$mesin=getMesin($conn,$id_mesin);
				$sql = "select * from `$tbabsensi` JOIN `$tbkaryawan` ON `$tbabsensi`.id_finger = `$tbkaryawan`.id_finger where  `$tbkaryawan`.id_karyawan='".$_SESSION['cid']."' and `id_mesin`='$id_mesin' order by `$tbabsensi`.id_absensi desc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Absensi <?php echo $_SESSION['cnama'];?> di <?php echo "$mesin|CM-$id_mesin ($jum Data)"?>:</h3>
<div>				
 
<br>

| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $IDR;?>')"> |
 <a href='absensi/excel.php?pk=<?php echo $IDR;;?>'>
 <img src='ypathicon/xls.png' title='Export ke Excel'></a> |

<br>
<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
    <th width="20%"><small>Masuk</small></td>
    <th width="20%"><small>Pulang</small></td>
	 <th width="20%"><small>Keterangan</small></td>
  </tr>
<?php  

		if($jum > 0){
//--------------------------------------------------------------------------------------------
$batas   = 10;
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
				$tanggal_masuk=WKT($d["tanggal_masuk"]);
				$jam_masuk=$d["jam_masuk"];
				$tanggal_pulang=WKT($d["tanggal_pulang"]);
				$jam_pulang=$d["jam_pulang"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
		
				
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$tanggal_masuk $jam_masuk</small></td>
				<td><small>$tanggal_pulang $jam_pulang</small></td>
				<td><small>$keterangan</small></td>
				
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
}//for atas
?>

  </div>

	
	