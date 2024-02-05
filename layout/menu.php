 <body>

  <div class="hero_area">
 <header class="header_section">
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.php">
              <span>
                Selamat Datang! 
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <?php
if($_SESSION["cstatus"]=="Administrator"){	
      echo"
	  <li ";if($mnu=="home"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=home'>Home </a></li>
	  <li ";if($mnu=="admin"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=admin'>Pengguna</a></li>
	  
	  <li ";if($mnu=="rekanan"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=rekanan'>Rekanan</a></li>
		  
	 <li ";if($mnu=="logout"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=logout'>Logout</a></li>";
}

ELSE if($_SESSION["cstatus"]=="HRD"){  
      echo"
    <li ";if($mnu=="home"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=home'>Home </a></li>
        
      
    <li ";if($mnu=="karyawan"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=karyawan'>Karyawan</a></li>

    
    <li ";if($mnu=="penugasan"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=penugasan'>Penugasan</a></li>
    
    <li ";if($mnu=="absensi"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=absensi'>Absensi</a></li>
     
    <li ";if($mnu=="penggajian"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=penggajian'>Penggajian</a></li>
   
   
   <li ";if($mnu=="logout"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=logout'>Logout</a></li>";
}

else if($_SESSION["cstatus"]=="Rekanan"){	
      echo"
	  <li ";if($mnu=="home"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=home'>Home </a></li>
	  <li ";if($mnu=="profil_rekanan"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=profil_rekanan'>Profil</a></li>
	  <li ";if($mnu=="rpenugasan"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=rpenugasan'>Penugasan</a></li>
	  <li ";if($mnu=="rabsensi"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=rabsensi'>Absensi</a></li>
	  <li ";if($mnu=="rrekapitulasi"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=rrekapitulasi'>Rekapitulasi</a></li>
	   
	   <li ";if($mnu=="logout"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=logout'>Logout</a></li>";
}
else if($_SESSION["cstatus"]=="Karyawan"){	
      echo"
	  <li ";if($mnu=="home"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=home'>Home </a></li>
	  <li ";if($mnu=="profil_karyawan"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=profil_karyawan'>Profil</a></li>	  
      <li ";if($mnu=="penugasan_"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=penugasan_'>Penugasan</a></li>
	  <li ";if($mnu=="absensi_"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=absensi_'>Absensi</a></li>
	  <li ";if($mnu=="_penggajian"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=_penggajian'>Penggajian</a></li>
	 <li ";if($mnu=="_rekapitulasi"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=_rekapitulasi'>Rekapitulasi</a></li>
	 <li ";if($mnu=="logout"){echo"class='nav-item active'";} echo" class='nav-item'><a class='nav-link' href='index.php?mnu=logout'>Logout</a></li>";
}
else{
	 echo" <li class='nav-item' ";if($mnu=="home"){echo"class='nav-item active'";} echo"><a class='nav-link' href='index.php?mnu=home'>Home</a></li>";
	 echo" <li class='nav-item' ";if($mnu=="login"){echo"class='nav-item active'";} echo"><a class='nav-link' href='login.php'>Login</a></li>";	 
	}
      ?>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>