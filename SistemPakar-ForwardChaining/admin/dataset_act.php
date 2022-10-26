<?php 
include '../koneksi.php';
$atribut = $_POST['atribut'];
$nilai = $_POST['nilai'];



$terbesar = mysqli_query($koneksi,"select dataset_unik from dataset order by dataset_unik desc limit 1");
$t = mysqli_fetch_assoc($terbesar);

$unik = $t['dataset_unik']+1;


for($a = 0; $a < count($atribut); $a++){

	$aa = $atribut[$a];
	$na = $nilai[$a];

	mysqli_query($koneksi, "insert into dataset values (NULL,'$unik','$aa','$na')");

}



header("location:dataset.php");