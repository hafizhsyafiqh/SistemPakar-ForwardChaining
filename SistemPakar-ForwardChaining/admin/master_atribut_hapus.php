<?php 
include '../koneksi.php';
$id  = $_GET['id'];

// hapus nilai
mysqli_query($koneksi, "delete from nilai where nilai_atribut='$id'");

// hapus atribut
mysqli_query($koneksi, "delete from atribut where atribut_id='$id'");

// hapus dataset
mysqli_query($koneksi, "delete from dataset where dataset_atribut='$id'");

header("location:master.php");