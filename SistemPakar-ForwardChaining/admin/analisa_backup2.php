<?php include 'header.php'; ?>

<?php 
$pn = mysqli_query($koneksi,"SELECT * FROM atribut where atribut_penentu='ya'")or die(mysqli_error($koneksi));
$atribut_penentu = mysqli_fetch_assoc($pn);
?>

<div class="container">

	<div class="mb-4">
		<h4>Analisa</h4>
		<small>Kelola dataset atribut dan nilai</small>
	</div>


	<div class="card">
		<div class="card-header">
			Dataset
		</div>
		<div class="card-body">

			<h6 class="font-weight-bold">Tahap 1 : Pembentukan Akar Awal / Node Awal Dengan Mencari Nilai Entropy & Gain</h6>
			<br>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<tr>
						<th></th>
						<th></th>
						<th>Jumlah (S)</th>

						<?php 
						$penentu = mysqli_query($koneksi,"SELECT * FROM atribut where atribut_penentu='ya'")or die(mysqli_error($koneksi));
						while($p = mysqli_fetch_array($penentu)){
							$id_penentu = $p['atribut_id'];
							$pp = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_penentu' ORDER BY nilai_id ASC");
							while($ppp = mysqli_fetch_array($pp)){
								?>
								<th class="text-center"><?php echo $ppp['nilai'] ?> (S)</th>
								<?php 
							}
							?>
							<?php 
						}
						?>
						<th>Entrophy</th>
						<th>Gain</th>
					</tr>
					<tr>
						<th class="text-center">TOTAL</th>
						<td></td>
						<td>
							<?php 
							$jumlah = mysqli_query($koneksi,"SELECT dataset_unik FROM dataset group by dataset_unik")or die(mysqli_error($koneksi));
							$all_total_jumlah = mysqli_num_rows($jumlah);
							echo $all_total_jumlah;
							?>
						</td>
						
						<?php 
						// $arr_jumlah_penentu = array();
						$penentu = mysqli_query($koneksi,"SELECT * FROM atribut where atribut_penentu='ya'")or die(mysqli_error($koneksi));
						while($p = mysqli_fetch_array($penentu)){
							$id_penentu = $p['atribut_id'];
							$pp = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_penentu' ORDER BY nilai_id ASC");
							$ke = 1;
							while($ppp = mysqli_fetch_array($pp)){
								$id_nilai = $ppp['nilai_id'];
								$jumlah = mysqli_query($koneksi,"select * from dataset where dataset_atribut='$id_penentu' and dataset_nilai='$id_nilai'");
								$total_jumlah = mysqli_num_rows($jumlah);

								$arr_jumlah_penentu[$ke]['jumlah'] = $total_jumlah;
								
								?>
								<td class="text-center"><?php echo $total_jumlah ?></td>
								<?php 
								$ke++;
							}
							?>
							<?php 
						}
						?>
						<td class="text-center alert-danger">
							<?php 
							$hasil = 0;
							for($a = 1; $a <= count($arr_jumlah_penentu); $a++){
								$ax = $arr_jumlah_penentu[$a]['jumlah'];
								$bx = $all_total_jumlah;
								$bagi = -$ax/$bx;

								$a_log = $arr_jumlah_penentu[$a]['jumlah'];
								$b_log = $all_total_jumlah;
								$hasil_log = log($a_log/$b_log,2);

								$kali = $bagi*$hasil_log;
								$hasil+=$kali;
							}
							echo round($hasil,3);
							?>
						</td>
						<td></td>
					</tr>
					<?php 
					$gain_terbesar = 0;
					$atribut_terbesar = "";
					$atribut = mysqli_query($koneksi,"SELECT * FROM atribut where atribut_penentu='tidak' ORDER BY atribut_id ASC")or die(mysqli_error($koneksi));
					while($a = mysqli_fetch_array($atribut)){
						?>
						<tr>
							<th class="text-center"><?php echo $a['atribut'] ?></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<?php 
								$entropy = $hasil;
								?>
							</td>
						</tr>
						<?php 
						$nox = 1;
						$id_atribut = $a['atribut_id'];
						$nilai = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_atribut' ORDER BY nilai_id ASC");
						while($n = mysqli_fetch_array($nilai)){
							$id_nilai = $n['nilai_id'];
							?>
							<tr>
								<td></td>
								<td class="text-center"><?php echo $n['nilai'] ?></td>
								<td class="text-center">
									<?php 
									$jumlah = mysqli_query($koneksi,"select * from dataset where dataset_nilai='$id_nilai'");
									$total_jumlah = mysqli_num_rows($jumlah);
									echo $total_jumlah;
									?>
								</td>
								<?php 
								$id_penentu = $atribut_penentu['atribut_id'];
								$ke = 1;
								$pp = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_penentu' ORDER BY nilai_id ASC");
								while($ppp = mysqli_fetch_array($pp)){
									$id_nilai2 = $ppp['nilai_id'];
									$jumlah2 = mysqli_query($koneksi,"select dataset_unik from dataset where dataset_atribut='$id_atribut' and dataset_nilai='$id_nilai' or dataset_atribut='$id_penentu' and dataset_nilai='$id_nilai2' GROUP BY dataset_unik HAVING COUNT(dataset_unik)>1") or die(mysqli_error($koneksi));
									$total_jumlah2 = mysqli_num_rows($jumlah2);

									$arr_jumlah_penentu[$ke]['jumlah'] = $total_jumlah2;
									?>
									<td class="text-center"><?php echo $total_jumlah2 ?></td>
									<?php 
									$ke++;
								}
								?>
								<td class="text-center alert-danger">
									<?php 
									$hasil2 = 0;
									for($aa = 1; $aa <= count($arr_jumlah_penentu); $aa++){
										$ax = $arr_jumlah_penentu[$aa]['jumlah'];
										$bx = $total_jumlah;
										$bagi = -$ax/$bx;

										$a_log = $arr_jumlah_penentu[$aa]['jumlah'];
										$b_log = $total_jumlah;
										$hasil_log = log($a_log/$b_log,2);

										$kali = $bagi*$hasil_log;
										$hasil2+=($kali);

										$arr[$nox]['jumlah'] = $bx;
										$arr[$nox][$aa] = $ax;
									}

									if(!is_nan($hasil2)){
										echo round($hasil2,3);
										$arr[$nox]['entropy'] = $hasil2;
									}else{
										$arr[$nox]['entropy'] = 0;
										echo 0;
									}
									?>
								</td>
								<td></td>
							</tr>
							<?php 
							$nox++;
						}
						?>

						<!-- GAIN -->
						<tr>
							<th class="text-center alert-warning" colspan="<?php echo count($arr_jumlah_penentu)+4; ?>">GAIN <?php echo $a['atribut'] ?></th>
							<td class="text-center alert-warning">
								<?php 
								$jumlah2 = 0;
								for($aa = 1; $aa <= count($arr); $aa++){
									$bagi2 = $arr[$aa]['jumlah']/$all_total_jumlah;
									$kali2 = $bagi2*$arr[$aa]['entropy'];
									$jumlah2 += $kali2;
								}
								?>
								<?php 
								$gain = round($entropy-$jumlah2,3); 
								echo $gain;

								if($gain > $gain_terbesar){
									$gain_terbesar = $gain;
									$atribut_terbesar = $a['atribut_id'];
								}
								?>
							</td>
						</tr>
						<!-- END GAIN -->
						<?php 
					}
					?>
					<!-- GAIN TERBESAAR -->
					<tr>
						<th class="text-right bg-primary text-white" colspan="<?php echo count($arr_jumlah_penentu)+4 ?>">GAIN TERBESAR</th>
						<td class="text-center bg-primary text-white font-weight-bold">
							<?php 
							$arr_gain_terbesar['gain'] = $gain_terbesar;
							$arr_gain_terbesar['atribut'] = $atribut_terbesar;
							echo $arr_gain_terbesar['atribut'];
							echo $arr_gain_terbesar['gain'];
							?>
						</td>
					</tr>
					<!-- END GAIN TERBESAR -->

				</table>
			</div>

			<br>

			<h6 class="font-weight-bold">Tahap 2 : Menghitung Nilai Entropy Untuk Masing-masing Atribut</h6>
			<br>

			<pre>
				<?php print_r($arr); ?>
			</pre>
		</div>
	</div>

</div>


<?php include 'footer.php'; ?>