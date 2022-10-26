<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title>Administrator - SISTEM PAKAR KERUSAKAN HANDPHONE MENGGUNAKAN FORWARD CHAINING</title>

  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/plugin/datatables/css/dataTables.min.css">
  <link rel="stylesheet" href="../assets/plugin/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugin/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/depan.css">
  <?php 
  include '../koneksi.php';
  session_start();
  if($_SESSION['status'] != "administrator_logedin"){
    header("location:../index.php?alert=belum_login");
  }
  ?>

  <style>
    #table-datatable {
      width: 100% !important;
    }
    #table-datatable .sorting_disabled{
      border: 1px solid #f4f4f4;
    }
  </style>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow">
    <a class="navbar-brand" href="index.php"><b>FORWARD CHAINING</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="master.php"><i class="fa fa-briefcase"></i> Data Atribut</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="dataset.php"><i class="fa fa-file"></i> Dataset</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="analisa.php"><i class="fa fa-file"></i> Analisa</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="gejala.php"><i class="fa fa-file"></i> Data Gejala</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="alternatif.php"><i class="fa fa-file"></i> Data Kerusakan</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="kecocokan.php"><i class="fa fa-file"></i> Relasi Kerusakan</a>
        </li>
        
        <!-- <li class="nav-item active"> -->
          <!-- <a class="nav-link" href="mahasiswa.php"><i class="fa fa-users"></i> Hasil Kuesioner</a> -->
          <!-- </li> -->
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Halo, <?php 
              $id_admin = $_SESSION['id'];
              $profil = mysqli_query($koneksi,"select * from admin where admin_id='$id_admin'");
              $profil = mysqli_fetch_assoc($profil);
              ?>
              <img src="../gambar/sistem/user.png" class="user-image img-fluid" style="width: 25px;margin-top: -5px">
              <span class="hidden-xs" style=""><?php echo $profil['admin_nama']; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="ganti_password.php"><i class="fa fa-unlock"></i> Ganti Password</a>
              <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </div>
          </li>
        </ul>

      </div>
    </nav>

    <div class="badan">