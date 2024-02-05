 
<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('penggajian/penggajian_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>
 
 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#examplec').DataTable();
} );
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<?php   
$id_karyawan=$_SESSION["cid"];
$sql = "select * from `$tbpenggajian` where id_karyawan='$id_karyawan' order by `id_penggajian` desc";
$jum = getJum($conn, $sql);
	?> 
<table id="examplec" class="display" style="width:100%">
        <thead>
            
     
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
	<th width="20%"><small>Periode</small></td>
	<th width="20%"><small>Karyawan</small></td>
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
     </thead>
        <tbody>
<?php  
		if($jum > 0){ 		
$no=1;		
	$arr=getData($conn,$sql);
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
				<td><small>$karyawan (KRY0$id_karyawan)</small></td>
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
</tbody>
<tfoot></tfoot>
</table>
 
</div>
 