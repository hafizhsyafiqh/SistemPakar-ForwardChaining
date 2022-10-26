<?php 

include '../koneksi.php';
$id = $_GET['id'];

mysqli_query($koneksi, "delete from user where user_id='$id'");

mysqli_query($koneksi, "delete from user_input where user='$id'");

header("location:index.php");