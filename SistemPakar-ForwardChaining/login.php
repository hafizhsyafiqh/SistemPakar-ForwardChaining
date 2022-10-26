<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Login - SELAMAT DATANG DI APLIKASI DIAGNOSA KERUSAKAN HANDPHONE DENGAN ALGORITMA C.45</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/plugin/datatables/css/dataTables.min.css">
  <link rel="stylesheet" href="assets/plugin/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugin/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/depan.css">
</head>
<body class="bg-light">
  <br>
  <br>

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-4 mt-5">

        <center>
         <?php 
         if(isset($_GET['alert'])){
          if($_GET['alert'] == "gagal"){
            echo "<div class='alert alert-danger font-weight-bold'>LOGIN GAGAL! USERNAME DAN PASSWORD SALAH!</div>";
          }else if($_GET['alert'] == "logout"){
            echo "<div class='alert alert-success font-weight-bold'>ANDA TELAH LOGOUT</div>";
          }else if($_GET['alert'] == "belum_login"){
            echo "<div class='alert alert-warning font-weight-bold'>SILAHKAN LOGIN UNTUK MENGAKSES DASHBOARD</div>";
          }
        }
        ?>
        </center>

        <div class="card pt-5 py-4">
          <div class="card-body">

            <h5 class="text-center">Selamat datang!</h5>

            <br>
            <br>

            <form action="periksa_login.php" method="POST">
              <div class="form-group has-feedback">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" required="required" autocomplete="off">
              </div>
              <div class="form-group has-feedback">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password" required="required" autocomplete="off">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <br>
            <br>
            <center>
              <small class="">SELAMAT DATANG DI APLIKASI DIAGNOSA KERUSAKAN HANDPHONE DENGAN ALGORITMA C.45</small>
              <br>
              <small class=""><a href="index.php">Kembali</a></small>
            </center>

          </div>
        </div>

      </div>
    </div>

  </div>


  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
