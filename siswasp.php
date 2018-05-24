<?php 
	$perintah = new CRUD();
?>

<style>
  .btn-primary{
    background-color: #f39c12 !important;
    border: none;
  }
</style>

<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Daftar Siswa SP 1</h3>
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
							<th>Skor</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					 <tbody>
					<?php 
						$sql = mysqli_query($con, "SELECT SUM(skor) as punishment,nis FROM query_bkp WHERE kelompok='P' GROUP BY nis");
						$no = 0;

						while ($p = mysqli_fetch_assoc($sql)){

							if ($p['punishment'] < 500 && $p['punishment'] >= 250) {
								$skor = $p['punishment'];
								$status = "SP 1";
								$data = $perintah->selectWhere("tb_siswa", "nis", "$p[nis]");
					 ?>
					 	<tr>
					 		<td><?php echo $no; ?></td>
					 		<td><?php echo $data['nis']; ?></td>
					 		<td><?php echo $data['nama']; ?></td>
					 		<td><?php echo $data['jk']; ?></td>
					 		<td><?php echo $data['rayon']; ?></td>
					 		<td><?php echo $data['rombel']; ?></td>
					 		<td><?php echo $skor; ?></td>
					 		<td><?php echo $status; ?></td>
					 		<td><a class="btn btn-primary" href="#detail<?= $data['nis'] ?>" data-toggle="modal">Print</a></td>
					 	</tr>
					 	<?php } ?>
					
					<form method="get" action="printsp1.php">
					 <div id="detail<?= $data['nis'] ?>" class="modal fade" role="dialog">
					 	<div class="modal-dialog">
					 		<div class="modal-content modal-lg">
					 			<div class="modal-header">
					 				<h4 class="modal-title">Form Cetak SP</h4>
					 				<button type="button" class="close" data-dismiss="modal">&times;</button>
					 			</div>
					 			<div class="modal-body">
					 				<div class="row">
					 					<div class="col-md-6">
					 						<b>NIS</b>
							 				<p name="nis"><?= $data['nis'] ?></p>
							 				<b>Nama</b>
							 				<p><?= $data['nama'] ?></p>
							 				<b>JK</b>
							 				<p><?= $data['jk'] ?></p>
							 				<b>Rayon</b>
							 				<p><?= $data['rayon'] ?></p>
							 				<b>Rombel</b>
							 				<p><?= $data['rombel'] ?></p>
					 					</div>
					 					<div class="col-md-6">
					 						<b>Status SP</b>
							 				<p><?= $status ?></p>
							 				<b>Skor</b>
							 				<p><?= $p['punishment'] ?></p>
							 				<b>No. Surat</b>
							 				<input type="hidden" name="nis" value="<?php echo $data['nis'] ?>">
							 				<input type="hidden" name="skor" value="<?php echo $p['punishment'] ?>">
							 				<input type="number" name="no" class="form-control">
							 				<b>Bulan</b>
							 				<input type="number" name="bln" class="form-control">
							 				<b>Tahun</b>
							 				<input type="number" name="thn" class="form-control">
					 					</div>
					 				</div>
					 			</div>
					 			<div class="modal-footer">
					 				<button type="submit" class="btn btn-primary">Print</button>
					 			</div>
					 		</div>
					 	</div>
					 </div>
					 </form>
					 	<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Daftar Siswa SP 2</h3>
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
							<th>Skor</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					 <tbody>
					<?php 
						$sql = mysqli_query($con, "SELECT SUM(skor) as punishment,nis FROM query_bkp WHERE kelompok='P' GROUP BY nis");
						$number = 0;

						while ($p = mysqli_fetch_assoc($sql)){
							if ($p['punishment'] >= 500 && $p['punishment'] < 750) {
								$number++; 
								$skor = $p['punishment'];
								$status = " SP 2";
								$data = $perintah->selectWhere("tb_siswa", "nis", "$p[nis]");
					 ?>
					 	<tr>
					 		<td><?php echo $number; ?></td>
					 		<td><?php echo $data['nis']; ?></td>
					 		<td><?php echo $data['nama']; ?></td>
					 		<td><?php echo $data['jk']; ?></td>
					 		<td><?php echo $data['rayon']; ?></td>
					 		<td><?php echo $data['rombel']; ?></td>
					 		<td><?php echo $skor; ?></td>
					 		<td><?php echo $status; ?></td>
					 		<td><a class="btn btn-primary" href="#detail<?= $data['nis'] ?>" data-toggle="modal">Print</a></td>
					 	</tr>
					 	<?php } ?>
					
					<form method="get" action="printsp2.php">
					 <div id="detail<?= $data['nis'] ?>" class="modal fade" role="dialog">
					 	<div class="modal-dialog">
					 		<div class="modal-content modal-lg">
					 			<div class="modal-header">
					 				<h4 class="modal-title">Form Cetak SP</h4>
					 				<button type="button" class="close" data-dismiss="modal">&times;</button>
					 			</div>
					 			<div class="modal-body">
					 				<div class="row">
					 					<div class="col-md-6">
					 						<b>NIS</b>
							 				<p name="nis"><?= $data['nis'] ?></p>
							 				<b>Nama</b>
							 				<p><?= $data['nama'] ?></p>
							 				<b>JK</b>
							 				<p><?= $data['jk'] ?></p>
							 				<b>Rayon</b>
							 				<p><?= $data['rayon'] ?></p>
							 				<b>Rombel</b>
							 				<p><?= $data['rombel'] ?></p>
					 					</div>
					 					<div class="col-md-6">
					 						<b>Status SP</b>
							 				<p><?= $status ?></p>
							 				<b>Skor</b>
							 				<p><?= $p['punishment'] ?></p>
							 				<b>No. Surat</b>
							 				<input type="hidden" name="nis" value="<?php echo $data['nis'] ?>">
							 				<input type="hidden" name="skor" value="<?php echo $p['punishment'] ?>">
							 				<input type="number" name="no" class="form-control">
							 				<b>Bulan</b>
							 				<input type="number" name="bln" class="form-control">
							 				<b>Tahun</b>
							 				<input type="number" name="thn" class="form-control">
					 					</div>
					 				</div>
					 			</div>
					 			<div class="modal-footer">
					 				<button type="submit" class="btn btn-primary">Print</button>
					 			</div>
					 		</div>
					 	</div>
					 </div>
					 </form>
					 	<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Daftar Siswa SP 3</h3>
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
							<th>Skor</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					 <tbody>
					<?php 
						$sql = mysqli_query($con, "SELECT SUM(skor) as punishment,nis FROM query_bkp WHERE kelompok='P' GROUP BY nis");
						$no = 1;

						while ($p = mysqli_fetch_assoc($sql)){

							if ($p['punishment'] >= 750) {
								$skor = $p['punishment'];
								$status = "SP 3";
								$data = $perintah->selectWhere("tb_siswa", "nis", "$p[nis]");
					 ?>
					 	<tr>
					 		<td><?php echo $no; ?></td>
					 		<td><?php echo $data['nis']; ?></td>
					 		<td><?php echo $data['nama']; ?></td>
					 		<td><?php echo $data['jk']; ?></td>
					 		<td><?php echo $data['rayon']; ?></td>
					 		<td><?php echo $data['rombel']; ?></td>
					 		<td><?php echo $skor; ?></td>
					 		<td><?php echo $status; ?></td>
					 		<td><a class="btn btn-primary" href="#detail<?= $data['nis'] ?>" data-toggle="modal">Print</a></td>
					 	</tr>
					 	<?php } ?>
					
					<form method="get" action="printsp3.php">
					 <div id="detail<?= $data['nis'] ?>" class="modal fade" role="dialog">
					 	<div class="modal-dialog">
					 		<div class="modal-content modal-lg">
					 			<div class="modal-header">
					 				<h4 class="modal-title">Form Cetak SP</h4>
					 				<button type="button" class="close" data-dismiss="modal">&times;</button>
					 			</div>
					 			<div class="modal-body">
					 				<div class="row">
					 					<div class="col-md-6">
					 						<b>NIS</b>
							 				<p name="nis"><?= $data['nis'] ?></p>
							 				<b>Nama</b>
							 				<p><?= $data['nama'] ?></p>
							 				<b>JK</b>
							 				<p><?= $data['jk'] ?></p>
							 				<b>Rayon</b>
							 				<p><?= $data['rayon'] ?></p>
							 				<b>Rombel</b>
							 				<p><?= $data['rombel'] ?></p>
					 					</div>
					 					<div class="col-md-6">
					 						<b>Status SP</b>
							 				<p><?= $status ?></p>
							 				<b>Skor</b>
							 				<p><?= $p['punishment'] ?></p>
							 				<b>No. Surat</b>
							 				<input type="hidden" name="nis" value="<?php echo $data['nis'] ?>">
							 				<input type="hidden" name="skor" value="<?php echo $p['punishment'] ?>">
							 				<input type="number" name="no" class="form-control">
							 				<b>Bulan</b>
							 				<input type="number" name="bln" class="form-control">
							 				<b>Tahun</b>
							 				<input type="number" name="thn" class="form-control">
					 					</div>
					 				</div>
					 			</div>
					 			<div class="modal-footer">
					 				<button type="submit" class="btn btn-primary">Print</button>
					 			</div>
					 		</div>
					 	</div>
					 </div>
					 </form>
					 	<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>