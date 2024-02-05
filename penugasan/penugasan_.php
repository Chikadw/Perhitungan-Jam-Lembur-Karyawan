  
<script type="text/javascript"> 
function PRINT(pk,pk2){ 
win=window.open('penugasan/penugasan_print2.php?pk='+pk+'&pk2='+pk2,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

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
 require_once"krekanan.php";
?>	
<div id="accordion"> 
<?php  
					
$id_karyawan=$_SESSION["cid"];
$karyawan=getKaryawan($conn,$id_karyawan);
$sql = "select * from `$tbpenugasan` where  id_karyawan='$id_karyawan' order by `id_penugasan` desc";
$jum = getJum($conn, $sql);
?>
		<h3>Data Penugasan <?php echo "$karyawan |NIK-0$id_karyawan ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT'
 OnClick="PRINT('<?php echo $id_rekanan;?>','<?php echo $id_karyawan;?>')"> |
<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
    <th width="80%"><small>Nama Penugasan</small></td>
	<th width="5%"><small>Status</small></td>
	<th width="13%"><small>List</small></td>
  </tr>
<?php  
		if($jum > 0){
//------------------------------ 
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
				$id_penugasan=$d["id_penugasan"];
				$nama_penugasan=ucwords($d["nama_penugasan"]);
				$deskripsi=$d["deskripsi"];
				$id_rekanan=$d["id_rekanan"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				 
				
	$sqlv="select * from `$tbpenugasan_detail` where `id_penugasan`='$id_penugasan'";
	$sdh=getJum($conn,$sqlv);
	$gab="";
	$ada=0;
	if($sdh>0){
	$arrv=getData($conn,$sqlv);
	$gab="Lembur: ";
		foreach($arrv as $dv) {	
			$ada++;		
				$id_penugasan=$dv["id_penugasan"];
				$tanggal=WKTP($dv["tanggal"]); 
				$catatan=$dv["catatan"]; 
					$gab.="<small><label title='$tanggal $catatan'>$tanggal</label></small>,";
					$ada++;
		}
		$gab.="$ada Hari";
	}//jum
	else{
		$gab="<small>Data Penugasan Lembur Belum Tersedia</small>";
	}
	
	 
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$nama_penugasan ($id_penugasan)</b>
				<br><i>$deskripsi, Catatan: $keterangan</i></small>
				<br>$gab
				</td>
				<td><small>$status</td>
				<td><div align='center'>
					<a href='?mnu=dpenugasan_detail&id=$id_penugasan'><img src='ypathicon/xls.png' title='Detail Penugasan'></a> 
				 

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data penugasan belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=penugasan_'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=penugasan_'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=penugasan_'>Next »</a></span>";
	}
	else{ echo "<span class=disabled>Next »</span>";}
	echo "</div>";
	}//if jmldata

$jmldata = $jum;
echo "<p align=center>Total data <b>$jmldata</b> item</p>";

echo"</div>"; 
?> 
</div>
 