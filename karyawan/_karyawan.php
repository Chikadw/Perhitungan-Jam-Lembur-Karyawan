 <script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('karyawan/karyawan_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
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
 		
				$id_rekanan=$_GET["id"];
				$rekanan=getRekanan($conn,$id_rekanan);
				$sql = "select * from `$tbkaryawan` where  `id_rekanan`='$id_rekanan' order by `id_karyawan` asc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Karyawan <?php echo "$rekanan ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $id_rekanan;?>')"> |
<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
    <th width="35%"><small>Nama Karyawan</small></td>
    <th width="7%"><small><?php echo $gj1;?></small></td>
    <th width="7%"><small><?php echo $gj2;?></small></td>
    <th width="7%"><small><?php echo $gj3;?></small></td>
    <th width="7%"><small><?php echo $gj4;?></small></td>
	 <th width="40%"><small>Keterangan</small></td>
  </tr>
<?php  
		if($jum > 0){ 
$no=1;		
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_karyawan=$d["id_karyawan"];
				$id_rekanan=$d["id_rekanan"];
				$rekanan=getRekanan($conn,$d["id_rekanan"]);
				$id_finger=$d["id_finger"];
				$nama_karyawan=$d["nama_karyawan"];
				$deskripsi=$d["deskripsi"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$gaji1=RP($d["gaji1"]);
				$gaji2=RP($d["gaji2"]);
				$gaji3=RP($d["gaji3"]);
				$gaji4=RP($d["gaji4"]);
				$gaji5=RP($d["gaji5"]);
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
<td><small>$no</small></td>
<td><small><a href='mailto: $email' title='$email'><b>$nama_karyawan ($id_finger)</b></a>
<br><i>Telp. $telepon, Status $status Catatan: $deskripsi</i></small></td>
<td><small>$gaji1</small></td>
<td><small>$gaji2</small></td>
<td><small>$gaji3</small></td>
<td><small>$gaji4</small></td>
<td><small>$keterangan</small></td>

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data karyawan belum tersedia...</blink></td></tr>";}
?>
</table>
