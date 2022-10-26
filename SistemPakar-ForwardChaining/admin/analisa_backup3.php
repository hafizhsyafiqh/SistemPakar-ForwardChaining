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

			<h5 class="font-weight-bold">Tahap 1 : Pembentukan Akar Awal / Node Awal Dengan Mencari Nilai Entropy & Gain</h5>
			<br>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<tr>
						<th></th>
						<th></th>
						<th>Jumlah (S)</th>

						<?php 
						$arr_pohon = array();
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
					$nod = 0;
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

								// simpan nilai entropy
							$arr_x[$nod]['nilai'][$nox]['nilai_id'] = $id_nilai;
							$arr_x[$nod]['nilai'][$nox]['entropy'] = $arr[$nox]['entropy'];

							$nox++;
						}
						?>

						<!-- GAIN -->
						<tr>
							<th class="text-center alert-warning" colspan="<?php echo count($arr_jumlah_penentu)+4; ?>">GAIN <?php echo $a['atribut'] ?></th>
							<td class="text-cener alert-warning">
								<?php //print_r($arr); ?>
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
									$gain_nilai = $id_nilai;
									$gain_atribut = $a['atribut_id'];
									$gain_atribut_nama = $a['atribut'];

									$gain_arr['entropy'] = $id_nilai;
									$gain_arr['nilai'] = $id_nilai;
								}
								?>
							</td>
						</tr>
						<!-- END GAIN -->
						<?php 
						// menyimpan semua data entropy dan gain
						$arr_x[$nod]['atribut'] = $a['atribut'];
						$arr_x[$nod]['atribut_id'] = $a['atribut_id'];
						$arr_x[$nod]['gain'] = $gain;

						$nod++;
					}
					?>
					<!-- GAIN TERBESAAR -->
					<tr>
						<th class="text-right bg-primary text-white" colspan="<?php echo count($arr_jumlah_penentu)+4 ?>">GAIN TERBESAR</th>
						<td class="text-center bg-primary text-white font-weight-bold">
							<?php 
							$arr_gain_terbesar['gain'] = $gain_terbesar;
							$arr_gain_terbesar['atribut'] = $gain_atribut;
							$arr_gain_terbesar['atribut_nama'] = $gain_atribut_nama;
							echo $arr_gain_terbesar['gain'];

							// insert pohon
							$a_atribut_id = $arr_gain_terbesar['atribut'];
							$a_atribut_nama = $arr_gain_terbesar['atribut_nama'];
							// $x_arr['atribut'] = $a_atribut_id;
							$x_arr['nama_atribut'] = $a_atribut_nama;
							// array_push($arr_pohon, $x_arr);

							
							$noy = 0;
							$anak = mysqli_query($koneksi,"select * from nilai where nilai_atribut='$a_atribut_id'");
							while($a = mysqli_fetch_array($anak)){
								$x_arr_anak[$noy]['nama'] = $a['nilai'];
								$noy++;
							}

							$x_arr['anak'] = $x_arr_anak;
							array_push($arr_pohon, $x_arr);
							?>
						</td>
					</tr>
					<!-- END GAIN TERBESAR -->

				</table>
			</div>

			<br>

			






			<?php 
			// cek gain terbesar
			$atribut_terbesar = "";
			$gain_terbesar = 0;
			$no_terbesar = 0;
			for($a = 0; $a < count($arr_x); $a++){
				if($arr_x[$a]['gain'] > $gain_terbesar){
					$gain_terbesar = $arr_x[$a]['gain'];
					$atribut_terbesar = $arr_x[$a]['atribut_id'];
					$no_terbesar = $a;
				}
			}
			// gain terbesar telah di dapatkan
			//$arr_x[$no_terbesar]
			// echo $arr_x[$no_terbesar]['gain'];

			$no_node = 0;
			for($b = 1; $b <= count($arr_x[$no_terbesar]['nilai']); $b++){
				$entropy = $arr_x[$no_terbesar]['nilai'][$b]['entropy'];
				if($entropy > 0){
					$atribut_id = $arr_x[$no_terbesar]['atribut_id'];
					$nilai_id = $arr_x[$no_terbesar]['nilai'][$b]['nilai_id'];
					// echo $atribut_id;

					$arr_pohon[$no_node]['nilai_bercabang'] = $nilai_id; 
					buat_node($atribut_id,$nilai_id,$no_node);
					$no_node++;
				}else{
					$arr_pohon[$no_node]['nilai_bercabang'] = 0; 
				}
			}

			// echo $atribut_terbesar;
			// echo "<br>";
			// echo $gain_terbesar;
			// echo "<br>";
			// echo $no_terbesar;

			// echo "id atribut gain terbesar = " . $atribut_id;
			// echo "id nilai yg gain terbesar = " . $nilai_id;
			// cek node selabjutnya

			?>






			
			<?php 
			function buat_node($atribut_id,$nilai_id,$no_node){
				global $koneksi;
				global $arr_pohon;
				global $atribut_penentu;
				?>

				<h4>Node 1.<?php echo $no_node ?></h4>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center" width="1%">NO</th>
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
							$data = mysqli_query($koneksi,"SELECT dataset_unik from dataset where dataset_atribut='$atribut_id' and dataset_nilai='$nilai_id' group by dataset_unik");
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

								</tr>
								<?php 
							}
							?>
						</tbody>
					</table>
				</div>


				s


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
							<td class="text-center">
								<?php 
								$jumlah = mysqli_query($koneksi,"SELECT dataset_unik FROM dataset where dataset_atribut='$atribut_id' and dataset_nilai='$nilai_id' group by dataset_unik")or die(mysqli_error($koneksi));
								$all_total_jumlah = mysqli_num_rows($jumlah);
								echo $all_total_jumlah;
								?>
							</td>

							<?php 
							$penentu = mysqli_query($koneksi,"SELECT * FROM atribut where atribut_penentu='ya'")or die(mysqli_error($koneksi));
							while($p = mysqli_fetch_array($penentu)){
								$id_penentu = $p['atribut_id'];
								$pp = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_penentu' ORDER BY nilai_id ASC");
								$ke = 1;
								while($ppp = mysqli_fetch_array($pp)){
									$id_nilai = $ppp['nilai_id'];
									$jumlah = mysqli_query($koneksi,"select * from dataset where dataset_atribut='$id_penentu' and dataset_nilai='$id_nilai' and dataset_unik in (select dataset_unik from dataset where dataset_atribut='$atribut_id' and dataset_nilai='$nilai_id')")or die(mysqli_error($koneksi));
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
						$nod = 0;
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

						// hapus nilai yg entropy nya tidak nol
							if($id_atribut == $atribut_id){
								$nilai = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_atribut' and nilai_id='$nilai_id' ORDER BY nilai_id ASC");
							}else{
								$nilai = mysqli_query($koneksi,"SELECT * FROM nilai where nilai_atribut='$id_atribut' ORDER BY nilai_id ASC");
							}

							while($n = mysqli_fetch_array($nilai)){
								$id_nilai = $n['nilai_id'];
								?>
								<tr>
									<td></td>
									<td class="text-center"><?php echo $n['nilai'] ?></td>
									<td class="text-center">
										<?php 
										$jumlah = mysqli_query($koneksi,"select * from dataset where dataset_nilai='$id_nilai' and dataset_unik in (select dataset_unik from dataset where dataset_atribut='$atribut_id' and dataset_nilai='$nilai_id')")or die(mysqli_error($koneksi));
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


										$jumlah2 = mysqli_query($koneksi,"SELECT dataset_unik FROM dataset where dataset_atribut='$id_atribut' and dataset_nilai='$id_nilai' and dataset_unik in(select dataset_unik from dataset where dataset_atribut='$id_penentu' and dataset_nilai='$id_nilai2') and dataset_unik in(select dataset_unik from dataset where dataset_atribut='$atribut_id' and dataset_nilai='$nilai_id')")or die(mysqli_error($koneksi));

										$total_jumlah2 = mysqli_num_rows($jumlah2);

										$arr_jumlah_penentu[$ke]['jumlah'] = $total_jumlah2;
										?>
										<td class="text-center">
											<?php echo $total_jumlah2 ?>
										</td>
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

								// simpan nilai entropy
								$arr_x[$nod]['nilai'][$nox]['nilai_id'] = $id_nilai;
								$arr_x[$nod]['nilai'][$nox]['entropy'] = $arr[$nox]['entropy'];

								$nox++;
							}
							?>









							<!-- GAIN -->
							<tr>
								<th class="text-center alert-warning" colspan="<?php echo count($arr_jumlah_penentu)+4; ?>">GAIN <?php echo $a['atribut'] ?></th>
								<td class="text-cener alert-warning">
									<?php //print_r($arr); ?>
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
										$gain_nilai = $id_nilai;
										$gain_atribut = $a['atribut_id'];
										$gain_atribut_nama = $a['atribut'];

										$gain_arr['entropy'] = $id_nilai;
										$gain_arr['nilai'] = $id_nilai;
									}
									?>
								</td>
							</tr>
							<!-- END GAIN -->
							<?php 
						// menyimpan semua data entropy dan gain
							$arr_x[$nod]['atribut'] = $a['atribut'];
							$arr_x[$nod]['atribut_id'] = $a['atribut_id'];
							$arr_x[$nod]['gain'] = $gain;

							$nod++;
						}
						?>
						<!-- GAIN TERBESAAR -->
						<tr>
							<th class="text-right bg-primary text-white" colspan="<?php echo count($arr_jumlah_penentu)+4 ?>">GAIN TERBESAR</th>
							<td class="text-center bg-primary text-white font-weight-bold">
								<?php 
								$arr_gain_terbesar['gain'] = $gain_terbesar;
								$arr_gain_terbesar['atribut'] = $gain_atribut;
								$arr_gain_terbesar['atribut_nama'] = $gain_atribut_nama;
								echo $arr_gain_terbesar['gain'];

								// insert_pohon
								$a_atribut_id = $arr_gain_terbesar['atribut'];
								$a_atribut_nama = $arr_gain_terbesar['atribut_nama'];
								$x_arr['atribut'] = $a_atribut_id;
								$x_arr['nama_atribut'] = $a_atribut_nama;

								$noy = 0;
								$anak = mysqli_query($koneksi,"select * from nilai where nilai_atribut='$a_atribut_id'");
								while($a = mysqli_fetch_array($anak)){
									$x_arr_anak[$noy]['nama'] = $a['nilai'];
									$noy++;
								}

								$x_arr['anak'] = $x_arr_anak;
								array_push($arr_pohon, $x_arr);

								?>
							</td>
						</tr>
						<!-- END GAIN TERBESAR -->

					</table>
				</div>

				xxxx
				<?php

				// cek gain terbesar
				$atribut_terbesar = "";
				$gain_terbesar = 0;
				$no_terbesar = 0;
				for($a = 0; $a < count($arr_x); $a++){
					if($arr_x[$a]['gain'] > $gain_terbesar){
						$gain_terbesar = $arr_x[$a]['gain'];
						$atribut_terbesar = $arr_x[$a]['atribut_id'];
						$no_terbesar = $a;
					}
				}

				$no_node = 1;
				for($b = 1; $b <= count($arr_x[$no_terbesar]['nilai']); $b++){
					$entropy = $arr_x[$no_terbesar]['nilai'][$b]['entropy'];
					if($entropy > 0){
						$atribut_id = $arr_x[$no_terbesar]['atribut_id'];
						$nilai_id = $arr_x[$no_terbesar]['nilai'][$b]['nilai_id'];
					// echo $atribut_id;

						$arr_pohon[$no_node]['nilai_bercabang'] = $nilai_id; 

						buat_node($atribut_id,$nilai_id,$no_node);
						$no_node++;
					}else{
						$arr_pohon[$no_node]['nilai_bercabang'] = 0; 
					}
				}


			}
			?>
			



			<h5>Pohon keputusan</h5>

			<pre>
				<?php print_r($arr_pohon); ?>
			</pre>
			<br>
			<?php 
			
			for($p = 0; $p < count($arr_pohon); $p++){
				$id_pohon = $arr_pohon[$p]['atribut'];

				// $atribut = mysqli_query($koneksi,"select * from atribut where atribut_id='$id_pohon'");
				// $a = mysqli_fetch_assoc($atribut);

				echo "<br><div class='badge badge-primary p-3 rounded-circle' id='d1'>".$arr_pohon[$p]['nama_atribut']."</div>";

				$nilai = mysqli_query($koneksi,"select * from nilai where nilai_atribut='$id_pohon'");
				echo "<br>";

				while($n = mysqli_fetch_array($nilai)){
					?>
					<div class='badge badge-success p-3 rounded-circle' id='d2'>
						<?php echo $n['nilai'] ?>
						<?php 
						if($arr_pohon[$p]['nilai_bercabang'] == $n['nilai_id']){
							echo "x";
						}
						?>
					</div>
					<?php
				}
			}
			
			?>




		</div>
	</div>

</div>


<?php include 'footer.php'; ?>