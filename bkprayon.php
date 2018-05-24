<?php 
	$perintah = new CRUD();
 ?>

<style>
  .btn-primary{
    background-color: #f39c12 !important;
    border: none;
  }
  .form-control:focus{
    border-color: #f39c12;
  }
</style>
<form method="post">
<div class="row">
	<div class="col-md-3">
		<div class="tile">
			<h3 class="tile-title">Laporan BKP Siswa</h3>
			<div class="tile-body">
			<div class="form-group">
				<div class="form-group">
					<label>Pilih Rayon</label>
					 <select class="form-control" name="rayon" id="exampleSelect1">
					 	<option value="<?php echo @$_GET['rayon'] ?>"><?php echo @$_GET['rayon'] ?></option>
                        <?php  
	                        $rayon = $perintah->select("tb_rayon");
	                        foreach ($rayon as $ry) { ?>
	                          <option value="<?= $ry['rayon'] ?>">
	                          <?php echo $ry['rayon']; ?>
	                          </option>
                     	<?php } ?>
                    </select>
				</div>
				<div>
					<button type="submit" class="btn btn-primary" name="cetak">Tampilkan</button>
				</div>
			</div>
			</div>
		</div>		
	</div>
	<?php 	
		if (isset($_POST['cetak'])) {
			echo "<script>window.location.href='?page=bkprayon&rayon=$_POST[rayon]'</script>";
		}
	?>	
	<div class="col-md-9">
		<div class="tile">
			<h3 class="tile-title">Daftar Jumlah Reward & Punishment Siswa</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">NIS</th>
							<th rowspan="2">Nama</th>
							<th rowspan="2">Rayon</th>
							<th colspan="2">Kelompok</th>
							<th rowspan="2">Aksi</th>
						</tr>
						<tr>
							<th>Reward</th>
							<th>Punishment</th>
						</tr>
					</thead>
					<?php 
						$sql = mysqli_query($con, "SELECT * FROM query_bkp WHERE rayon='$_GET[rayon]' GROUP BY nis");
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
					 		<td><?= $bkp['rombel']; ?></td>
					 		<td><?= ($h['reward']!==NULL)?$h['reward']:"0"; ?></td>
					 		<td><?= ($p['punishment']!==NULL)?$p['punishment']:"0"; ?></td>
					 		<td>
					 			<a target="output" href="printbkp.php?nis=<?= $bkp['nis']; ?>">Print</a>
					 		</td>
					 	</tr>
					 </tbody>
					 <?php $no++; } ?>
				</table>
			</div>
		</div>
	</div>
</div>
</form>