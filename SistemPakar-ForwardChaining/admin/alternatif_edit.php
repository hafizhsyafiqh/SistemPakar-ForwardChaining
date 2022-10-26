<?php include 'header.php'; ?>

<main class="container-fluid">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">Data Alternatif</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <a href="alternatif.php" class="btn btn-sm btn-primary pull-right"><i class="fa fa-arrow-left"></i> KEMBALI</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <span class="font-weight-bold">Edit Alternatif</span>
        </div>
        <div class="card-body">
          <form action="alternatif_update.php" method="post">
            <?php
            $id = $_GET['id'];
            $data = mysqli_query($koneksi, "select * from alternatif where alt_id='$id'");   
            while($d=mysqli_fetch_array($data)){
              ?>
              <div class="form-group">
                <label>Kode</label>
                <input type="hidden" name="id" value="<?php echo $d['alt_id']; ?>">
                <input type="text" class="form-control" name="inisial" value="<?php echo $d['alt_inisial']; ?>">
              </div>
              <div class="form-group">    
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $d['alt_nama']; ?>">
              </div> 
              <div class="form-group">    
                <label>Penyebab</label>
                <textarea class="form-control" name="penyebab"><?php echo $d['alt_penyebab']; ?></textarea>
              </div> 
              <div class="form-group">    
                <label>Perbaikan</label>
                <textarea class="form-control" name="solusi"><?php echo $d['alt_solusi']; ?></textarea>
              </div>       
              <div class="form-group">    
                <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
              </div>   
            <?php } ?>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</main>

<?php include 'footer.php'; ?>
