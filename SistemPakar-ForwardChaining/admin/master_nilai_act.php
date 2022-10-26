<?php 
include '../koneksi.php';
$atribut = $_POST['atribut'];
$nilai = $_POST['nilai'];

mysqli_query($koneksi, "insert into nilai values (NULL,'$nilai','$atribut')");
header("location:master_nilai.php?atribut=$atribut");