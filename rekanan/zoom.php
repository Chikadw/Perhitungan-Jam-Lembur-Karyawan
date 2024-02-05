<?php
include"../konmysqli.php";

echo"<link href='../$PATH/$css' rel='stylesheet' type='text/css' />";
$sql="SELECT `logo` FROM `$tbrekanan` WHERE `id_rekanan`='".$_GET["id"]."'";
if(getJum($conn,$sql)>0){
	$d = getField($conn,$sql);
	$logo=$d["logo"];
}
else{$logo="avatar.jpg";	}
echo "<p align=center><img src='../$YPATH/$logo' border='0' width='100%' height='100%'></p>";
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


?>
