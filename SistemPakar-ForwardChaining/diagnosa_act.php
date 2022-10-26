<?php 
include 'koneksi.php';

// data user
$nama = $_POST['nama'];
$hp = $_POST['hp'];

$a = mysqli_query($koneksi,"select * from kecocokan,gejala,alternatif where kecocokan.kec_gejala=gejala.gej_id and kecocokan.kec_alternatif=alternatif.alt_id");
while($aa=mysqli_fetch_array($a)){
	$alternatif = $aa['alt_inisial'];
	$gejala = $aa['gej_inisial'];
	$nilai = $aa['kec_nilai'];
	mysqli_query($koneksi,"insert into tmp_kecocokan values('$alternatif','$gejala','$nilai')");
}


mysqli_query($koneksi, "insert into user values(null,'$nama','$hp',null)");

$id_terakhir = mysqli_insert_id($koneksi);

header("location:diagnosa_mulai.php?id=$id_terakhir");
?>
