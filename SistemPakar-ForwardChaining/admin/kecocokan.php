<?php include 'header.php'; ?>

<main class="container-fluid">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Relasi Gejala & Kerusakan</h1>
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
      
    </div>
  </div>

  
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Relasi Gejala & Kerusakan</span>
        </div>
        <div class="card-body">


          <div class="table-responsive">

            <table class="table table-bordered table-hover table-striped">    
              <tr>      
                <th width="1%" class="text-center">No</th>
                <th>ALTERNATIF</th>
                <?php
                $kriteria = mysqli_query($koneksi, "select * from gejala");    
                while($k=mysqli_fetch_array($kriteria)){
                  ?>
                  <th width="1%" class="text-center"><?php echo $k['gej_inisial'] ?></th>          
                  <?php
                }
                ?>
                <th width="1%" class="text-center">OPSI</th>
              </tr>
              <?php
              $no = 1;
              $alternatif = mysqli_query($koneksi, "select * from alternatif");    
              while($ker=mysqli_fetch_array($alternatif)){
                $a=$ker['alt_id'];

                ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td>(<?php echo $ker['alt_inisial'] ?>) <?php echo $ker['alt_nama'] ?></td>
                  
                  <?php 
                  $g = mysqli_query($koneksi, "select * from gejala");   
                  while($ge=mysqli_fetch_array($g)){
                    $b = $ge['gej_id'];
                    ?>

                    <td style="width: 1%" class="text-center">
                      <?php       
                      $kecocokan = mysqli_query($koneksi, "select * from kecocokan where kecocokan.kec_alternatif='$a' and kecocokan.kec_gejala='$b'");
                      $cek = mysqli_num_rows($kecocokan);
                      if($cek > 0){
                        $ke = mysqli_fetch_array($kecocokan);
                        if($ke['kec_nilai'] == "1"){
                          echo "Ya";
                        }else{
                          echo "-";
                        }
                      }else{
                        echo "-";
                      }
                      ?>
                    </td> 

                  <?php } ?>

                  <td>
                    <a class="btn btn-sm btn-primary" href="kecocokan_edit.php?alternatif=<?php echo $ker['alt_id'];?>"><i class="fa fa-wrench"></i></a>
                  </td>

                </tr>
              <?php } ?>
            </table>
          </div>
          

        </div>
      </div>
    </div>
  </div>

</main>



<?php include 'footer.php'; ?>
