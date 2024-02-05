<?php
require_once 'vendor/autoload.php';
use Shuchkin\SimpleXLSX;

$tanggal=WKT(date("Y-m-d"));
$pro="simpan";
$status="Aktif";
$id_karyawan="";
$id_rekanan="";
$id_finger="";
$nama_karyawan="";
$deskripsi="";
$telepon="";
$email="";
$username="";
$password="";
$gaji1="";
$gaji2="";
$gaji3="";
$gaji4="";
$gaji5="";
$keterangan="";
//$PATH="ypathcss";
?> 

<script type="text/javascript">
var xmlHttp;

function showUp(str){ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){
 alert ("Browser tidak support HTTP Request");
 return;
 } 
var url="getRekanan.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=SC1;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function SC1() { 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 document.getElementById("txtHint").innerHTML=xmlHttp.responseText ;
 } 
}

function GetXmlHttpObject(){
var xmlHttp=null;
try{xmlHttp=new XMLHttpRequest();}
catch (e){
	try{xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");}
 	catch (e){xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");}
 }
return xmlHttp;
}
</script>

<script type="text/javascript"> 
function PRINT(pk){ 
win=window.open('karyawan/karyawan_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 
</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>


<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_karyawan=$_GET["kode"];
	$sql="select * from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
	$d=getField($conn,$sql);
				$id_karyawan=$d["id_karyawan"];
				$id_karyawan0=$d["id_karyawan"];
				$id_rekanan=$d["id_rekanan"];
				$id_finger=$d["id_finger"];
				$nama_karyawan=$d["nama_karyawan"];
				$deskripsi=$d["deskripsi"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$username=$d["username"];
				$password=$d["password"];
				$gaji1=$d["gaji1"];
				$gaji2=$d["gaji2"];
				$gaji3=$d["gaji3"];
				$gaji4=$d["gaji4"];
				$gaji5=$d["gaji5"];
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
  <h3>Masukan Data Karyawan</h3>
  <div>
	<form name="import_export_form" method="post" action="" enctype="multipart/form-data">
<table width="60%">
<tr>
<td><label  class="btn btn-dark">Pilih File Data Karyawan :</label>
<td><input type="file" id="excelfile" required name="excelfile"  class="btn btn-light"/>
<td><input type="submit" id="import"  value="IMPORT" name="IMPORT" class="btn btn-warning"/>
<td><a href="downloadgetfile.php?file=cthData.xlsx">
	<input type="button" id="import" value="DOWNLOAD" name="Download" class="btn btn-success"/>
	</a>
</tr>
</table>
</form>	
			
			<?php
 if(isset($_POST['IMPORT'])){
	
$sql="Truncate $tbkaryawan";
process($conn,$sql);

		$filename = $_FILES['excelfile']['tmp_name'];
		$nf = $_FILES['excelfile']['name'];
$no=0;
$xlsx = new SimpleXLSX($filename);
if ( $xlsx->success() ) {
    foreach( $xlsx->rows() as $r ) {
      if(!empty($r[3])){
		//echo $r[0]."#".$r[1]."#".$r[2]."#".$r[3]."<br>";
		$id_rekanan=$r[1];
		$id_finger=$r[2];
		$nama_karyawan=$r[3];
		$deskripsi=$r[4];
		$telepon=$r[5];
		$email=$r[5];
		$username=$r[5];
		$password=$r[5];
		$gaji1=$r[5];
		$gaji2=$r[5];
		$gaji3=$r[5];
		$gaji4=$r[5];
		$gaji5=$r[5];
		
		
		
 $sql=" INSERT INTO $tbtransaksi (
`id_rekanan` ,
`id_finger` ,
`nama_karyawan` ,
`deskripsi` ,
`telepon` ,
`email` ,
`username` ,
`password` ,
`gaji1` ,
`gaji2` ,
`gaji3` ,
`gaji4` ,
`gaji5` ,
`status` ,
`keterangan`
) VALUES (
'$id_rekanan',
'$id_finger',
'$nama_karyawan',
'$deskripsi', 
'$telepon',
'$email',
'$username',
'$password',
'$gaji1',
'$gaji2',
'$gaji3',
'$gaji4',
'$gaji5',
'Aktif',
'-'
)";
$simpan=process($conn,$sql);
		
$no++;
	  }
    }
$nom=$no-1;
echo "<script>berhasil('karyawan','Import Data Karyawan dari $nf Sebanyak $nom Berhasil');</script>";
} else {
    echo 'xlsx error: '.$xlsx->error();
}
 }
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="table">

<tr>
<td width="158"><label for="id_rekanan">Pilih Rekanan</label>
<td width="10">:
<td width="441"><select class="form-control" required  name="id_rekanan" id="id_rekanan" style="width: 250px;" onchange="showUp(this.value)">
  <?php
   echo"<option value='$id_rekanan' ";  echo"> $id_rekanan</option>";
	  $s="select * from `tb_rekanan` where `status`='Aktif'";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_rekanan0=$d["id_rekanan"];
				$nama_rekanan=$d["nama_rekanan"];
	echo"<option value='$id_rekanan0' ";if($id_rekanan0==$id_rekanan){echo"selected";} echo"> $nama_rekanan ($id_rekanan0)  </option>";
	}
	?>
</select>
<div id="txtHint"></div>
</td>
</tr>
</table>

<table>
<tr>
<td height="24"><label for="nama_karyawan">Nama Karyawan</label>
<td>:<td><input required  name="nama_karyawan" type="text" class="form-control" id="nama_karyawan" value="<?php echo $nama_karyawan;?>" style="width:250px;" /></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="id_finger">ID Finger</label>
<td>:<td><input required  name="id_finger" type="text" class="form-control" id="id_finger" value="<?php echo $id_finger;?>" style="width:250px;"  /></td>
</tr> 


<tr>
<td height="24"><label for="telepon">Telepon</label>
<td>:<td><input  required name="telepon" type="number" class="form-control" id="telepon" value="<?php echo $telepon;?>" style="width:250px;" />
</td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="email">Email</label>
<td>:<td><input  required name="email" type="email" class="form-control" id="email" value="<?php echo $email;?>" style="width:250px;" />
</td>
</tr>
 


<tr>
<td height="24"><label for="username">Username</label>
<td>:<td><input required  name="username" type="text" class="form-control" id="username" value="<?php echo $username;?>" style="width:250px;"  /></td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="password">Password</label>
<td>:<td><input required  name="password" type="password" class="form-control" id="password" value="<?php echo $password;?>" style="width:250px;" /></td>
</tr>

<tr>
<td height="24"><label for="gaji1"><?php echo $gj1;?></label>
<td>:<td><input required  name="gaji1" type="number" style="width:250px;" class="form-control" id="gaji1" value="<?php echo $gaji1;?>" /></td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="gaji2"><?php echo $gj2;?></label>
<td>:<td><input required  name="gaji2" type="number" style="width:250px;" class="form-control" id="gaji2" value="<?php echo $gaji2;?>" /></td>
</tr>
<tr>
<td height="24"><label for="gaji3"><?php echo $gj3;?></label>
<td>:<td><input required  name="gaji3" type="number" style="width:250px;" class="form-control" id="gaji3" value="<?php echo $gaji3;?>" /></td>
 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td height="24"><label for="gaji4"><?php echo $gj4;?></label>
<td>:<td><input required  name="gaji4" type="number" style="width:250px;" class="form-control" id="gaji4" value="<?php echo $gaji4;?>" /></td>
</tr>

<tr>
<td height="24"><label for="deskripsi">Deskripsi</label>
<td>:<td colspan="6"><input required  name="deskripsi" type="text" style="width:650px;" class="form-control" id="deskripsi" value="<?php echo $deskripsi;?>" /></td>
</tr>


<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){?>
<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Aktif" <?php if($status=="Aktif"){echo"checked";}?>/>Aktif 
<input type="radio" name="status" id="status" value="Tidak Aktif" <?php if($status=="Tidak Aktif"){echo"checked";}?>/>Tidak Aktif
</td> 
<td height="24"><label for="keterangan">Keterangan</label>
<td>:<td>
<input required  name="keterangan" type="text" style="width:250px;" class="form-control" id="keterangan" value="<?php echo $keterangan;?>" />
</td>
</tr>
<?php } ?>

<tr>
<td>
<td colspan="5">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="Simpan" type="submit" class="btn btn-primary"  id="Simpan" value="Simpan" />
        <input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
        <input name="id_karyawan" type="hidden" id="id_karyawan" value="<?php echo $id_karyawan;?>" />
        <input name="id_karyawan0" type="hidden" id="id_karyawan0" value="<?php echo $id_karyawan0;?>" />
        <a href="?mnu=karyawan"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
  </div>
<?php  
  $sqlc="select distinct(`id_rekanan`) from `$tbkaryawan` order by `status` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data Karyawan belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$id_rekanan=$dc["id_rekanan"];
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
    <th width="13%"><small>Menu</small></td>
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
<td><div align='center'>
<a href='?mnu=karyawan&pro=ubah&kode=$id_karyawan'><img src='ypathicon/ub.png' title='ubah'></a>
 <a href='#' onclick='deleteData(\"$id_karyawan\")'><img src='ypathicon/ha.png' title='hapus'></a>

				</tr>";
				
			$no++;
			}//for dalam
		}//if
		else{echo"<tr><td colspan='6'><blink>Maaf, Data karyawan belum tersedia...</blink></td></tr>";}
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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=karyawan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=karyawan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=karyawan'>Next »</a></span>";
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

	
	
