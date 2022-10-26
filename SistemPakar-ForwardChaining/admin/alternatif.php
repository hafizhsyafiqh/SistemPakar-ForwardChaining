<?php include 'header.php'; ?>

<main class="container-fluid">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Kerusakan / Alternatif</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="alternatif_tambah.php" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Alternatif</a>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Data Kerusakan / Alternatif</span>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-bordered table-hover">            
              <tr>
                <th width="1%">No</th>
                <th width="1%">Kode</th>
                <th width="20%">Nama</th>    
                <th width="30%">Penyebab</th>   
                <th width="30%">Solusi Perbaikan</th>    
                <th width="15%">OPSI</th>
              </tr>
              <?php
              $no = 1; 
              $data = mysqli_query($koneksi, "select * from alternatif");    
              while($d=mysqli_fetch_array($data)){
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $d['alt_inisial'] ?></td>
                  <td><?php echo $d['alt_nama'] ?></td>     
                  <td><?php echo $d['alt_penyebab'] ?></td>     
                  <td><?php echo $d['alt_solusi'] ?></td>     
                  <td class="text-center">
                    <a class="btn btn-sm btn-warning" href="alternatif_edit.php?id=<?php echo $d['alt_id'];?>"><i class="fa fa-wrench"></i></a>
                    <a class="btn btn-sm btn-danger" href="alternatif_hapus.php?id=<?php echo $d['alt_id'];?>"><i class="fa fa-trash"></i></a>
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
  </div>

  
</main>



<?php include 'footer.php'; ?>
