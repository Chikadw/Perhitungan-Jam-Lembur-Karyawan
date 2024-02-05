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
require_once"hrekanan.php";
?>	
	
    <div id="accordion">
  <h3> Detail Penugasan</h3>
  <div>
						
<form action="" method="post" enctype="multipart/form-data">
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
</form>

<?php
$tanggal="";
$ipd="";
$ipd0="";
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$ipd=$_GET["kode"];
	$sql="select * from `$tbpenugasan_detail` where `ipd`='$ipd'";
	$d=getField($conn,$sql);
				$ipd=$d["ipd"];
				$ipd0=$d["ipd"];
				$id_penugasan=$d["id_penugasan"];
				$tanggal=$d["tanggal"];
				$catatan=$d["catatan"];
				$pro="ubah";		
}
?>


			
<form action="" method="post" enctype="multipart/form-data">
<table class="table">

<tr>
<td height="24"><label for="tanggal">Pilih Tanggal</label>
<td>:<td> 
<input  required name="tanggal" type="date" class="form-control" id="tanggal" value="<?php echo $tanggal;?>" style="width:250px;" />
</td>
</tr> 

<tr>
<td height="24"><label for="catatan">Catatan Penugasan</label>
<td>:<td> 
<input  required name="catatan" type="text" class="form-control" id="catatan" value="<?php echo $catatan;?>" style="width:550px;" />
</td>
</tr> 
<tr>
<td>
<td>
<td colspan="2">
<input name="Simpan" type="submit" class="btn btn-primary"  id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="id_penugasan" type="hidden" id="id_penugasan" value="<?php echo $id_penugasan;?>" />
        <input name="ipd0" type="hidden" id="ipd0" value="<?php echo $ipd0;?>" />
		<input name="ipd" type="hidden" id="ipd" value="<?php echo $ipd;?>" />
        <a href="?mnu=penugasan_detail&id=<?php echo $id_penugasan;?>"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
<br>
<b><?php echo "$nama_karyawan/NIK-0$id_karyawan ($rekanan | $id_rekanan)";?></b>
<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%">No</td>
	 <th width="20%">Tanggal Lembur</td>
	 <th width="65%">Catatan</td>
    <th width="15%"><small>Menu</small></td>
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
				<td><div align='center'>
<a href='?mnu=penugasan_detail&pro=ubah&kode=$ipd&id=$id_penugasan'><img src='ypathicon/ub.png' title='ubah'></a>
 <label onclick='deleteData(\"$ipd\")'><img src='ypathicon/ha.png' title='hapus'></label>

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data belum tersedia...</blink></td></tr>";}
?>
</table>

<?php 
echo"</div>";
?>

  </div>

	
	
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$id_penugasan=strip_tags($_POST["id_penugasan"]);
	$tanggal=strip_tags($_POST["tanggal"]); 
	$catatan=strip_tags($_POST["catatan"]); 

if($pro=="simpan"){
	 $sql="select `ipd` from `$tbpenugasan_detail` where `tanggal`='$tanggal' and `id_penugasan`='$id_penugasan'";
	$q = mysqli_query($conn, $sql);
	$ada = mysqli_num_rows($q);
	if($ada>0){
	echo"<script>gagal('rpenugasan_detail&id=$id_penugasan','Gagal Simpan');</script>";
	}	
else{	
 $sql=" INSERT INTO `$tbpenugasan_detail` (
`id_penugasan` ,
`tanggal` ,
`catatan` 
) VALUES (
'$id_penugasan',
'$tanggal',
'$catatan'
)"; 
$simpan=process($conn,$sql);
  
	if($simpan === TRUE) {
	echo"<script>berhasil('rpenugasan_detail&id=$id_penugasan','Data Sebanyak $total Sukses Simpan');</script>";
	}
		else{
			echo"<script>gagal('rpenugasan_detail&id=$id_penugasan','Gagal Simpan');</script>";
			}
}
}
else{
	$ipd=strip_tags($_POST["ipd"]);
	$sql=" UPDATE `$tbpenugasan_detail` set `tanggal`='$tanggal' ,`catatan`='$catatan' WHERE `ipd`='$ipd'";
	$simpan=process($conn,$sql);
  
	if($simpan === TRUE) {
	echo"<script>berhasil('rpenugasan_detail&id=$id_penugasan','Data Sebanyak $total Sukses Ubah');</script>";
	
	}
		else{
			echo"<script>gagal('rpenugasan_detail&id=$id_penugasan','Gagal Ubah');</script>";}
	
}
}
	
?>

<?php
if (isset($_POST['delete'])) {
    $ipd = $_POST['delete_id'];
	//$id = $_POST['id'];

    $sql = "DELETE FROM `$tbpenugasan_detail` WHERE `ipd`='$ipd'";
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
function deleteData(ipd) {
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
                body: `delete=1&delete_id=${ipd}`,
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