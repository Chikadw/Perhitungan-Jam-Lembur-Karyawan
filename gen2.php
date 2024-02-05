<?php
include "konmysqli.php"; 
process($conn,"Truncate `$tbabsensi`");
	
$tahun="2023";
$DURASIMASUK=28;//hari
$judul_bln=array(1=> "Jan", "Feb", "Mar", "Apr", "Mei","Jun", "Jul", "Agu", "Sep","Okt", "Nov", "Des");
 
$sqld="select * from `$tbrekanan` order by `id_mesin` asc limit 0,1";// 
	$arrcd=getData($conn,$sqld);
	foreach($arrcd as $dd) {	
		$id_rekanan=$dd["id_rekanan"];
		$nama_rekanan=$dd["nama_rekanan"];
		$deskripsi=$dd["deskripsi"];
		$alamat=$dd["alamat"];
		$logo=$dd["logo"];
		$id_mesin=$dd["id_mesin"]; 
			
for($bulan=1;$bulan<=12;$bulan++){ 
$wk=$judul_bln[(int)$bulan];
$periode=$wk." $tahun";
	
$NF="$id_rekanan-$id_mesin $nama_rekanan $periode";	 
	$sqlc="select * from `$tbkaryawan` where `id_rekanan`='$id_rekanan' and `status`='Aktif' order by rand()";
	$jumc=getJum($conn,$sqlc);
	if($jumc >0){
		$arrc=getData($conn,$sqlc);
		foreach($arrc as $dc) {	
			$id_karyawan=$dc["id_karyawan"]; 
			$id_finger=$dc["id_finger"];
			$nama_karyawan=$dc["nama_karyawan"];
			$deskripsi=$dc["deskripsi"];
			$nomor=0;	
			for($i=0;$i<=$DURASIMASUK;$i++){	
			$nomor++;
			$R=rand(0,100);
			if($R<=80){
				$J1=cekR(6,10);
				$J2=cekR(14,24);
				$M1=cekR(1,59);
				$M2=cekR(1,59);
				$D1=cekR(1,59);
				$D2=cekR(1,59);
				
				$tanggal=$i+1;
				if($tanggal<10){$tanggal="0".$tanggal;}
				$tanggal_masuk="$tahun-$bulan-$tanggal";
				$jam_masuk=$J1.":$M1:".$D1;
				$tanggal_pulang=$tanggal_masuk;
				$jam_pulang=$J2.":$M2:".$D2;
				$status="Pulang";
				$keterangan="$NF"; 
		
$sqlc=" INSERT INTO `$tbabsensi` (
`id_mesin` ,
`id_finger` ,
`tanggal_masuk` ,
`jam_masuk` ,
`tanggal_pulang` ,
`jam_pulang` ,
`status` ,
`keterangan`
) VALUES (
'$id_mesin',
'$id_finger',
'$tanggal_masuk',
'$jam_masuk', 
'$tanggal_pulang',
'$jam_pulang',
'Masuk',
'-'
)";
process($conn,$sqlc);
			}//<80
			}//for i
}//fore
}//if jumKaryawan
}//bulan
}//idmesin
?>
