<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$atribut  = $_POST['atribut'];
$nilai  = $_POST['nilai'];

mysqli_query($koneksi, "update nilai set nilai='$nilai' where nilai_id='$id'");
header("location:master_nilai.php?atribut=$atribut");