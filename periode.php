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
					<label>Pilih Rombel</label>
					 <select class="form-control" name="rombel" id="exampleSelect1">
					 	<option value="<?php echo @$_GET['rombel'] ?>"><?php echo @$_GET['rombel'] ?></option>
                        <?php  
	                        $rombel = $perintah->select("tb_rombel");
	                        foreach ($rombel as $rb) { ?>
	                          <option value="<?= $rb['rombel'] ?>">
	                          <?php echo $rb['rombel']; ?>
	                          </option>
                     	<?php } ?>
                    </select>
				</div>
				<div class="form-group">
					<label>Masukkan Periode</label>
					<input class="form-control" id="demoDate" name="tgl1" value="<?= @$_GET['tgl1']; ?>"  type="text" placeholder="Masukkan Tanggal Awal">-<input class="form-control" id="demoDate1" name="tgl2" value="<?= @$_GET['tgl2']; ?>"  type="text" placeholder="Masukkan Tanggal Akhir">
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
		echo "<script>window.location.href='?page=periode&rombel=$_POST[rombel]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
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
							<th rowspan="2">Rombel</th>
							<th colspan="2">Kelompok</th>
						</tr>
						<tr>
							<th>Reward</th>
							<th>Punishment</th>
						</tr>
					</thead>
					<?php 
						$sql = mysqli_query($con, "SELECT * FROM query_bkp WHERE rombel='$_GET[rombel]' AND tgl BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' GROUP BY nis");
						$no = 1;

						while ($bkp = mysqli_fetch_assoc($sql)) {

							$ha = mysqli_query($con, "SELECT SUM(skor) as reward FROM tb_input WHERE nis='$bkp[nis]' AND kelompok='H' AND tgl BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
							$h = mysqli_fetch_assoc($ha);

							$pe = mysqli_query($con, "SELECT SUM(skor) as punishment FROM tb_input WHERE nis='$bkp[nis]' AND kelompok='P' AND tgl BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
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
					 			<a target="output" href="printbkperiode.php?nis=<?= $bkp['nis'] ?>&tgl1=<?= $_GET['tgl1'] ?>&tgl2=<?= $_GET['tgl2'] ?>">Print</a>
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