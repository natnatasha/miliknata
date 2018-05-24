<?php 
	$perintah = new CRUD();
 ?>
<div class="row">
	<div class="col-md-10">
		<div class="tile">
			<h3 class="tile-title">Daftar Siswa SP</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>JK</th>
							<th>Rayon</th>
							<th>Rombel</th>
							<th>Status</th>
						</tr>
					</thead>
					 <tbody>
					<?php 
						$data = null;
						$sql = mysqli_query($con, "SELECT SUM(skor) as punishment,nis FROM query_bkp WHERE kelompok='P' AND rayon='$_SESSION[rayon]' GROUP BY nis");
						$no = 0;
						while ($p = mysqli_fetch_assoc($sql)){
							if ($p['punishment'] >= 750) {
								$status = "SP 3";
								$data = $perintah->select("tb_siswa WHERE nis = '$p[nis]'");
							} 
							else if ($p['punishment'] >= 500 && $p['punishment'] < 750) {
								$status = "SP 2";
								$data = $perintah->select("tb_siswa WHERE nis = '$p[nis]'");
							} 
							else if ($p['punishment'] < 500 && $p['punishment'] >= 250) {
								$status = "SP 1";
								$data = $perintah->select("tb_siswa WHERE nis = '$p[nis]'");
							}
					 ?>
					 	<?php
					 	if (!is_null($data)) {
					 	 foreach ($data as $ds): $no++; ?>
					 	<tr>
					 		<td><?php echo $no; ?></td>
					 		<td><?php echo $ds['nis']; ?></td>
					 		<td><?php echo $ds['nama']; ?></td>
					 		<td><?php echo $ds['jk']; ?></td>
					 		<td><?php echo $ds['rayon']; ?></td>
					 		<td><?php echo $ds['rombel']; ?></td>
					 		<td><?php echo $status; ?></td>
					 	</tr>
					 	<?php endforeach;
				 			}
				 		} ?>
					 </tbody>
				</table>
			</div>
		</div>
	</div>
</div>