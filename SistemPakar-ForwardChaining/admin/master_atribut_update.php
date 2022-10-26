<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$atribut  = $_POST['atribut'];

if(isset($_POST['penentu'])){
	$penentu  = $_POST['penentu'];
	mysqli_query($koneksi, "update atribut set atribut_penentu='tidak'");
	mysqli_query($koneksi, "update atribut set atribut='$atribut', atribut_penentu='ya' where atribut_id='$id'");
}else{
	mysqli_query($koneksi, "update atribut set atribut='$atribut' where atribut_id='$id'");
}

header("location:master.php");