<?php

$tanggal=WKT(date("Y-m-d"));
$jam=date("Y-m-d");
$pro="simpan";
$status="Aktif";
$id_penugasan="";
$nama_penugasan="";
$deskripsi="";
$id_rekanan=$_SESSION["cid"];
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
var url="getKaryawan.php";
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
function PRINT(pk,pk2){ 
win=window.open('penugasan/penugasan_print2.php?pk='+pk+'&pk2='+pk2,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
$sql = "select `id_penugasan` from `tb_penugasan` order by `id_penugasan` desc";
$q = mysqli_query($conn, $sql);
$jum = mysqli_num_rows($q);
$th = date("y");
$bl = date("m") + 0;
if ($bl < 10) {
	$bl = "0" . $bl;
}

$kd = "PNG" . $th . $bl; //KEG1610001
if ($jum > 0) {
	$d = mysqli_fetch_array($q);
	$idmax = $d["id_penugasan"];

	$bul = substr($idmax, 5, 2);
	$tah = substr($idmax, 3, 2);
	if ($bul == $bl && $tah == $th) {
		$urut = substr($idmax, 7, 3) + 1;
		if ($urut < 10) {
			$idmax = "$kd" . "00" . $urut;
		} else if ($urut < 100) {
			$idmax = "$kd" . "0" . $urut;
		} else {
			$idmax = "$kd" . $urut;
		}
	} //==
	else {
		$idmax = "$kd" . "001";
	}
} //jum>0
else {
	$idmax = "$kd" . "001";
}
$id_penugasan = $idmax;
?>
<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_penugasan=$_GET["kode"];
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
	
<?php
require_once"hrekanan.php";
?>	
<div id="accordion">
  <h3>Data Penugasan <?php echo getRekanan($conn,$id_rekanan);?></h3>
  <div>
			
			
<form action="" method="post" enctype="multipart/form-data">
<table class="table">
<tr>
<th width="119"><label for="id_penugasan">ID Penugasan</label>
<th width="10">:
<th colspan="2"><b><?php echo $id_penugasan;?></b></tr>
 
<tr>
<td><label for="nama_penugasan">Nama Penugasan</label>
<td>:<td width="396"><input required name="nama_penugasan" class="form-control" type="text" id="nama_penugasan" value="<?php echo $nama_penugasan;?>" size="25" />
</td>
</tr>


<tr>
<td height="24"><label for="id_rekanan">Pilih Karyawan</label>
<td>:<td><select class="form-control"  name="id_rekanan" id="id_rekanan" style="width: 250px;" onchange="showUp(this.value)">
  <?php
   echo"<option value='$id_karyawan' ";  echo"> $id_karyawan</option>";
	  $s="select * from `tb_karyawan` where `status`='Aktif' and `id_rekanan`='$id_rekanan'";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_karyawan0=$d["id_karyawan"];
				$nama_karyawan=$d["nama_karyawan"];
	echo"<option value='$id_karyawan0' ";if($id_karyawan0==$id_karyawan){echo"selected";} echo"> $nama_karyawan (NIK-0$id_karyawan0)  </option>";
	}
	?>
</select>
<div id="txtHint"></div>
</td>
</tr>
<tr>
<td height="24"><label for="deskripsi">Deskripsi</label>
<td>:<td>
<textarea name="deskripsi" cols="55" class="form-control" rows="2"><?php echo $deskripsi;?></textarea>
</td>
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
        <input name="id_penugasan" type="hidden" id="id_penugasan" value="<?php echo $id_penugasan;?>" />
        <input name="id_penugasan0" type="hidden" id="id_penugasan0" value="<?php echo $id_penugasan0;?>" />
        <a href="?mnu=rpenugasan"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
  </div>
<?php  
  $sqlc="select distinct(`id_karyawan`) from `$tbpenugasan` where id_rekanan='$id_rekanan' order by `status` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data penugasan belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$id_karyawan=$dc["id_karyawan"];
				$karyawan=getKaryawan($conn,$id_karyawan);
				$sql = "select * from `$tbpenugasan` where  `id_rekanan`='$id_rekanan' and id_karyawan='$id_karyawan' order by `id_penugasan` desc";
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
					<a href='?mnu=rpenugasan_detail&id=$id_penugasan'><img src='ypathicon/xls.png' title='Detail Penugasan'></a> 
				<br>
				<a href='?mnu=rpenugasan&pro=ubah&kode=$id_penugasan'><img src='ypathicon/ub.png' title='ubah'></a>
				<label onclick='deleteData(\"$id_penugasan\")'><img src='ypathicon/ha.png' title='hapus'></label>
				<br>

 				

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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=rpenugasan'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=rpenugasan'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=rpenugasan'>Next »</a></span>";
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
	$id_penugasan=strip_tags($_POST["id_penugasan"]);
	$id_penugasan0=strip_tags($_POST["id_penugasan0"]);
	$nama_penugasan=strip_tags($_POST["nama_penugasan"]);
	$deskripsi=strip_tags($_POST["deskripsi"]);
	$id_rekanan=strip_tags($_SESSION["cid"]);
	$id_karyawan=strip_tags($_POST["id_karyawan"]);
	$tanggal=date("Y-m-d");
	$jam=date("H:i:s");
	
	
	
	
if($pro=="simpan"){
$sql="update `$tbpenugasan` set `status`='Tidak Aktif' where `id_rekanan`='$id_rekanan'";
process($conn,$sql);
	
 $sql=" INSERT INTO `$tbpenugasan` (
`id_penugasan` ,
`nama_penugasan` ,
`deskripsi` ,
`id_rekanan` ,`id_karyawan` ,
`tanggal` ,
`jam` ,
`status` ,
`keterangan`
) VALUES (
'$id_penugasan', 
'$nama_penugasan',
'$deskripsi',
'$id_rekanan','$id_karyawan',
'$tanggal', 
'$jam',
'Aktif',
'-'
)";
	
$simpan=process($conn,$sql);
	if($simpan === TRUE) {
	echo"<script>berhasil('rpenugasan','Sukses Simpan');</script>";}
		else{
			echo"<script>gagal('rpenugasan','Gagal Simpan');</script>";}
	}
	else{
		$status=strip_tags($_POST["status"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbpenugasan` set 
	`nama_penugasan`='$nama_penugasan',
	`deskripsi`='$deskripsi',`id_karyawan`='$id_karyawan',
	`id_rekanan`='$id_rekanan',
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_penugasan`='$id_penugasan0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('rpenugasan','Sukses Ubah');</script>";}
		else{echo"<script>gagal('rpenugasan','Gagal Ubah');</script>";}
	}//else simpan
}
?>

<?php
if (isset($_POST['delete'])) {
    $id_penugasan = $_POST['delete_id'];
$sql = "DELETE FROM `$tbpenugasan_detail` WHERE `id_penugasan`='$id_penugasan'";
$conn->query($sql);
		
    $sql = "DELETE FROM `$tbpenugasan` WHERE `id_penugasan`='$id_penugasan'";
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
function deleteData(id_penugasan) {
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
                body: `delete=1&delete_id=${id_penugasan}`,
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