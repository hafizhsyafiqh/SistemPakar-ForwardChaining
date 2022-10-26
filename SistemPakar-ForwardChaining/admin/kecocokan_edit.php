<?php include 'header.php'; ?>

<main class="container-fluid">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Alternatif</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalKriteria">
          Lihat Kriteria
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalKriteria" tabindex="-1" role="dialog" aria-labelledby="modalKriteriaLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="modalKriteriaLabel">Data Kriteria</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="table-responsive">

                  <table class="table table-bordered"> 
                    <?php
                    $data = mysqli_query($koneksi, "select * from gejala");    
                    while($d=mysqli_fetch_array($data)){
                      ?>
                      <tr>      
                        <th><?php echo $d['gej_inisial'] ?></th>
                        <td width="1%">:</td>          
                        <td><?php echo $d['gej_nama'] ?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </table>

                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalAlternatif">
          Lihat Alternatif
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalAlternatif" tabindex="-1" role="dialog" aria-labelledby="modalAlternatifLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="modal-title" id="modalAlternatifLabel">Data Alternatif</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

                <div class="table-responsive">

                  <table class="table table-bordered"> 
                    <?php
                    $data = mysqli_query($koneksi, "select * from alternatif");    
                    while($d=mysqli_fetch_array($data)){
                      ?>
                      <tr>      
                        <th><?php echo $d['alt_inisial'] ?></th>
                        <td width="1%">:</td>          
                        <td><?php echo $d['alt_nama'] ?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </table>

                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <a href="kecocokan.php" class="btn btn-sm btn-primary pull-right"><i class="fa fa-arrow-left"></i> KEMBALI</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Edit Relasi</span>
        </div>
        <div class="card-body">

          <form action="kecocokan_update.php" method="post" class="form-inline">

            <div class="table-responsive">
              <table class="table table-bordered table-hover table-striped" border="1" style="width: 100%;">                    
                <tr>                    
                  <th style="width: 200px">Kriteria</th>
                  <?php               
                  $id_k=$_GET['alternatif'];
                  $alternatif = mysqli_query($koneksi, "select * from alternatif where alt_id='$id_k'");   
                  $ker=mysqli_fetch_assoc($alternatif);
                  $a=$ker['alt_id'];
                  ?>
                  <td>(<?php echo $ker['alt_inisial'] ?>) <?php echo $ker['alt_nama'] ?></td>
                </tr>
                <?php 
                $g = mysqli_query($koneksi, "select * from gejala");   
                while($ge=mysqli_fetch_array($g)){
                  $b = $ge['gej_id'];
                  ?>
                  <tr>
                    <td>
                      <?php echo $ge['gej_inisial'] ?>
                      <br>
                      <small class="text-muted"><?php echo $ge['gej_nama'] ?></small>
                    </td>
                    <td>
                      <input type="hidden" name="alternatif" value="<?php echo $id_k; ?>">
                      <input type="hidden" name="gejala[]" value="<?php echo $ge['gej_id']; ?>">
                      <select name="nilai[]" class="form-control" style="width: 150px" required="required">
                        <option value=""></option>
                        <?php 
                        $x = mysqli_query($koneksi, "select * from kecocokan where kec_alternatif='$a' and kec_gejala='$b'");
                        $cek = mysqli_num_rows($x);
                        if($cek > 0){
                          $xx = mysqli_fetch_array($x);
                          ?>
                          <option <?php if($xx['kec_nilai']=="0"){echo "selected='selected'";} ?> value="0">Tidak</option>  
                          <option <?php if($xx['kec_nilai']=="1"){echo "selected='selected'";} ?> value="1">Ya</option> 
                          <?php
                        }else{
                          ?>
                          <option value="0">Tidak</option>  
                          <option value="1">Ya</option> 
                          <?php
                        }

                        
                        ?>

                      </select>
                    </td>   
                  </tr>
                <?php } ?>
                <tr>
                  <td></td>
                  <td>
                    <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                  </td>
                </tr>
              </table>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

</main>

<?php include 'footer.php'; ?>
