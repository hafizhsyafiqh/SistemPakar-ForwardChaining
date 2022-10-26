<?php include 'header.php'; ?>

<main class="container-fluid">
  
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="index.php" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
    </div>
  </div>

  <div class="row">

    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <h6 class="title class m-0">Detail Riwayat Diagnosa</h6>
        </div>
        <div class="card-body">

          <div class="table-responsive">              
            <?php 
            if(isset($_GET['id']) && $_GET['id'] != ""){
              ?>
              <?php 
              $id_user = $_GET['id'];
              $data = mysqli_query($koneksi, "select * from user where user.user_id='$id_user'");
              $cek = mysqli_num_rows($data);
              if($cek>0){
                while($d = mysqli_fetch_array($data)){
                  ?>
                  <table class="table table-bordered">
                    <tr>
                      <th width="20%">NAMA</th>
                      <td><?php echo $d['user_nama']; ?></td>
                    </tr>
                    <tr>
                      <th width="20%">NO.HP</th>
                      <td><?php echo $d['user_hp']; ?></td>
                    </tr> 
                    <tr>
                      <th width="20%">INPUTAN USER</th>
                      <td>
                        <ul>
                          <?php               
                          $user_input = mysqli_query($koneksi, "select * from user_input,gejala where user_input.gejala=gejala.gej_inisial and user_input.user='$id_user'");
                          while($i=mysqli_fetch_array($user_input)){
                            ?>
                            <li>
                              <?php echo $i['gej_inisial']." - ".$i['gej_nama']; ?>

                              <?php 
                              if($i['nilai'] == "0"){
                                echo "( Salah - tidak )";
                              }else{
                                echo "( Benar - ya )";
                              }
                              ?>
                            </li>

                            <?php
                          }
                          ?>
                        </ul>
                      </td>
                    </tr>        
                    <?php 
                    $hasil = $d['user_hasil'];
                    if($hasil != "0"){
                      $alternatif = mysqli_query($koneksi, "select * from alternatif where alternatif.alt_id='$hasil'");
                      while($k=mysqli_fetch_array($alternatif)){
                        ?>
                        <tr>
                          <th width="20%">HASIL alternatif</th>
                          <td><?php echo $k['alt_inisial']; ?> - <?php echo $k['alt_nama']; ?></td>
                        </tr>                               
                        <tr>
                          <th width="20%">PENYEBAB</th>
                          <td><?php echo $k['alt_penyebab']; ?></td>
                        </tr>    
                        <tr>
                          <th width="20%">SOLUSI</th>
                          <td><?php echo $k['alt_solusi']; ?> </td>
                        </tr>                                 
                        <?php 
                      }
                    }else{
                      ?>
                      <tr>
                        <th width="20%">HASIL</th>
                        <td><b><i>Data alternatif tidak ditemukan. mungkin mobil anda baik-baik saja.</i></b></td>
                      </tr>                               
                      <tr>
                        <th width="20%">PENYEBAB</th>
                        <td>-</td>
                      </tr>    
                      <tr>
                        <th width="20%">SOLUSI</th>
                        <td>-</td>
                      </tr> 
                      <?php 
                    }
                    ?>
                  </table>
                  <?php             
                }
              }else{
                header("location:diagnosa.php");
              }
            }
            ?>
          </div>

        </div>
      </div>

    </div>  

  </div>

</main>

<?php include 'footer.php'; ?>