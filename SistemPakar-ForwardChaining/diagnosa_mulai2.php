<?php 
include 'koneksi.php';
session_start();

$id_user = $_REQUEST['id_user'];
$inisial = $_POST['inisial'];
$jawaban = $_POST['jawaban'];

$cek = mysqli_query($koneksi,"select * from user_input where user='$id_user' and gejala='$inisial' and nilai='$jawaban'");
if(mysqli_num_rows($cek) == "0"){	
	mysqli_query($koneksi,"insert into user_input values(null,'$id_user','$inisial','$jawaban')");
}

if($jawaban == "1"){

	$al="";
	$a = mysqli_query($koneksi,"select * from tmp_kecocokan where gejala='$inisial' and nilai='1'");
	while($aa = mysqli_fetch_array($a)){
		$alternatif = $aa['alternatif'];
		$al .= ",'".$alternatif."'";
	}
	$xxx=substr($al,1);
	// echo $xxx;
	mysqli_query($koneksi,"delete from tmp_kecocokan where alternatif not in ($xxx)");

	mysqli_query($koneksi,"delete from tmp_kecocokan where nilai !='1'");

	// jawaban user
	$b="";
	$bb = mysqli_query($koneksi,"select * from user_input where user='$id_user' and nilai='1'");
	while($bbb = mysqli_fetch_array($bb)){
		$bbbb = $bbb['gejala'];
		$b .= ",'".$bbbb."'";
	}
	$bbbbb=substr($b,1);

	
	// cek gejala yang tersisa
	// jika tersisa 1, maka dia adalah alternatif yang di temukan
	$d = mysqli_query($koneksi,"select * from tmp_kecocokan where gejala not in ($bbbbb)");
	$dd = mysqli_fetch_array($d);
	$gejala_selanjutnya = $dd['gejala'];
	

	$alternatif = $dd['alternatif'];
	
	$ddd = mysqli_num_rows($d);
	if($ddd == '0'){
		$f = mysqli_query($koneksi,"select * from tmp_kecocokan");
		$ff = mysqli_fetch_array($f);
		$fff = $ff['alternatif'];
		// echo $fff;

		$g = mysqli_query($koneksi,"select * from alternatif where alt_inisial='$fff'");
		$gg = mysqli_fetch_array($g);
		$ggg = $gg['alt_id'];

		// echo $alternatif;
		mysqli_query($koneksi,"update user set user_hasil='$ggg' where user_id='$id_user'");
		header("location:diagnosa_hasil.php?id=$id_user");
	}else{
		header("location:diagnosa_mulai.php?id=$id_user&gejala=$gejala_selanjutnya");
	}


}else if($jawaban == "0"){
	
	// untuk mendapatkan data alternatif yang tidak terkait
	$data = mysqli_query($koneksi,"select * from tmp_kecocokan where gejala='$inisial' and nilai='1'");
	// while($d=mysqli_fetch_array($data)){
	// $d = mysqli_fetch_assoc($data);
	while($d = mysqli_fetch_array($data)){
		// hapus alternatif yang tidak sesuai (alternatif yang bukan pilihan dari si user)
		$alternatif = $d['alternatif'];
		mysqli_query($koneksi,"delete from tmp_kecocokan where alternatif='$alternatif'");
	}

	// cek jumlah tmp_kecocokan yang tersisa / jika masih tersisa, berarti kita akan mendapatkan pertanyaan gejala selanjutnya. jika tidak maka tampilkan hasil tidak di temukan.
	$b = mysqli_query($koneksi,"select * from tmp_kecocokan");
	$bb = mysqli_num_rows($b);
	if($bb > 0){

		$c="";
		$cc = mysqli_query($koneksi,"select * from user_input where user='$id_user'");
		while($ccc = mysqli_fetch_array($cc)){			
			$c .= ",'".$ccc['gejala']."'";						
		}

		$ccccc=substr($c,1);
		
		// cek gejala yang tersisa
		// jika tersisa 1, maka dia adalah alternatif yang di temukan
		
		$d = mysqli_query($koneksi,"select * from tmp_kecocokan where gejala not in ($ccccc) and nilai='1'");
		$dd = mysqli_fetch_array($d);
		$gejala_selanjutnya = $dd['gejala'];

		header("location:diagnosa_mulai.php?id=$id_user&gejala=$gejala_selanjutnya");
	}else{

		mysqli_query($koneksi,"update user set user_hasil='0' where user_id='$id_user'");
		// echo "hasil tidak di temukan atau printer anda baik-baik saja";
		header("location:diagnosa_hasil.php?id=$id_user");

	}
	
}


?>
