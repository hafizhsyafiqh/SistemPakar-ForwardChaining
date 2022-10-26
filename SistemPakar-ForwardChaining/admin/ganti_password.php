<?php include 'header.php'; ?>


<div class="container">

	<div class="mb-4">
		<h4>Pengaturan Password</h4>
		<small>Ganti password admin.</small>
	</div>

	<div class="row justify-content-center">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-body">

					<?php 
					if(isset($_GET['alert'])){
						if($_GET['alert'] == "sukses"){
							echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
						}
					}
					?>

					<form action="ganti_password_act.php" method="post">
						<div class="form-group">
							<label>Masukkan Password Baru</label>
							<input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="password" required="required" min="5">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-sm btn-primary" value="Simpan">
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>


<?php include 'footer.php'; ?>