<?php

$tanggal=WKT(date("Y-m-d"));
$jam=date("H:i:s");
$pro="simpan";
$status="Aktif";
$id_penggajian="";
$id_rekanan="";
$id_karyawan="";
$absen="";
$lembur="";
$pajak="";
$sgaji1="";
$sgaji2="";
$sgaji3="";
$sgaji4="";
$sgaji5="";
$keterangan="";
//$PATH="ypathcss";
$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$bulan=date("m");
$tahun=date("Y");
$periode=$judul_bln[(int)$bulan]." ".$tahun;

?> 

<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('penggajian/penggajian_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

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
  $sqlc="select distinct(`id_rekanan`) from `$tbpenggajian` where `id_karyawan`='".$_SESSION['cid']."' order by `id_rekanan` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data penggajian belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$id_rekanan=$dc["id_rekanan"];
				$IDR=$dc["id_rekanan"];
				
				$rekanan=getRekanan($conn,$id_rekanan);
				$sql = "select * from `$tbpenggajian` where  `id_rekanan`='$id_rekanan' and `id_karyawan`='".$_SESSION['cid']."' order by `id_penggajian` desc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Penggajian <?php echo $_SESSION['cnama'];?> di <?php echo "$rekanan |$id_rekanan ($jum Data)"?>:</h3>
<div>				
 

| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $IDR;?>')"> |
 <a href='penggajian/excel.php?pk=<?php echo $IDR;;?>'>
 <img src='ypathicon/xls.png' title='Export ke Excel'></a> |

<br>
<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
	<th width="20%"><small>Periode</small></td>
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
				$id_penggajian=$d["id_penggajian"];
				$id_rekanan=$d["id_rekanan"];
				$rekanan=getRekanan($conn,$d["id_rekanan"]);
				$id_karyawan=$d["id_karyawan"];
				$karyawan=getKaryawan($conn,$d["id_karyawan"]);
				$periode=$d["periode"];
				$absen=$d["absen"];
				$lembur=$d["lembur"];
				$pajak=$d["pajak"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$sgaji1=RP($d["sgaji1"]);
				$sgaji2=RP($d["sgaji2"]);
				$sgaji3=RP($d["sgaji3"]);
				$sgaji4=RP($d["sgaji4"]);
				$sgaji5=RP($d["sgaji5"]);
				$subtotal=$d["subtotal"];
				$total=RP($d["total"]);
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$periode</small></td>
				<td><small>$absen <small>Hari</small></td>
				<td><small>$lembur <small>Jam</small></td>
				<td><small>$sgaji1</small></td>
				<td><small>$sgaji2</small></td>
				<td><small>$sgaji3</small></td>
				<td><small>$sgaji4</small></td>
				<td><small>$sgaji5</small></td>
				<td><small>$total</small></td>
				<td><small>$keterangan</small></td>
				
				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data penggajian belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=_penggajian'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=_penggajian'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=_penggajian'>Next »</a></span>";
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

	