<?php
if(isset($_POST["Simpan"])){
	$pro=strip_tags($_POST["pro"]);
	$id_rekanan=strip_tags($_POST["id_rekanan"]);
	$id_finger=strip_tags($_POST["id_finger"]);
	$nama_karyawan=strip_tags($_POST["nama_karyawan"]);
	$deskripsi=strip_tags($_POST["deskripsi"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$gaji1=strip_tags($_POST["gaji1"]);
	$gaji2=strip_tags($_POST["gaji2"]);
	$gaji3=strip_tags($_POST["gaji3"]);
	$gaji4=strip_tags($_POST["gaji4"]);
	$gaji5=0;//strip_tags($_POST["gaji5"]);
	
	
	
if($pro=="simpan"){
	 $sqlc="select `id_rekanan` from `$tbkaryawan` where id_finger='$id_finger'";
  $jumc=getJum($conn,$sqlc);
		if($jumc >0){
		echo"<script>gagal('karyawan','Gagal Simpan..IDFINGER $id_finger sudah ada sebelumnya...');</script>";	
		}
		else{
 $sql=" INSERT INTO `$tbkaryawan` (
`id_rekanan` ,
`id_finger` ,
`nama_karyawan` ,
`deskripsi` ,
`telepon` ,
`email` ,
`username` ,
`password` ,
`gaji1` ,
`gaji2` ,
`gaji3` ,
`gaji4` ,
`gaji5` ,
`status` ,
`keterangan`
) VALUES (
'$id_rekanan',
'$id_finger',
'$nama_karyawan',
'$deskripsi', 
'$telepon',
'$email',
'$username',
'$password',
'$gaji1',
'$gaji2',
'$gaji3',
'$gaji4',
'$gaji5',
'Aktif',
'-'
)";
	
$simpan=process($conn,$sql);
			if($simpan === TRUE) {
			echo"<script>berhasil('karyawan','Sukses Simpan');</script>";
			}
		else{
			echo"<script>gagal('karyawan','Gagal Simpan');</script>";
			}
	
	}
}
	else{
	$id_karyawan=strip_tags($_POST["id_karyawan"]);
	$id_karyawan0=strip_tags($_POST["id_karyawan0"]);
	$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbkaryawan` set 
	`id_rekanan`='$id_rekanan',
	`id_finger`='$id_finger',
	`nama_karyawan`='$nama_karyawan',
	`deskripsi`='$deskripsi',
	`telepon`='$telepon' ,
	`email`='$email',
	`username`='$username',
	`password`='$password',
	`gaji1`='$gaji1',
	`gaji2`='$gaji2',
	`gaji3`='$gaji3',
	`gaji4`='$gaji4',
	`gaji5`='$gaji5',
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_karyawan`='$id_karyawan0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('karyawan','Sukses Ubah');</script>";}
		else{echo"<script>gagal('karyawan','Gagal Ubah');</script>";}
	}//else simpan
}
?>

<?php
if (isset($_POST['delete'])) {
    $id_karyawan = $_POST['delete_id'];

    $sql = "DELETE FROM `$tbkaryawan` WHERE `id_karyawan`='$id_karyawan'";
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
function deleteData(id_karyawan) {
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
                body: `delete=1&delete_id=${id_karyawan}`,
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