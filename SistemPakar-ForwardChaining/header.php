<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title>SISTEM PAKAR KERUSAKAN HANDPHONE MENGGUNAKAN FORWARD CHAINING</title>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/plugin/datatables/css/dataTables.min.css">
  <link rel="stylesheet" href="assets/plugin/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugin/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/depan.css">

  <?php 
  include 'koneksi.php';
  session_start();
  ?>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom">
    <div class="container">
      <a class="navbar-brand" href="index.php"><b>fORWARD CHAINING</b></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active mr-3">
            <a class="nav-link" href="index.php"><i class="fa fa-home"></i> HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active mr-3">
            <a class="nav-link" href="diagnosa.php"><i class="fa fa-pencil"></i> DIAGNOSA</a>
          </li>
           <li class="nav-item active mr-3">
            <a class="nav-link" href="riwayat.php"><i class="fa fa-pencil"></i> RIWAYAT</a>
          </li>
          <li class="nav-item active">
            <a class="btn btn-light px-4" href="login.php"><i class="fa fa-lock"></i> LOGIN ADMIN</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

