<?php 
include '../koneksi.php';
$nilai  = $_GET['nilai'];
$atribut  = $_GET['atribut'];

// hapus nilai
mysqli_query($koneksi, "delete from nilai where nilai_id='$nilai'");

// hapus dataset
mysqli_query($koneksi, "delete from dataset where dataset_nilai='$nilai'");

header("location:master_nilai.php?atribut=$atribut");