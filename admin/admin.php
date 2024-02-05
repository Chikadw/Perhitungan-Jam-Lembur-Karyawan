<?php
//0.5 atau setengah jam
/*
weekday: 1jam x 1.5, sisanya 2 dst: x2
weekend: 1jam sd 8 jam x 2, 1 jam sisanya x3, sisanya jam ke10 dst x4
lembur
>9 jam sisanya jk >=30menit(1jam) diangap lembur
<30menit=0.5

>=0menit =0
>=30menit =0.5
>=45menit =0.75
>=60menit =1

*/
$tanggal=WKT(date("Y-m-d"));
$pro="simpan";
$status="Aktif";
$id_admin="";$level="Administrator";
$nama_admin="";
$level="";
$deskripsi="";
$username="";
$password="";
$telepon="";
$email="";
$keterangan="";
//$PATH="ypathcss";
?> 


<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('admin/admin_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
  $sql="select `id_admin` from `$tbadmin` order by `id_admin` desc";
  $jum= getJum($conn,$sql);
  $kd="ADM";
		if($jum > 0){
				$d=getField($conn,$sql);
    			$idmax=$d['id_admin'];	
				$urut=substr($idmax,3,2)+1;//01
				if($urut<10){$idmax="$kd"."0".$urut;}
				else{$idmax="$kd".$urut;}
			}
		else{$idmax="$kd"."01";}
  $id_admin=$idmax;
?>
<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_admin=$_GET["kode"];
	$sql="select * from `$tbadmin` where `id_admin`='$id_admin'";
	$d=getField($conn,$sql);
				$id_admin=$d["id_admin"];
				$id_admin0=$d["id_admin"];
				$nama_admin=$d["nama_admin"];
				$level=$d["level"];
				$deskripsi=$d["deskripsi"];
				$username=$d["username"];
				$password=$d["password"];
				$telepon=$d["telepon"];
				$email=$d["email"];
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
	$(function() {
		$("#accordion").accordion({
			collapsible: true
		});
	});
</script>
	
	
    <div id="accordion">
  <h3>Masukan Data Admin</h3>
  <div>
			
			
<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<tr>
<th width="119"><label for="id_admin">ID Pengguna</label>
<th width="10">:
<th colspan="2"><b><?php echo $id_admin;?></b></tr>
<tr>
<td><label for="nama_admin">Nama Pengguna</label>
<td>:<td width="396"><input required name="nama_admin" class="form-control" type="text" id="nama_admin" value="<?php echo $nama_admin;?>" size="25" />
</td>
</tr>
<tr>
<td><label for="level">Status</label>
<td>:<td colspan="2">
<input type="radio" name="level" id="level"  checked="checked" value="Administrator" <?php if($level=="Administrator"){echo"checked";}?>/>Administrator 
<input type="radio" name="level" id="level" value="HRD" <?php if($level=="HRD"){echo"checked";}?>/>HRD

</td></tr>
<tr>
<td height="24"><label for="deskripsi">Posisi</label>
<td>:<td>
<textarea name="deskripsi" cols="55" class="form-control" rows="2"><?php echo $deskripsi;?></textarea>
</td>
</tr>
<tr>
<td height="24"><label for="telepon">Telepon</label>
<td>:<td><input  required name="telepon" type="number" class="form-control" id="telepon" value="<?php echo $telepon;?>" size="25" />
</td>
</tr>

<tr>
<td height="24"><label for="email">Email</label>
<td>:<td><input  required name="email" type="email" class="form-control" id="email" value="<?php echo $email;?>" size="25" />
</td>
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
        <input name="id_admin" type="hidden" id="id_admin" value="<?php echo $id_admin;?>" />
        <input name="id_admin0" type="hidden" id="id_admin0" value="<?php echo $id_admin0;?>" />
        <a href="?mnu=admin"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
  </div>
<?php  
  $sqlc="select distinct(`status`) from `$tbadmin` order by `status` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data Pengguna belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$status=$dc["status"];
				$sql = "select * from `$tbadmin` where  `status`='$status' order by `id_admin` desc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Pengguna <?php echo "$status ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $status;?>')"> |
<br>

<table class="table">
  <tr bgcolor="#cccccc">
    <th width="3%"><small>No</small></td>
    <th width="5%"><small>IDUSR</small></td>
    <th width="15%"><small>Nama Pengguna</small></td>
	<th width="45%"><small>Posisi</small></td>
    <th width="15%"><small>Telepon</small></td>
	 <th width="5%"><small>Keterangan</small></td>
    <th width="15%"><small>Menu</small></td>
  </tr>
<?php  
		if($jum > 0){ 		
			$no=1;
	$arr=getData($conn,$sql);
		foreach($arr as $d) {						
				$id_admin=$d["id_admin"];
				$nama_admin=ucwords($d["nama_admin"]);
				$level=$d["level"];
				$deskripsi=$d["deskripsi"];
				$username=$d["username"];
				$password=$d["password"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$status=$d["status"];
				$keterangan=$d["keterangan"];
				$ket=$keterangan;
			
				$color="#dddddd";		
					if($no %2==0){$color="#eeeeee";}
echo"<tr bgcolor='$color'>
				<td><small>$no</small></td>
				<td><small>$id_admin</td>
				<td><small><a href='mailto:$email' title='$email'><b>$nama_admin</b></a></small></td>
				<td><small><i>$deskripsi</i></small></td>
				<td><small>$telepon</small></td>	
				<td><small>$level $ket</small></td>
				<td>
				<div align='center'>
<a href='?mnu=admin&pro=ubah&kode=$id_admin'><img src='ypathicon/ub.png' title='ubah'></a>
 <a href='#' onclick='deleteData(\"$id_admin\")'><img src='ypathicon/ha.png' title='hapus'></a>
</div>
				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data admin belum tersedia...</blink></td></tr>";}
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
	$id_admin=strip_tags($_POST["id_admin"]);
	$id_admin0=strip_tags($_POST["id_admin0"]);
	$nama_admin=strip_tags($_POST["nama_admin"]);
	$level=strip_tags($_POST["level"]);
	$deskripsi=strip_tags($_POST["deskripsi"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	
	
	
if($pro=="simpan"){
 $sql=" INSERT INTO `$tbadmin` (
`id_admin` ,
`nama_admin` ,
`level` ,
`deskripsi` ,
`username` ,
`password` ,
`telepon` ,
`email` ,
`status` ,
`keterangan`
) VALUES (
'$id_admin', 
'$nama_admin',
'$level',
'$deskripsi',
'$username',
'$password', 
'$telepon',
'$email',
'Aktif',
'-'
)";
	
$simpan=process($conn,$sql);
	if($simpan === TRUE) {
	echo"<script>berhasil('admin','Sukses Simpan');</script>";}
		else{
			echo"<script>gagal('admin','Gagal Simpan');</script>";}
	}
	else{
		$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbadmin` set 
	`nama_admin`='$nama_admin',
	`level`='$level',
	`deskripsi`='$deskripsi',
	`username`='$username',
	`password`='$password',
	`telepon`='$telepon' ,
	`email`='$email',
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_admin`='$id_admin0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('admin','Sukses Ubah');</script>";}
		else{echo"<script>gagal('admin','Gagal Ubah');</script>";}
	}//else simpan
}
?>

<?php
if (isset($_POST['delete'])) {
    $id_admin = $_POST['delete_id'];

    $sql = "DELETE FROM `$tbadmin` WHERE `id_admin`='$id_admin'";
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
function deleteData(id_admin) {
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
                body: `delete=1&delete_id=${id_admin}`,
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