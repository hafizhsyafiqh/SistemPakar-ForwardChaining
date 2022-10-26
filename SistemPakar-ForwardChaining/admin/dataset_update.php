<?php 
include '../koneksi.php';
$unik  = $_POST['unik'];
$atribut  = $_POST['atribut'];
$nilai  = $_POST['nilai'];

mysqli_query($koneksi,"delete from dataset where dataset_unik='$unik'");

for($a = 0; $a < count($atribut); $a++){

	$aa = $atribut[$a];
	$na = $nilai[$a];

	mysqli_query($koneksi, "insert into dataset values (NULL,'$unik','$aa','$na')");

}

header("location:dataset.php");