<?php
require_once"koneksivar.php";
//=((D7+E7)/173)*R7

$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}

function cekWeek($hari){
	$kategori="Weekday";
	if($hari=="Sabtu"||$hari=="Minggu"){
		$kategori="Weekend";	
	}
	return $kategori;
}
function getHari($tanggal){
	$dayOfWeek = date("l", strtotime($tanggal));
	$hari="Minggu";
	if($dayOfWeek=="Sunday"){$hari="Minggu";}
	elseif($dayOfWeek=="Monday"){$hari="Senin";}
	elseif($dayOfWeek=="Tuesday"){$hari="Selasa";}
	elseif($dayOfWeek=="Wednesday"){$hari="Rabu";}
	elseif($dayOfWeek=="Thursday"){$hari="Kamis";}
	elseif($dayOfWeek=="Friday"){$hari="Jumat";}
	elseif($dayOfWeek=="Saturday"){$hari="Sabtu";}
	
	return $hari;//."/$dayOfWeek"
	}
	
?>
<script src="ypathcss/sweetalert/sweetalert3.all.min.js"></script>
<link rel="stylesheet" href="ypathcss/sweetalert/sweetalert2.min.css">

<?php function RP($rupiah){return number_format($rupiah,"2",",",".");}?>
<?php
function WKT($sekarang){
	error_reporting(0);
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,0,4);

$judul_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli", "Agustus", "September","Oktober", "November", "Desember");
$wk=$tanggal." ".$judul_bln[(int)$bulan]." ".$tahun;
return $wk;
}
?>
<?php
function WKTP($sekarang){
	error_reporting(0);
$tanggal = substr($sekarang,8,2)+0;
$bulan = substr($sekarang,5,2);
$tahun = substr($sekarang,2,2);

$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
$wk=$tanggal." ".$judul_bln[(int)$bulan]."'".$tahun;
return $wk;
}
?>
<?php
function cekPer($periode){
	$periode=strtolower($periode);
	$arr=explode(" ",$periode);
	if($arr[0]=="januari"||$arr[0]=="january"){$bul="01";}
	else if($arr[0]=="februari"||$arr[0]=="february"){$bul="02";}
	else if($arr[0]=="maret"||$arr[0]=="march"){$bul="03";}
	else if($arr[0]=="april"){$bul="04";}
	else if($arr[0]=="mei"||$arr[0]=="may"){$bul="05";}
	else if($arr[0]=="juni"||$arr[0]=="june"){$bul="06";}
	else if($arr[0]=="juli"||$arr[0]=="july"){$bul="07";}
	else if($arr[0]=="agustus"||$arr[0]=="august"){$bul="08";}
	else if($arr[0]=="september"){$bul="09";}
	else if($arr[0]=="oktober"||$arr[0]=="october"){$bul="10";}
	else if($arr[0]=="november"){$bul="11";}
	else if($arr[0]=="nopember"){$bul="11";}
	else if($arr[0]=="desember"||$arr[0]=="december"){$bul="12";}
return "$arr[1]-$bul-";	
}

