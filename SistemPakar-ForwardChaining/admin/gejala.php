<?php include 'header.php'; ?>


<div class="container-fluid">

  <div class="mb-4">
    <h4>Data Gejala</h4>
    <small>Data Gejala</small>
  </div>

  <div class="row mb-3">
    <div class="col-lg-12">
       <a href="gejala_tambah.php" class="btn btn-sm btn-primary btn-fill pull-right"><i class="fa fa-plus"></i> Tambah Gejala</a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">

      <div class="table-responsive">
        <table class="table table-bordered table-hover">

          <tr>
            <th class="text-center" width="1%">No</th>
            <th class="text-center" width="10%">Kode</th>
            <th>Nama Gejala</th>    
            <th class="text-center" width="12%">OPSI</th>
          </tr>

          <?php
          $no = 1; 
          $data = mysqli_query($koneksi, "select * from gejala");    
          while($d=mysqli_fetch_array($data)){
            ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td class="text-center"><?php echo $d['gej_inisial'] ?></td>
              <td><?php echo $d['gej_nama'] ?></td>     
              <td class="text-center">                  
                <a class="btn btn-sm btn-warning" href="gejala_edit.php?id=<?php echo $d['gej_id'];?>"><i class="fa fa-wrench"></i></a>
                <a class="btn btn-sm btn-danger" href="gejala_hapus.php?id=<?php echo $d['gej_id'];?>"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            <?php
          }
          ?>

        </table>
      </div>
    </div>
  </div>

</div>


<?php include 'footer.php'; ?>