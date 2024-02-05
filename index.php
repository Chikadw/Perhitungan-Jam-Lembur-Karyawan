<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
    error_reporting(E_ALL & ~E_NOTICE);
?>

<?php
session_start();
//error_reporting(0);
/*
 BASIC SALLARY	Utunjangan	Lembur	OVERTIME	ULEMBUR
1000000	400000	8092.485549	112	906358.3815
				
TGL				
1	16:00	22:00	6	
2	16:00	18	2	
3	16:00	17	1	
			9	
			*/
require_once "konmysqli.php";


$mnu = "";
if (isset($_GET["mnu"])) {
    $mnu = $_GET["mnu"];
}
 $cid="";
 $cnama="";
 $cstatus="";
  if(isset($_SESSION["cstatus"])){
	  $cid=$_SESSION["cid"]; 
	  $cnama=$_SESSION["cnama"]; 
	  $cstatus=$_SESSION["cstatus"]; 
  }
  else{
    die("<script>location.href='login.php';</script>");

  }

date_default_timezone_set("Asia/Jakarta");


?>
<script type="text/javascript">
        function berhasil(link,pesan) {
           swal({
                title: "Terimakasih",
               text: pesan,
                icon: "success",
                button: true

            }).then((result) => {
		document.location.href='?mnu='+link;
		});
        }
    </script>
<link rel="stylesheet" href="ypathcss/sweetalert/sweetalert2.min.css">
<script src="ypathcss/sweetalert/sweetalert2.min.js"></script>

<?php require_once "layout/head.php"; ?>
<?php require_once "layout/menu.php"; ?>
<?php if($mnu=="home" || $mnu==""){?>
<?php require_once "layout/slider.php"; ?>
<?php } ?>
<?php if($mnu=="home" || $mnu==""){}
else {?>
  <section class="service_section layout_padding">
    <div class="service_container">
      <div class="container ">
<?php }?>
        <?php
    if ($mnu == "admin") {
        require_once "admin/admin.php";
    } 
	else if ($mnu == "profil_manager") {
        require_once "admin/profil_manager.php";
    }
	else if ($mnu == "karyawan") {
        require_once "karyawan/karyawan.php";
    }
	else if ($mnu == "profil_karyawan") {
        require_once "karyawan/profil_karyawan.php";
    }
else if ($mnu == "_karyawan") {
        require_once "karyawan/_karyawan.php";
    }
	
	else if ($mnu == "rekanan") {
        require_once "rekanan/rekanan.php";
    }
	else if ($mnu == "profil_rekanan") {
        require_once "rekanan/profil_rekanan.php";
    }
	else if ($mnu == "absensi") {
        require_once "absensi/absensi.php";
    }
		else if ($mnu == "rabsensi") {
        require_once "absensi/rabsensi.php";
    }
	else if ($mnu == "absensi_") {
        require_once "absensi/absensi_.php";
    }
	else if ($mnu == "_absensi") {
        require_once "absensi/_absensi.php";
    }
	else if ($mnu == "penggajian") {
        require_once "penggajian/penggajian.php";
    }
	else if ($mnu == "_penggajian") {
        require_once "penggajian/_penggajian.php";
    }
	else if ($mnu == "penugasan") {
        require_once "penugasan/penugasan.php";
    } 
	else if ($mnu == "rpenugasan") {
        require_once "penugasan/rpenugasan.php";
    } 
	else if ($mnu == "penugasan_") {
        require_once "penugasan/penugasan_.php";
    } 
	else if ($mnu == "penugasan_detail") {
        require_once "penugasan_detail/penugasan_detail.php";
    } 
	else if ($mnu == "dpenugasan_detail") {
        require_once "penugasan_detail/dpenugasan_detail.php";
    } 
	else if ($mnu == "rpenugasan_detail") {
        require_once "penugasan_detail/rpenugasan_detail.php";
    } 
	else if ($mnu == "login") {
        require_once "login.php";
    } 
	else if ($mnu == "rekapitulasi") {
        require_once "rekapitulasi.php";
    } 
	else if ($mnu == "rekapitulasi2"||$mnu == "rrekapitulasi") {
        require_once "rekapitulasi2.php";
    }
	else if ($mnu == "rekapitulasi3"||$mnu == "_rekapitulasi") {
        require_once "rekapitulasi3.php";
    }
	else if ($mnu == "logout") {
        require_once "logout.php";
    }  
	
	else {
        require_once "home.php";
    }
    ?>
	<?php if($mnu=="home" || $mnu==""){}
else {?>
      </div>
    </div>
  </section>
<?php }?>
<?php require_once "layout/footer.php"; ?>