function BAL($tanggal){
	$arr=explode(" ",$tanggal);
	if($arr[1]=="Januari"||$arr[1]=="January"){$bul="01";}
	else if($arr[1]=="Februari"||$arr[1]=="February"){$bul="02";}
	else if($arr[1]=="Maret"||$arr[1]=="March"){$bul="03";}
	else if($arr[1]=="April"){$bul="04";}
	else if($arr[1]=="Mei"||$arr[1]=="May"){$bul="05";}
	else if($arr[1]=="Juni"||$arr[1]=="June"){$bul="06";}
	else if($arr[1]=="Juli"||$arr[1]=="July"){$bul="07";}
	else if($arr[1]=="Agustus"||$arr[1]=="August"){$bul="08";}
	else if($arr[1]=="September"){$bul="09";}
	else if($arr[1]=="Oktober"||$arr[1]=="October"){$bul="10";}
	else if($arr[1]=="November"){$bul="11";}
	else if($arr[1]=="Nopember"){$bul="11";}
	else if($arr[1]=="Desember"||$arr[1]=="December"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>	


<?php
function BALP($tanggal){
	$arr=split(" ",$tanggal);
	if($arr[1]=="Jan"){$bul="01";}
	else if($arr[1]=="Feb"){$bul="02";}
	else if($arr[1]=="Mar"){$bul="03";}
	else if($arr[1]=="Apr"){$bul="04";}
	else if($arr[1]=="Mei"){$bul="05";}
	else if($arr[1]=="Jun"){$bul="06";}
	else if($arr[1]=="Jul"){$bul="07";}
	else if($arr[1]=="Agu"){$bul="08";}
	else if($arr[1]=="Sep"){$bul="09";}
	else if($arr[1]=="Okt"){$bul="10";}
	else if($arr[1]=="Nov"){$bul="11";}
	else if($arr[1]=="Nop"){$bul="11";}
	else if($arr[1]=="Des"){$bul="12";}
return "$arr[2]-$bul-$arr[0]";	
}
?>


<?php
function process($conn,$sql){
$s=false;
$conn->autocommit(FALSE);
try {
  $rs = $conn->query($sql);
  if($rs){
	    $conn->commit();
	    $last_inserted_id = $conn->insert_id;
 		$affected_rows = $conn->affected_rows;
  		$s=true;
  }
} 
catch (Exception $e) {
	echo 'fail: ' . $e->getMessage();
  	$conn->rollback();
}
$conn->autocommit(TRUE);
return $s;
}
function cekR($v1,$v2){
	$v=rand($v1,$v2);
	$x=$v;
	if($v<10){$x="0".$v;}
	return $x;
}
function getJum($conn,$sql){
	
  $rs=$conn->query($sql);
  $jum= $rs->num_rows;
	$rs->free();
	return $jum;
}

function getField($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$d= $rs->fetch_assoc();
	$rs->free();
	return $d;
}

function getData($conn,$sql){
	$rs=$conn->query($sql);
	$rs->data_seek(0);
	$arr = $rs->fetch_all(MYSQLI_ASSOC);
	//foreach($arr as $row) {
	//  echo $row['nama_kelas'] . '*<br>';
	//}
	
	$rs->free();
	return $arr;
}

function getAdmin($conn,$kode){
$field="nama_admin";
$sql="SELECT `$field` FROM `tb_admin` where `id_admin`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
function getFinger($conn,$kode){
	$sql3="select `nama_karyawan` from `tb_karyawan` where `id_finger`='$kode'";
	$d3=getField($conn,$sql3);
		$nama_karyawan=$d3["nama_karyawan"];
		return $nama_karyawan;
	}	
function getKaryawan($conn,$kode){
	$sql3="select `nama_karyawan` from `tb_karyawan` where `id_karyawan`='$kode'";
	$d3=getField($conn,$sql3);
		$nama_karyawan=$d3["nama_karyawan"];
		return $nama_karyawan;
	}
function getRekanan($conn,$kode){
	error_reporting(0);
$field="nama_rekanan";
$sql="SELECT `$field` FROM `tb_rekanan` where `id_rekanan`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}
function getMesin($conn,$kode){
	error_reporting(0);
$field="nama_rekanan";
$sql="SELECT `$field` FROM `tb_rekanan` where `id_mesin`='$kode'";
$rs=$conn->query($sql);	
	$rs->data_seek(0);
	$row = $rs->fetch_assoc();
	$rs->free();
    return $row[$field];
	}	
	
function getJumlah($conn,$sql){	 
$q = mysqli_query($conn, $sql);
$jum = mysqli_num_rows($q);
return $jum;
}


function cekTugas($ar,$tg){
	$jd=count($ar);
	$R=0;
	for($i=0;$i<$jd;$i++){
		//echo $ar[$i]."==$tg<br>";
		if($ar[$i]==$tg){ 
			$R=1;
			break;
		}
	}
	return $R;
}
?>

