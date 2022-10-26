<?php include 'header.php'; ?>

<div class="container">

	<center>
		<h5>FORWARD CHAINING</h5>
	</center>
	<br>
	<div class="card mb-4">
		<div class="card-body">

			<br>
			<div class="chart-container" style="position: relative; height:auto; width:100%">
				
				<center>
					<h4>SELAMAT DATANG DI APLIKASI</h4>	
					<h4>DIAGNOSA KERUSAKAN LAYAR HANDPHONE DENGAN</h4>
					<h4>FORWARD CHAINING</h4>
				</center>

			</div>

		</div>
	</div>


  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h6 class="title class m-0">Data Riwayat Diagnosa</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">                          
            <table class="table table-bordered" id="tableku">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th>NAMA</th>
                  <th class="text-center">NO.HP</th>
                  <th class="text-center">KERUSAKAN</th>
                  <th class="text-center" width="15%">DETAIL</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                $data = mysqli_query($koneksi, "select * from user,alternatif where user.user_hasil=alternatif.alt_id order by user.user_id desc");
                while($d=mysqli_fetch_array($data)){
                  ?>            
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['user_nama']; ?></td>
                    <td class="text-center"><?php echo $d['user_hp']; ?></td>
                    <td class="text-center"><?php echo $d['alt_inisial']; ?> - <?php echo $d['alt_nama']; ?></td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-primary" href="index_detail.php?id=<?php echo $d['user_id']; ?>"> DETAIL</a>
                      <a class="btn btn-sm btn-danger" href="index_hapus.php?id=<?php echo $d['user_id']; ?>"> <i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>  
  </div>

	<br>

</div>


<?php include 'footer.php'; ?>