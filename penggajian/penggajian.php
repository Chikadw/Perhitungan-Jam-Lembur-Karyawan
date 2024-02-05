<?php

$tanggal=WKT(date("Y-m-d"));
$jam=date("H:i:s");
$pro="simpan";
$status="Proses";
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
$tahun=date("Y")-1;
$periode=$judul_bln[(int)$bulan]." ".$tahun;

?> 

<script type="text/javascript">
var xmlHttp;

function showUp(str){ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){
 alert ("Browser tidak support HTTP Request");
 return;
 } 
var url="getListKaryawan.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=SC1;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function SC1() { 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 document.getElementById("txtHint1").innerHTML=xmlHttp.responseText ;
 } 
}

function showUp2(str){ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null){
 alert ("Browser tidak support HTTP Request");
 return;
 } 
 
var periode=document.getElementById("periode").value;
//var total=parseInt(tagihan)+parseInt(nom);
//document.getElementById("total").value = String(total);
 
var url="getKaryawan2.php";
url=url+"?q="+str+"&periode="+periode;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=SC2;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function SC2() { 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
 document.getElementById("txtHint2").innerHTML=xmlHttp.responseText ;
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
win=window.open('penggajian/penggajian_print.php?pk='+pk,'win','width=1000, height=400, menubar=0, scrollbars=1, resizable=0, location=0, toolbar=0, status=0'); } 

</script>
<script language="JavaScript">
function buka(url) {window.open(url, 'window_baru', 'width=800,height=600,left=320,top=100,resizable=1,scrollbars=1');}
</script>

