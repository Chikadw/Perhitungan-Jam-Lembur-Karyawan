<?php

$DBServer = 'localhost';
$DBUser   = 'root';
$DBPass   = '';
$DBName   = '2024_absensilemburrev';
$gambar0="avatar.jpg";
$css="greenblack.css";//greenblack,gradient,flickr,amazon
$PATH="ypathcss";
$YPATH="ypathfile";

$tittle="Rancang Bangun Aplikasi Perhitungan Jam Lembur Karyawan";
$header="Rancang Bangun Aplikasi Perhitungan Jam Lembur Karyawan";
$footer="Http://www.Aplikasi-Penghitungan-Lembur.org";

$tbadmin="tb_admin";
$tbkaryawan="tb_karyawan";
$tbrekanan="tb_rekanan";
$tbabsensi="tb_absensi";
$tbpenggajian="tb_penggajian";
$tbpenugasan="tb_penugasan";
$tbpenugasan_detail="tb_penugasan_detail";

$gj1="Uang Makan";
$gj2="Uang Transport";
$gj3="Uang Tunjangan";//tunjangan
$gj4="Gaji Pokok";//basic
$gj5="Uang Lembur";

$jamkerja=9;
$jammasuknormal=9;

/*
Rumus lembur di hari kerja
- 1 jam pertama : 1,5 x upah lembur per jam
- Jam kerja berikutnya : 2 x upah lembur per jam

Rumus weekend,
Jam ke-1 hingga jam ke-8 : 2 x upah lembur per jam
Jam ke-9 : 3 x upah lembur per jam
Jam ke-10 hingga jam ke-12 : 4 x upah lembur per jam

====
- Untuk yang kurang dari 30 menit maka tidak dihitung 
- Untuk yang sama dengan 30 menit maka dihitung 0,5
- Untuk yang sama dengan 45 menit maka dihitung 0,75


*/
?>