
<div class="col-md-10">
		<div class="tile">
			<div class="tile-title">
			<h3>Daftar Jumlah Ketidakhadiran Siswa</h3>
			<h5>Rayon : <?php echo $_SESSION['rayon']; ?></h5>
			</div>
			<hr>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">NIS</th>
							<th rowspan="2">Nama</th>
							<th rowspan="2">Rayon</th>
							<th rowspan="2">Rombel</th>
							<th colspan="3">Keterangan</th>
						</tr>
						<tr>
							<th>S</th>
							<th>I</th>
							<th>A</th>
						</tr>
					</thead>
					<?php 
						$sql = mysqli_query($con, "SELECT SUM(sakit) as sakit, SUM(izin) as izin, SUM(alpa) as alpa, nis, nama, rayon, rombel FROM query_absen WHERE rayon='$_SESSION[rayon]' GROUP BY nis");
						$no = 1;

						while ($absen = mysqli_fetch_assoc($sql)) {
					 ?>
					
					 	<tr>
					 		<td><?php echo $no;?></td>
					 		<td><?php echo $absen['nis']; ?></td>
					 		<td><?php echo $absen['nama']; ?></td>
					 		<td><?php echo $absen['rayon']; ?></td>
					 		<td><?php echo $absen['rombel']; ?></td>
					 		<td>
					 			<?php 
					 				echo $absen['sakit']; 
					 				$coba = mysqli_query($con, "SELECT tgl_absen FROM tb_absen WHERE nis = '$absen[nis]' AND sakit = '1'");
					 				while ($hue = mysqli_fetch_assoc($coba)){ ?>
					 					<br>
					 					<?php echo $hue['tgl_absen'];
					 			} ?>
					 		</td>
					 		<td>
					 			<?php 
					 				echo $absen['izin']; 
					 				$coba = mysqli_query($con, "SELECT tgl_absen FROM tb_absen WHERE nis = '$absen[nis]' AND izin = '1'");
					 				while ($hue = mysqli_fetch_assoc($coba)){ ?>
					 					<br>
					 					<?php echo $hue['tgl_absen'];
					 			} ?>
					 		</td>
					 		<td>
					 			<?php 
					 				echo $absen['alpa']; 
					 				$coba = mysqli_query($con, "SELECT tgl_absen FROM tb_absen WHERE nis = '$absen[nis]' AND alpa = '1'");
					 				while ($hue = mysqli_fetch_assoc($coba)){ ?>
					 					<br>
					 					<?php echo $hue['tgl_absen'];
					 			} ?>
					 		</td>
					 	</tr>
					 
					<?php $no++; } ?>
				</table>
			</div>
		</div>
	</div>