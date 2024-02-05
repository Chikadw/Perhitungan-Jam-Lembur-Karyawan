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
$username="";
$password="";

	$id_rekanan=$_SESSION["cid"];
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
  <h3>Profil Data Rekanan</h3>
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
<tr>
<td>
<td>
<td colspan="2">
<input name="Simpan" type="submit" class="btn btn-primary"  id="Simpan" value="Update Profil" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="logo0" type="hidden" id="logo0" value="<?php echo $logo0;?>" />
        <input name="id_rekanan" type="hidden" id="id_rekanan" value="<?php echo $id_rekanan;?>" />
        <input name="id_rekanan0" type="hidden" id="id_rekanan0" value="<?php echo $id_rekanan0;?>" />
        <a href="?mnu=profil_rekanan"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
</div> 
  </div>
	
	
<?php
if(isset($_POST["Simpan"])){
	$id_rekanan=strip_tags($_SESSION["cid"]);
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
	 
	 
	$sql="update `$tbrekanan` set 
	`nama_rekanan`='$nama_rekanan',`username`='$username',`password`='$password',
	`deskripsi`='$deskripsi',
	`alamat`='$alamat',
	`logo`='$logo'
	 where `id_rekanan`='$id_rekanan0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('profil_rekanan','Sukses Ubah');</script>";}
		else{echo"<script>gagal('profil_rekanan','Gagal Ubah');</script>";}
	
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