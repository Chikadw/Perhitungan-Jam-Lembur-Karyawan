<?php

$tanggal=WKT(date("Y-m-d"));
$pro="simpan";
$status="Aktif";
$id_rekanan="";
$nama_rekanan="";
$deskripsi="";
$alamat="";
$logo0="avatar.jpg";
$id_mesin="";
$keterangan="";
//$PATH="ypathcss";
?> 


<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('rekanan/rekanan_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
$sql = "select `id_rekanan` from `tb_rekanan` order by `id_rekanan` desc";
 $jum= getJum($conn,$sql);
  $kd="RKN";
		if($jum > 0){
				$d=getField($conn,$sql);
    			$idmax=$d['id_rekanan'];	
				$urut=substr($idmax,3,2)+1;//01
				if($urut<10){$idmax="$kd"."0".$urut;}
				else{$idmax="$kd".$urut;}
			}
		else{$idmax="$kd"."01";}
$id_rekanan = $idmax;
?>

<?php
$username="";
$password="";
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_rekanan=$_GET["kode"];
	$sql="select * from `$tbrekanan` where `id_rekanan`='$id_rekanan'";
	$d=getField($conn,$sql);
				$id_rekanan=$d["id_rekanan"];
				$id_rekanan0=$d["id_rekanan"];
				$nama_rekanan=$d["nama_rekanan"];
				$deskripsi=$d["deskripsi"];
				$alamat=$d["alamat"];
				$logo=$d["logo"];
				$logo0=$d["logo"];
				$id_mesin=$d["id_mesin"];
				$username=$d["username"];
				$password=$d["password"];
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
  <h3>Masukan Data Rekanan</h3>
  <div>
			
			
<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<tr>
<th width="119"><label for="id_rekanan">ID Rekanan</label>
<th width="10">:
<th colspan="2"><b><?php echo $id_rekanan;?></b></tr>
<tr>
<td><label for="nama_rekanan">Nama Rekanan</label>
<td>:<td width="396"><input required name="nama_rekanan" class="form-control" type="text" id="nama_rekanan" value="<?php echo $nama_rekanan;?>" size="25" />
</td>
</tr>
<tr>
<td height="24"><label for="deskripsi">Deskripsi</label>
<td>:<td>
<textarea name="deskripsi" cols="55" class="form-control" rows="2"><?php echo $deskripsi;?></textarea>
</td>
</tr>

<tr>
<td height="24"><label for="alamat">Alamat</label>
<td>:<td>
<textarea name="alamat" cols="55" class="form-control" rows="2"><?php echo $alamat;?></textarea>
</td>
</tr>

<tr>
<td><label for="logo">Logo</label>
<td>:<td colspan="2"><input name="logo" type="file" id="logo" size="20" /><?php echo $logo0; ?>
</td>
</tr>

<tr>
<td height="24"><label for="id_mesin">ID /Nomor Mesin</label>
<td>:<td><input required  name="id_mesin" type="text" class="form-control" id="id_mesin" value="<?php echo $id_mesin;?>" size="25" /></td>
</tr>

<tr>
<td height="24"><label for="username">Username</label>
<td>:<td><input required  name="username" type="text" class="form-control" id="username" value="<?php echo $username;?>" size="25" /></td>
</tr>

<tr>
<td height="24"><label for="password">Password</label>
<td>:<td><input  required   name="password" type="password" class="form-control" id="password" value="<?php echo $password;?>" size="25" /></td>
</tr>
<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){?>
<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Aktif" <?php if($status=="Aktif"){echo"checked";}?>/>Aktif 
<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if($status=="Tidak Aktif"){echo"checked";}?>/>Tidak Aktif
</td></tr>

<tr>
<td height="24"><label for="keterangan">Keterangan</label>
<td>:<td>
<textarea name="keterangan" cols="55" class="form-control" rows="2"><?php echo $keterangan;?></textarea>
</td>
</tr>
<?php } ?>
<tr>
<td>
<td>
<td colspan="2"><input name="Simpan" type="submit" class="btn btn-primary"  id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="logo0" type="hidden" id="logo0" value="<?php echo $logo0;?>" />
        <input name="id_rekanan" type="hidden" id="id_rekanan" value="<?php echo $id_rekanan;?>" />
        <input name="id_rekanan0" type="hidden" id="id_rekanan0" value="<?php echo $id_rekanan0;?>" />
        <a href="?mnu=rekanan"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
  </div>
