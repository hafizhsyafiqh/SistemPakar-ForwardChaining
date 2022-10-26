<?php 

include '../koneksi.php';
$id = $_POST['id'];
$nama = $_POST['nama'];
$inisial = $_POST['inisial'];

mysqli_query($koneksi, "update gejala set gej_nama='$nama', gej_inisial='$inisial' where gej_id='$id'");
header("location:gejala.php");