<?php 

include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from kecocokan where kec_alternatif='$id'");


mysqli_query($koneksi, "delete from alternatif where alt_id='$id'");


header("location:alternatif.php");