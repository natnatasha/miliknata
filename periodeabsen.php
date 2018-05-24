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
			<h3 class="tile-title">Laporan Absensi Siswa</h3>
			<div class="tile-body">
			<div class="form-group">
				<div class="form-group">
					<label>Pilih Rayon</label>
					 <select class="form-control" name="rayon" id="exampleSelect1">
					 	<option value="<?php echo @$_GET['rayon'] ?>"><?php echo @$_GET['rayon'] ?></option>
                        <?php  
	                        $rayon = $perintah->select("tb_rayon");
	                        foreach ($rayon as $rb) { ?>
	                          <option value="<?= $rb['rayon'] ?>">
	                          <?php echo $rb['rayon']; ?>
	                          </option>
                     	<?php } ?>
                    </select>
				</div>
				<div class="form-group">
					<label>Masukkan Periode</label>
					<input class="form-control" id="demoDate" name="tgl1" value="<?= @$_GET['tgl1']; ?>" type="text" placeholder="Masukkan Tanggal Awal">-<input class="form-control" id="demoDate1" name="tgl2" value="<?= @$_GET['tgl2']; ?>" type="text" placeholder="Masukkan Tanggal Akhir">
				</div>
				<div>
					<button type="submit" class="btn btn-primary" name="cetak">Tampilkan</button>
				</div>
			</div>
		</div>
		</div>
		<?php 	
			if (isset($_POST['cetak'])) {
			echo "<script>window.location.href='?page=periodeabsen&rayon=$_POST[rayon]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
			}
		 ?>		
	</div>
	<div class="col-md-9">
		<div class="tile">
			<h3 class="tile-title">Daftar Jumlah Ketidakhadiran Siswa</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">NIS</th>
							<th rowspan="2">Nama</th>
							<th rowspan="2">Rayon</th>
							<th colspan="3">Keterangan</th>
							<th rowspan="2">Aksi</th>
						</tr>
						<tr>
							<th style="text-align: center;">S</th>
							<th style="text-align: center;">I</th>
							<th style="text-align: center;">A</th>
						</tr>
					</thead>
					<?php 
						$sql = mysqli_query($con, "SELECT SUM(sakit) as sakit, SUM(izin) as izin, SUM(alpa) as alpa, nis, nama, rayon FROM query_absen WHERE rayon='$_GET[rayon]' AND tgl_absen BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' GROUP BY nis");
						$no = 1;

						while ($absen = mysqli_fetch_assoc($sql)) {
					?>
					 <tbody>
					 	<tr>
					 		<td><?php echo $no;?></td>
					 		<td><?php echo $absen['nis']; ?></td>
					 		<td><?php echo $absen['nama']; ?></td>
					 		<td><?php echo $absen['rayon']; ?></td>
					 		<td style="text-align: center;">
					 			<?php 
					 				echo $absen['sakit']; 
					 				$coba = mysqli_query($con, "SELECT tgl_absen FROM tb_absen WHERE nis = '$absen[nis]' AND sakit = '1' AND tgl_absen BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
					 				while ($hue = mysqli_fetch_assoc($coba)){ ?>
					 					<br>
					 					<?php echo $hue['tgl_absen'];
					 			} ?>
					 		</td>
					 		<td style="text-align: center;">
					 			<?php 
					 				echo $absen['izin']; 
					 				$coba = mysqli_query($con, "SELECT tgl_absen FROM tb_absen WHERE nis = '$absen[nis]' AND izin = '1' AND tgl_absen BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
					 				while ($hue = mysqli_fetch_assoc($coba)){ ?>
					 					<br>
					 					<?php echo $hue['tgl_absen'];
					 			} ?>
					 		</td>
					 		<td style="text-align: center;">
								<?php 
					 				echo $absen['alpa']; 
					 				$coba = mysqli_query($con, "SELECT tgl_absen FROM tb_absen WHERE nis = '$absen[nis]' AND alpa = '1' AND tgl_absen BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
					 				while ($hue = mysqli_fetch_assoc($coba)){ ?>
					 					<br>
					 					<?php echo $hue['tgl_absen'];
					 			} ?>
					 		</td>
					 		<td>
					 			<a target="output" href="printabsenperiode.php?nis=<?= $absen['nis'] ?>&tgl1=<?= $_GET['tgl1'] ?>&tgl2=<?= $_GET['tgl2'] ?>">Print</a>
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