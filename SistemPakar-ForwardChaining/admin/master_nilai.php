<?php include 'header.php'; ?>


<div class="container">

	<div class="mb-4">
		<h4>Data Nilai Atribut</h4>
		<small>Kelola data nilai atribut.</small>
	</div>

	<div class="row mb-3">
		<div class="col-lg-12">
			<a class="btn btn-primary btn-sm" href="master.php">
				<i class="fa fa-arrow-left"></i> &nbsp Kembali
			</a>
		</div>
	</div>

	<div class="card">
		<div class="card-body">

			<h5>Atribut :</h5>

			<?php 
			$atribut = $_GET['atribut'];
			$p = mysqli_query($koneksi,"SELECT * FROM atribut WHERE atribut_id='$atribut'");
			$pp = mysqli_fetch_assoc($p);
			?>

			<div class="alert alert-info my-4">
				<?php echo $pp['atribut']; ?>
			</div>

			<button type="button" class="btn btn-primary btn-sm float-right mb-3" data-toggle="modal" data-target="#modalTambahAtribut">
				<i class="fa fa-plus"></i> Tambah Atribut Baru
			</button>
			<!-- Modal -->
			<form action="master_nilai_act.php" method="post">
				<div class="modal fade" id="modalTambahAtribut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Nilai Atribut</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<div class="form-group">
									<label>Nilai</label>
									<input type="hidden" name="atribut" required="required" value="<?php echo $atribut ?>">
									<input type="text" name="nilai" required="required" class="form-control" placeholder="Tulis nilai ..">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
								<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</form>

			<br>

			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>JAWABAN</th>
							<th class="text-center" width="10%">OPSI</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$data = mysqli_query($koneksi,"SELECT * FROM nilai WHERE nilai_atribut='$atribut'");
						while($d = mysqli_fetch_array($data)){
							?>
							<tr>
								<td><?php echo $d['nilai']; ?></td>
								<td>    
									
									<center>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_nilai_<?php echo $d['nilai_id'] ?>">
												<i class="fa fa-cog"></i>
											</button>

											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_nilai_<?php echo $d['nilai_id'] ?>">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</center>

									<form action="master_nilai_update.php" method="post">
										<div class="modal fade" id="edit_nilai_<?php echo $d['nilai_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">

														<div class="form-group" style="width:100%">
															<label>Nilai</label>
															<input type="hidden" name="atribut" value="<?php echo $atribut; ?>">
															<input type="hidden" name="id" value="<?php echo $d['nilai_id']; ?>" style="width:100%">
															<input type="text" name="nilai" required="required" class="form-control" placeholder="Tulis nilai .." value="<?php echo $d['nilai']; ?>" style="width:100%">
														</div>

													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
														<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Simpan</button>
													</div>
												</div>
											</div>
										</div>
									</form>

									<!-- modal hapus -->
									<div class="modal fade" id="hapus_nilai_<?php echo $d['nilai_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">

													<p>Yakin ingin menghapus nilai ini ?</p>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
													<a href="master_nilai_hapus.php?nilai=<?php echo $d['nilai_id'] ?>&atribut=<?php echo $atribut ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Hapus</a>
												</div>
											</div>
										</div>
									</div>

								</td>
							</tr>
							<?php 
						}
						?>
					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>


<?php include 'footer.php'; ?>