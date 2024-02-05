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
function PRINT(pk){ 
win=window.open('absensi/absensi_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

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
	
	
    <div id="accordion">
 
<?php  
  $sqlc="select distinct(`id_mesin`) from `$tbabsensi` order by `status` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data absensi belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$id_mesin=$dc["id_mesin"];
				$mesin=getMesin($conn,$id_mesin);
				$sql = "select * from `$tbabsensi` where  `id_mesin`='$id_mesin' order by `id_absensi` desc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Absensi <?php echo "$mesin|CM-$id_mesin ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_mesin;?>')"> |

 <a href='absensi/excel.php?pk=<?php echo $id_mesin;;?>'>
 <img src='ypathicon/xls.png' title='Export ke Excel'></a> |

<br>

<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
    <th width="5%"><small>IDKRY</small></td>
	<th width="20%"><small>Nama Karyawan</small></td>
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
				
			$sqlv="select * from `$tbkaryawan` where `id_finger`='$id_finger'";
			$dv=getField($conn,$sqlv);
				$id_rekanan=$dv["id_rekanan"];
				$id_finger=$dv["id_finger"];
				$id_karyawan=$dv["id_karyawan"];
				$nama_karyawan=$dv["nama_karyawan"];
				$deskripsi=$dv["deskripsi"];
				$telepon=$dv["telepon"];
				$email=$dv["email"];
				
				
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$id_karyawan-$id_finger</small></td>
				<td><small>$nama_karyawan</small></td>
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=_absensi'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=_absensi'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=_absensi'>Next »</a></span>";
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

	
	