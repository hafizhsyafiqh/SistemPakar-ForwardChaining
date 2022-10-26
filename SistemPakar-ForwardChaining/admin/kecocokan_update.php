<?php 
include '../koneksi.php';
$alternatif = $_POST['alternatif'];
$gejala = $_POST['gejala'];
$nilai = $_POST['nilai'];

mysqli_query($koneksi, "delete from kecocokan where kec_alternatif='$alternatif'");
for($a=0;$a<count($gejala);$a++){	
	mysqli_query($koneksi, "insert into kecocokan values(null,'$alternatif','$gejala[$a]','$nilai[$a]')");
}
header("location:kecocokan.php");
?>