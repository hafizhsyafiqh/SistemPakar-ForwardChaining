<?php 

include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from kecocokan where kec_gejala='$id'");

mysqli_query($koneksi, "delete from gejala where gej_id='$id'");

header("location:gejala.php");