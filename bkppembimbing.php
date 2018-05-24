<div class="col-md-10">
		<div class="tile">
			<div class="tile-title">
			<h3>Daftar Jumlah Reward & Punishment Siswa</h3>
			<h5>Rayon: <?php echo $_SESSION['rayon'] ?></h5>
			</div>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">NIS</th>
							<th rowspan="2">Nama</th>
							<th rowspan="2">Rayon</th>
							<th rowspan="2">Rombel</th>
							<th colspan="2">Kelompok</th>
							<th rowspan="2">Aksi</th>
						</tr>
						<tr>
							<th>Reward</th>
							<th>Punishment</th>
						</tr>
					</thead>
					<?php 
						$sql = mysqli_query($con, "SELECT * FROM query_bkp WHERE rayon='$_SESSION[rayon]' GROUP BY nis");
						$no = 1;

						while ($bkp = mysqli_fetch_assoc($sql)) {

							$ha = mysqli_query($con, "SELECT SUM(skor) as reward FROM tb_input WHERE nis='$bkp[nis]' and kelompok='H'");
							$h = mysqli_fetch_assoc($ha);

							$pe = mysqli_query($con, "SELECT SUM(skor) as punishment FROM tb_input WHERE nis='$bkp[nis]' and kelompok='P'");
							$p = mysqli_fetch_assoc($pe);

					 ?>
					 <tbody>
					 	<tr>
					 		<td><?= $no; ?></td>
					 		<td><?= $bkp['nis']; ?></td>
					 		<td><?= $bkp['nama']; ?></td>
					 		<td><?= $bkp['rayon']; ?></td>
					 		<td><?= $bkp['rombel']; ?></td>
					 		<td><?= ($h['reward']!==NULL)?$h['reward']:"0"; ?></td>
					 		<td><?= ($p['punishment']!==NULL)?$p['punishment']:"0"; ?></td>
					 		<td>
					 			<a target="output" href="printbkp.php?nis=<?= $bkp['nis'] ?>">Lihat</a>
					 		</td>
					 	</tr>
					 </tbody>
					 <?php $no++; } ?>
				</table>
			</div>
		</div>
	</div>