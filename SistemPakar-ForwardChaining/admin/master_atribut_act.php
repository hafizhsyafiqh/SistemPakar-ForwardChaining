<?php 
include '../koneksi.php';
$atribut  = $_POST['atribut'];
$penentu  = $_POST['penentu'];


if($penentu == "ya"){
	mysqli_query($koneksi, "update atribut set atribut_penentu='tidak'");
	mysqli_query($koneksi, "insert into atribut values (NULL,'$atribut','ya')");
}else{
	mysqli_query($koneksi, "insert into atribut values (NULL,'$atribut','tidak')");
}

header("location:master.php");