<?php  
  $sqlc="select distinct(`status`) from `$tbrekanan` order by `status` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data rekanan belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$status=$dc["status"];
				$sql = "select * from `$tbrekanan` where  `status`='$status' order by `id_rekanan` desc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Rekanan <?php echo "$status ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $status;?>')"> |
<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
    <th width="10%"><small>Logo</small></td>
    <th width="50%"><small>Nama Rekanan</small></td>
    <th width="3%"><small>IDMesin</small></td>
	 <th width="20%"><small>Keterangan</small></td>
    <th width="13%"><small>Menu</small></td>
  </tr>
<?php  
		if($jum > 0){ 
	$no=1;
		$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_rekanan=$d["id_rekanan"];
				$nama_rekanan=ucwords($d["nama_rekanan"]);
				$deskripsi=$d["deskripsi"];
				$alamat=$d["alamat"];
				$logo=$d["logo"];
				$logo0=$d["logo"];
				$id_mesin=$d["id_mesin"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><div align='center'>";
			echo "<a href='#' onclick='buka(\"rekanan/zoom.php?id=$id_rekanan\")'>
<img src='$YPATH/$logo' width='40' height='40' /></a></div>";
			echo "</td>
				<td><small>$nama_rekanan ($id_rekanan)<i> |$deskripsi</i><br>Alamat: $alamat</small></td>
				<td><small>$id_mesin</td>
				<td><small>$keterangan</small></td>
				<td><div align='center'>
<a href='?mnu=_karyawan&id=$id_rekanan'>
<img src='ypathicon/xls.png' title='List Karyawan'></a>
<br>
<a href='?mnu=rekanan&pro=ubah&kode=$id_rekanan'>
<img src='ypathicon/ub.png' title='ubah'></a>
 <button onclick='deleteData(\"$id_rekanan\")'><img src='ypathicon/ha.png' title='hapus'></button>

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data rekanan belum tersedia...</blink></td></tr>";}
?>
</table>

<?php 
echo"</div>";
}//for atas
?>

  </div>
	
	
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$id_rekanan=strip_tags($_POST["id_rekanan"]);
	$id_rekanan0=strip_tags($_POST["id_rekanan0"]);
	$nama_rekanan=strip_tags($_POST["nama_rekanan"]);
	$deskripsi=strip_tags($_POST["deskripsi"]);
	$alamat=strip_tags($_POST["alamat"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$logo0 = strip_tags($_POST["logo0"]);
	if ($_FILES["logo"] != "") {
		move_uploaded_file($_FILES["logo"]["tmp_name"], "$YPATH/" . $_FILES["logo"]["name"]);
		$logo = $_FILES["logo"]["name"];
	} else {
		$logo = $logo0;
	}
	if (strlen($logo) < 1) {
		$logo = $logo0;
	}
	$id_mesin=strip_tags($_POST["id_mesin"]);
	
	
	
if($pro=="simpan"){
 $sql=" INSERT INTO `$tbrekanan` (
`id_rekanan` ,
`nama_rekanan` ,
`deskripsi` ,
`alamat` ,
`logo` ,`username` ,`password` ,
`id_mesin` ,
`status` ,
`keterangan`
) VALUES (
'$id_rekanan', 
'$nama_rekanan',
'$deskripsi',
'$alamat',
'$logo', '$username', '$password',
'$id_mesin',
'Aktif',
'-'
)";
	
$simpan=process($conn,$sql);
	if($simpan === TRUE) {
	echo"<script>berhasil('rekanan','Sukses Simpan');</script>";}
		else{
			echo"<script>gagal('rekanan','Gagal Simpan');</script>";}
	}
	else{
		$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbrekanan` set 
	`nama_rekanan`='$nama_rekanan',`username`='$username',`password`='$password',
	`deskripsi`='$deskripsi',
	`alamat`='$alamat',
	`logo`='$logo',
	`id_mesin`='$id_mesin' ,
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_rekanan`='$id_rekanan0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('rekanan','Sukses Ubah');</script>";}
		else{echo"<script>gagal('rekanan','Gagal Ubah');</script>";}
	}//else simpan
}
?>

<?php
if (isset($_POST['delete'])) {
    $id_rekanan = $_POST['delete_id'];

    $sql = "DELETE FROM `$tbrekanan` WHERE `id_rekanan`='$id_rekanan'";
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
function deleteData(id_rekanan) {
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
                body: `delete=1&delete_id=${id_rekanan}`,
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