<?php 

include '../koneksi.php';
$nama = $_POST['nama'];
$inisial = $_POST['inisial'];

mysqli_query($koneksi, "insert into gejala values(null,'$inisial','$nama')");
header("location:gejala.php");