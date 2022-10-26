<?php include 'header.php'; ?>


<div class="container">

	<div class="mb-4">
		<h4>Data Atribut</h4>
		<small>Kelola data atribut dan nilai atribut.</small>
	</div>

	<div class="row mb-3">
		<div class="col-lg-12">
			<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalTambahAtribut">
				<i class="fa fa-plus"></i> Tambah Atribut Baru
			</button>
			<!-- Modal -->
			<form action="master_atribut_act.php" method="post">
				<div class="modal fade" id="modalTambahAtribut" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Atribut Baru</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<div class="form-group">
									<label>Nama Atribut</label>
									<input type="text" name="atribut" required="required" class="form-control" placeholder="Tulis Nama Atribut ..">
								</div>

								<div class="form-group">
									<label>Atribut Penentu</label>
									<br>
									<input type="checkbox" name="penentu" class="form-cntrol" value="ya"> Ya
									<i><small class="ml-4 text-danger">Centang jika ini adalah atribut penentu</small></i>
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
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			


			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="table-datatable">
					<thead>
						<tr>
							<th class="text-center" width="1%">NO</th>
							<th>Atribut</th>
							<th class="text-center" width="35%">Nilai</th>
							<th class="text-center" width="15%">Atribut Penentu</th>
							<th class="text-center" width="13%">OPSI</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						$data = mysqli_query($koneksi,"SELECT * FROM atribut ORDER BY atribut_id ASC");
						while($d = mysqli_fetch_array($data)){
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $d['atribut']; ?></td>
								<td>
									<a class="btn btn-sm btn-primary btn-block mb-2" href="master_nilai.php?atribut=<?php echo $d['atribut_id'] ?>">Atur Nilai</a>

									<ul class="list-group">
										<?php 
										$id_atribut = $d['atribut_id'];
										$nilai = mysqli_query($koneksi,"SELECT * FROM nilai WHERE nilai_atribut='$id_atribut'")or die(mysqli_error($koneksi));
										while($n = mysqli_fetch_array($nilai)){
											?>
											<li class="list-group-item py-2"><?php echo $n['nilai'] ?></li>
											<?php 
										}
										?>
									</ul>
								</td>
								<td class="text-center">
									<?php if($d['atribut_penentu'] == "ya"){ echo "<span class='badge badge-success'>YA</span>";}else{ echo "<span class='badge badge-danger'>TIDAK</span>";} ?>
								</td>
								<td>    
									<center>
										<div class="btn-group">
											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_atribut_<?php echo $d['atribut_id'] ?>">
												<i class="fa fa-cog"></i>
											</button>

											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_atribut_<?php echo $d['atribut_id'] ?>">
												<i class="fa fa-trash"></i>
											</button>
										</div>
									</center>

									<form action="master_atribut_update.php" method="post">
										<div class="modal fade" id="edit_atribut_<?php echo $d['atribut_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Atribut</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">

														<div class="form-group" style="width:100%">
															<label>Atribut</label>
															<input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d['atribut_id']; ?>">
															<input type="text" name="atribut" required="required" class="form-control" placeholder="Tulis atribut .." value="<?php echo $d['atribut']; ?>" style="width:100%">
														</div>

														<div class="form-group" style="width:100%">
															<label>Atribut Penentu</label>
															<br>
															<input type="checkbox" name="penentu" class="form-cntrol" value="ya" <?php if($d['atribut_penentu'] == "ya"){ echo "checked='checked'";} ?>> Ya
															<i><small class="ml-4 text-danger">Centang jika ini adalah atribut penentu</small></i>
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
									<div class="modal fade" id="hapus_atribut_<?php echo $d['atribut_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">

													<p>Yakin ingin menghapus atribut ini ?</p>
													<small>Semua atribut yang terhubung dengan atribut ini akan ikut di hapus</small>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tidak</button>
													<a href="master_atribut_hapus.php?id=<?php echo $d['atribut_id'] ?>" class="btn btn-success btn-sm">Hapus</a>
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