<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){
	$id_penggajian=$_GET["kode"];
	$sql="select * from `$tbpenggajian` where `id_penggajian`='$id_penggajian'";
	$d=getField($conn,$sql);
				$id_penggajian=$d["id_penggajian"];
				$id_penggajian0=$d["id_penggajian"];
				$id_rekanan=$d["id_rekanan"];
				$id_karyawan=$d["id_karyawan"];
				$periode=$d["periode"];
				$absen=$d["absen"];
				$lembur=$d["lembur"];
				$pajak=$d["pajak"];
				$tanggal=WKT($d["tanggal"]);
				$jam=$d["jam"];
				$sgaji1=$d["sgaji1"];
				$sgaji2=$d["sgaji2"];
				$sgaji3=$d["sgaji3"];
				$sgaji4=$d["sgaji4"];
				$sgaji5=$d["sgaji5"];
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
  <h3>Data Penggajian</h3>
  <div>
			
			
<form action="" method="post" enctype="multipart/form-data">
<table width="629" class="table">

<tr>
<td height="24"><label for="periode">Periode Gaji</label>
<td>:<td><input required  name="periode" style="width:250px;" type="text" class="form-control" id="periode" value="<?php echo $periode;?>" size="25" /></td>
</tr>
<tr>
<td><label for="id_rekanan">Pilih Rekanan</label>
<td>:<td>
<select class="form-control"  name="id_rekanan" id="id_rekanan" style="width: 250px;"
 onchange="showUp(this.value)">
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
</td>
</tr>

<tr>
<td height="24"><label for="id_karyawan">Pilih  Karyawan</label>
<td>:<td>
<div id="txtHint1">
<select class="form-control"  name="id_karyawan" id="id_karyawan" style="width: 250px;" >
  <?php
   echo"<option value='$id_karyawan' ";  echo"> $id_karyawan</option>";
	  $s="select * from `tb_karyawan` where `status`='Aktif'";
	$q=getData($conn,$s);
		foreach($q as $d){							
				$id_karyawan0=$d["id_karyawan"];
				$nama_karyawan=$d["nama_karyawan"];
	echo"<option value='$id_karyawan0' ";if($id_karyawan0==$id_karyawan){echo"selected";} echo"> $nama_karyawan</option>";
	}
	?>
</select>
</div>
<div id="txtHint2"></div>
</td>
</tr>


<?php
if(isset($_GET["pro"]) && $_GET["pro"]=="ubah"){?>
<tr>
<td><label for="status">Status</label>
<td>:<td colspan="2">
<input type="radio" name="status" id="status"  checked="checked" value="Proses" <?php if($status=="Proses"){echo"checked";}?>/>Proses 
<input type="radio" name="status" id="status" value="Selesai" <?php if($status=="Selesai"){echo"checked";}?>/>Selesai
</td></tr>

<tr>
<td height="24"><label for="keterangan">Catatan Penggajian</label>
<td>:<td>
<textarea name="keterangan" cols="55" class="form-control" rows="2"><?php echo $keterangan;?></textarea>
</td>
</tr>
<?php } ?>
<tr>
<td>
<td>
<td colspan="2">
<input name="Simpan" type="submit" class="btn btn-primary"  id="Simpan" value="Simpan" />
<input name="pro" type="hidden" id="pro" value="<?php echo $pro;?>" />
<input name="id_penggajian" type="hidden" id="id_penggajian" value="<?php echo $id_penggajian;?>" />
<input name="id_penggajian0" type="hidden" id="id_penggajian0" value="<?php echo $id_penggajian0;?>" />
<a href="?mnu=penggajian"><input name="Batal" class="btn btn-danger" type="button" id="Batal" value="Batal" /></a>
</td></tr>
</table>
</form>
<br />
  </div>
<?php  
  $sqlc="select distinct(`id_rekanan`) from `$tbpenggajian` order by `id_rekanan` asc";
  $jumc=getJum($conn,$sqlc);
		if($jumc <1){
		echo"<h1>Maaf data penggajian belum tersedia</h1>";
		}
	$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {						
				$id_rekanan=$dc["id_rekanan"];
				$IDR=$dc["id_rekanan"];
				
				$rekanan=getRekanan($conn,$id_rekanan);
				$sql = "select * from `$tbpenggajian` where  `id_rekanan`='$id_rekanan' order by `id_penggajian` desc";
		$jum = getJum($conn, $sql);
	?>
		<h3>Data Penggajian <?php echo "$rekanan |$id_rekanan ($jum Data)"?>:</h3>
<div>				
 
| <img src='ypathicon/print.png' title='PRINT' OnClick="PRINT('<?php echo $IDR;?>')"> |
 <a href='penggajian/excel.php?pk=<?php echo $IDR;;?>'>
 <img src='ypathicon/xls.png' title='Export ke Excel'></a> |

<br>

<table class="table">
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
    <th width="15%"><small>Menu</small></td>
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
				<td><div align='center'>
<a href='?mnu=penggajian&pro=ubah&kode=$id_penggajian'><img src='ypathicon/ub.png' title='ubah'></a>
 <a href='#' onclick='deleteData(\"$id_penggajian\")'><img src='ypathicon/ha.png' title='hapus'></a>

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
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$prev&mnu=penggajian'>« Prev</a></span> ";
	}
	else{echo "<span class=disabled>« Prev</span> ";}

	for($i=1;$i<=$jmlhal;$i++)
	if ($i != $page){echo "<a href='$_SERVER[PHP_SELF]?page=$i&mnu=penggajian'>$i</a> ";}
	else{echo " <span class=current>$i</span> ";}

	if($page < $jmlhal){
		$next=$page+1;
		echo "<span class=prevnext><a href='$_SERVER[PHP_SELF]?page=$next&mnu=penggajian'>Next »</a></span>";
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
	$id_karyawan=strip_tags($_POST["id_karyawan"]);
	$periode=strip_tags($_POST["periode"]); 
	$tanggal=date("Y-m-d");
	$jam=date("H:i:s");
 
$sql = "select * from `$tbkaryawan` where `id_karyawan`='$id_karyawan'";
	$d = getField($conn, $sql);
	$id_karyawan=$d["id_karyawan"]; 
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
	
	$gaji1_=RP($gaji1);
	$gaji2_=RP($gaji2);
	$gaji3_=RP($gaji3);
	$gaji4_=RP($gaji4);
	$gaji5_=RP($gaji5);
	
	$absen=rand(15,26);
	$lembur=rand(100,200);
	
	$sgaji1=$gaji1*$absen;
	$sgaji2=$gaji2*$absen;
	$sgaji3=$gaji3*1;
	$sgaji4=$gaji4*1;
	$sgaji5=$gaji5*$lembur;
	$ttl=$sgaji1+$sgaji2+$sgaji3+$sgaji4+$sgaji5;
	$pajak=$ttl * 2/100;
	$gaji=$ttl-$pajak;

	
if($pro=="simpan"){
	$sql = "DELETE FROM `$tbpenggajian` WHERE `id_karyawan`='$id_karyawan' and `periode`='$periode'";
	process($conn,$sql);
	
 $sql=" INSERT INTO `$tbpenggajian` (
`id_rekanan` ,
`id_karyawan` ,
`periode` ,
`absen` ,
`lembur` ,
`pajak` ,`subtotal` ,`total` ,
`tanggal` ,
`jam` ,
`sgaji1` ,
`sgaji2` ,
`sgaji3` ,
`sgaji4` ,
`sgaji5` ,
`status` ,
`keterangan`
) VALUES (
'$id_rekanan',
'$id_karyawan',
'$periode',
'$absen', 
'$lembur',
'$pajak','$ttl','$gaji',
'$tanggal',
'$jam',
'$sgaji1',
'$sgaji2',
'$sgaji3',
'$sgaji4',
'$sgaji5',
'Aktif',
'-'
)";
	
$simpan=process($conn,$sql);
	if($simpan === TRUE) {
	echo"<script>berhasil('penggajian','Sukses Simpan');</script>";}
		else{
			echo"<script>gagal('penggajian','Gagal Simpan');</script>";}
	}
	else{
		$id_penggajian=strip_tags($_POST["id_penggajian"]);
		$id_penggajian0=strip_tags($_POST["id_penggajian0"]);
		$status=strip_tags($_POST["status"]);
		$keterangan=strip_tags($_POST["keterangan"]);
	$sql="update `$tbpenggajian` set 
	`id_rekanan`='$id_rekanan',
	`id_karyawan`='$id_karyawan',`subtotal`='$ttl',`total`='$gaji',
	`periode`='$periode', 
	`status`='$status',
	`keterangan`='$keterangan'
	 where `id_penggajian`='$id_penggajian0'";
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>berhasil('penggajian','Sukses Ubah');</script>";}
		else{echo"<script>gagal('penggajian','Gagal Ubah');</script>";}
	}//else simpan
}
?>

<?php
if (isset($_POST['delete'])) {
    $id_penggajian = $_POST['delete_id'];

    $sql = "DELETE FROM `$tbpenggajian` WHERE `id_penggajian`='$id_penggajian'";
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
function deleteData(id_penggajian) {
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
                body: `delete=1&delete_id=${id_penggajian}`,
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