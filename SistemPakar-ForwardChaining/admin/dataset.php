<?php include 'header.php'; ?>


<div class="container">

	<div class="mb-4">
		<h4>Dataset</h4>
		<small>Kelola dataset atribut dan nilai</small>
	</div>


	<div class="card">
		<div class="card-header">

			Dataset

			<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modalTambahDataset">
				<i class="fa fa-plus"></i> &nbsp Tambah Dataset Baru
			</button>

			<form action="dataset_act.php" method="post">
				<div class="modal fade" id="modalTambahDataset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h6 class="modal-title" id="exampleModalLabel">Buat Dataset Baru</h6>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<table class="table table-bordered table-striped">
									<tr>
										<th>Atribut</th>
										<th>Nilai</th>
									</tr>
									<?php 
									$atribut = mysqli_query($koneksi,"SELECT * FROM atribut ORDER BY atribut_id ASC")or die(mysqli_error($koneksi));
									while($a = mysqli_fetch_array($atribut)){
										?>
										<tr>
											<td><?php echo $a['atribut'] ?></td>
											<td>
												<input type="hidden" name="atribut[]" value="<?php echo $a['atribut_id'] ?>">
												<select name="nilai[]" class="form-control" required="required">
													<option value="">- Pilih -</option>
													<?php 
													$id_atribut = $a['atribut_id'];
													$nilai = mysqli_query($koneksi,"SELECT * FROM nilai WHERE nilai_atribut='$id_atribut'")or die(mysqli_error($koneksi));
													while($n = mysqli_fetch_array($nilai)){
														?>
														<option value="<?php echo $n['nilai_id'] ?>"><?php echo $n['nilai'] ?></option>
														<?php 
													}
													?>
												</select>
											</td>
										</tr>
										<?php 
									}
									?>
								</table>

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
		<div class="card-body">

			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="table-datatable">
					<thead>
						<tr>
							<th rowspan="2" class="text-center" width="1%">NO</th>
							<th class="text-center" colspan="<?php echo mysqli_num_rows($atribut) ?>">ATRIBUT</th>
							<th rowspan="2" class="text-center" width="10%">OPSI</th>
						</tr>
						<tr>
							<?php 
							$atribut = mysqli_query($koneksi,"SELECT * FROM atribut ORDER BY atribut_id ASC")or die(mysqli_error($koneksi));
							while($a = mysqli_fetch_array($atribut)){
								?>
								<th class="text-center"><?php echo $a['atribut'] ?></th>
								<?php 
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no=1;
						$data = mysqli_query($koneksi,"SELECT dataset_unik from dataset group by dataset_unik");
						while($d = mysqli_fetch_array($data)){
							?>
							<tr>
								<td><?php echo $no++; ?></td>
								<?php 
								$unik = $d['dataset_unik'];
								$atribut = mysqli_query($koneksi,"SELECT * FROM atribut ORDER BY atribut_id ASC")or die(mysqli_error($koneksi));
								while($a = mysqli_fetch_array($atribut)){
									$id_atribut = $a['atribut_id'];
									$dataset = mysqli_query($koneksi,"select * from dataset,atribut,nilai where dataset_atribut='$id_atribut' and dataset_unik='$unik' and dataset_atribut=atribut_id and dataset_nilai=nilai_id");
									$cek = mysqli_num_rows($dataset);
									if($cek > 0){
										$d = mysqli_fetch_assoc($dataset);
										?>
										<td class="text-center"><?php echo $d['nilai'] ?></td>
										<?php 
									}else{
										?>
										<td class="text-center">-</td>
										<?php
									}
								}
								?>
								<td>    
									<center>
										<div class="btn-group">

											<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_dataset_<?php echo $d['dataset_unik'] ?>">
												<i class="fa fa-cog"></i>
											</button>

											<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_dataset_<?php echo $d['dataset_unik'] ?>">
												<i class="fa fa-trash"></i>
											</button>

										</div>
									</center>

									<form action="dataset_update.php" method="post">
										<div class="modal fade" id="edit_dataset_<?php echo $d['dataset_unik'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h6 class="modal-title" id="exampleModalLabel">Edit Dataset</h6>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">

														<table class="table table-bordered table-striped">
															<tr>
																<th>Atribut</th>
																<th>Nilai</th>
															</tr>
															<?php 
															$unik = $d['dataset_unik'];

															$atribut = mysqli_query($koneksi,"SELECT * FROM atribut ORDER BY atribut_id ASC")or die(mysqli_error($koneksi));
															while($a = mysqli_fetch_array($atribut)){
																?>
																<tr>
																	<td><?php echo $a['atribut'] ?></td>
																	<td>
																		<input type="hidden" name="unik" value="<?php echo $unik ?>">
																		<input type="hidden" name="atribut[]" value="<?php echo $a['atribut_id'] ?>">
																		<select name="nilai[]" class="form-control" required="required">
																			<option value="">- Pilih -</option>
																			<?php 
																			$id_atribut = $a['atribut_id'];
																			$nilai = mysqli_query($koneksi,"SELECT * FROM nilai WHERE nilai_atribut='$id_atribut'")or die(mysqli_error($koneksi));
																			while($n = mysqli_fetch_array($nilai)){
																				$dataset2 = mysqli_query($koneksi,"select * from dataset,atribut,nilai where dataset_atribut='$id_atribut' and dataset_unik='$unik' and dataset_atribut=atribut_id and dataset_nilai=nilai_id");
																				$ds = mysqli_fetch_assoc($dataset2);
																				?>
																				<option <?php if($n['nilai_id'] == $ds['dataset_nilai']){ echo "selected='selected'"; } ?> value="<?php echo $n['nilai_id'] ?>"><?php echo $n['nilai'] ?></option>
																				<?php 
																			}
																			?>
																		</select>
																	</td>
																</tr>
																<?php 
															}
															?>
														</table>

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
									<div class="modal fade" id="hapus_dataset_<?php echo $d['dataset_unik'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h6 class="modal-title" id="exampleModalLabel">Peringatan!</h6>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">

													<p>Yakin ingin menghapus dataset ini ?</p>
													<small>Semua data yang terhubung dengan dataset ini akan di hapus</small>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
													<a href="dataset_hapus.php?unik=<?php echo $d['dataset_unik'] ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Hapus</a>
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