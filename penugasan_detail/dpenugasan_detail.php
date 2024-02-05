<?php

$tanggal=WKT(date("Y-m-d"));
$pro="simpan";
$ipd="";
$id_penugasan="";
$id_karyawan="";
$catatan="";
//$PATH="ypathcss";
?> 


<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('penugasan_detail/penugasan_detail_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
	$id_penugasan=$_GET["id"];
	$sql="select * from `$tbpenugasan` where `id_penugasan`='$id_penugasan'";
	$d=getField($conn,$sql);
				$id_penugasan=$d["id_penugasan"];
				$id_penugasan0=$d["id_penugasan"];
				$nama_penugasan=$d["nama_penugasan"];
				$deskripsi=$d["deskripsi"];
				$id_rekanan=$d["id_rekanan"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				$id_karyawan=$d["id_karyawan"];
				$nama_karyawan=getKaryawan($conn,$id_karyawan);
				
	$rekanan=strtoupper(getRekanan($conn,$id_rekanan));			
	$catatan="Penugasan Lembur $keterangan";		
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
	<?php
require_once"krekanan.php";
?>	
	
    <div id="accordion">
  <h3> Detail Penugasan</h3>
  <div>
						 
<table class="table">
<tr>
<th width="119"><label for="id_penugasan">ID Penugasan</label>
<th width="10">:
<th colspan="2"><b><?php echo $id_penugasan;?></b></tr>
<tr>
<td><label for="nama_penugasan">Nama Penugasan</label>
<td>:<td width="396"><?php echo $nama_penugasan;?>
</td>
</tr>
<tr>
<td height="24"><label for="deskripsi">Deskripsi</label>
<td>:<td><?php echo $deskripsi;?>
</td>
</tr>
<tr>
<td height="24"><label for="id_rekanan">PT Rekanan</label>
<td>:<td><?php echo $rekanan." ($id_rekanan)";?></td>
</tr>
<tr>
<td height="24"><label for="id_rekanan">Karyawan Ditunjuk</label>
<td>:<td><?php echo $nama_karyawan." (NIK-0$id_karyawan)";?></td>
</tr>
<tr>
<td height="24"><label for="deskripsi">Status</label>
<td>:<td><?php echo "$status, $keterangan";?>
</td>
</tr>
</table> 
 
<hr>
<b><?php echo "$nama_karyawan/NIK-0$id_karyawan ($rekanan | $id_rekanan)";?></b>
<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%">No</td>
	 <th width="20%">Tanggal Lembur</td>
	 <th width="65%">Catatan</td> 
  </tr>
<?php  
$sql="select * from `$tbpenugasan_detail` where  `id_penugasan`='$id_penugasan' order by `ipd` asc";
  $jum=getJum($conn,$sql);
		if($jum > 0){ 		
			$no=1;
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$ipd=$d["ipd"];
				$id_penugasan=$d["id_penugasan"];
				$tanggal=WKT($d["tanggal"]); 
				$catatan=$d["catatan"];
				 
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</td>
				<td><small>$tanggal</td>
				<td><small>$catatan</small></td>
				 			</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
?>
</table> 
 </div>

  </div>

	