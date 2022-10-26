<?php 
include '../koneksi.php';
$unik  = $_GET['unik'];

// hapus prodi
mysqli_query($koneksi, "delete from dataset where dataset_unik='$unik'");


// ubah prodi prodi ke lainnya
// mysqli_query($koneksi, "update mahasiswa set mahasiswa_prodi='1' where mahasiswa_prodi='$id'");
header("location:dataset.php");