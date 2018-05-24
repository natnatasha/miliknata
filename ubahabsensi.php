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
			<h3 class="tile-title">Ubah Absensi Siswa</h3>
				<div class="tile-body">
					<div class="form-group">
						<label>Tanggal</label>
						<input class="form-control" id="demoDate" name="tgl" type="text" placeholder="Masukkan Tanggal" value="<?php echo @$_GET['tgl'] ?>">
					</div>
					<div class="form-group">
						<label >Rombel</label>
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
					<div>
						<button type="submit" class="btn btn-primary" name="cetak">Tampilkan</button>
					</div>
				</div>
			</div>	
		</div>
		<?php 	
			if (isset($_POST['cetak'])) {
			echo "<script>window.location.href='?page=ubahabsensi&rombel=$_POST[rombel]&tgl=$_POST[tgl]'</script>";
			}
		 ?>
		<div class="col-md-9">	
			<div class="tile">	
				<h3 class="tile-title">Daftar Absensi Siswa</h3>
				<div class="tile-body">
					<table class="table table-hover table-bordered" id="sampleTable">
						<thead>
							<tr>
			                    <th rowspan="2">No</th>
			                    <th rowspan="2">NIS</th>
			                    <th rowspan="2">Nama </th>
			                    <th colspan="4">Status</th>
			                </tr>
			                <tr>	
								<th>H</th>
								<th>S</th>
								<th>I</th>
								<th>A</th>
			                </tr>
						</thead>
						<?php 
							$no = 1;
	            			$table = "query_absen";
							$where = "rombel";
							$whereValues = @$_GET['rombel'];
							$where1 = "tgl_absen";
							$whereValues1 = @$_GET['tgl'];
							$data = $perintah->selectDoubleWhere($table,$where,$whereValues,$where1,$whereValues1);
							$a = mysqli_query($con,"SELECT * FROM $table WHERE $where = '$whereValues' AND $where1 = '$whereValues1'");
            				while($absen = mysqli_fetch_assoc($a)){

								if($absen['hadir'] == 1) {
									$hadir = "checked";
									$sakit = "";
									$izin = "";
									$alpa = "";
								}
								if($absen['sakit'] == 1) {
									$hadir = "";
									$sakit = "checked";
									$izin = "";
									$alpa = "";
								}
								if($absen['izin'] == 1) {
									$hadir = "";
									$sakit = "";
									$izin = "checked";
									$alpa = "";
								}
								if($absen['alpa'] == 1) {
									$hadir = "";
									$sakit = "";
									$izin = "";
									$alpa = "checked";
								}

							?>
						<tbody>
							<tr>
	              				<td><?php echo $no; ?></td>
	              				<td><?php echo @$absen['nis']; ?></td>
	              				<td><?php echo @$absen['nama']; ?></td>
	              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="hadir" <?php echo $hadir ?>></td>
	              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="sakit" <?php echo $sakit ?>></td>
	              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="izin" <?php echo $izin ?>></td>
	              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="alpa" <?php echo $alpa ?>></td>
            				</tr>
            				<?php 
            					$no++;

            					if (@$_POST['keterangan'.@$absen['nis']] == 'hadir') {
									$values = "nis='$absen[nis]', hadir='1', sakit='0', izin='0', alpa='0', tgl_absen='$_GET[tgl]'"; 
								}else if (@$_POST['keterangan'.@$absen['nis']] == 'sakit') {
									$values = "nis='$absen[nis]', hadir='0', sakit='1', izin='0', alpa='0', tgl_absen='$_GET[tgl]'"; 
								}else if (@$_POST['keterangan'.@$absen['nis']] == 'izin') {
									$values = "nis='$absen[nis]', hadir='0', sakit='0', izin='1', alpa='0', tgl_absen='$_GET[tgl]'"; 
								}else if (@$_POST['keterangan'.@$absen['nis']] == 'alpa'){
									$values = "nis='$absen[nis]', hadir='0', sakit='0', izin='0', alpa='1', tgl_absen='$_GET[tgl]'"; 
								}

								if (isset($_REQUEST['ubah'])) {
									$where = "nis";
									$where1 = "tgl_absen";
									$whereValues = "$absen[nis]";
									$whereValues1 = @$_GET['tgl'];
									$response = $perintah->updateDouble("tb_absen",$values,$where,$whereValues,$where1,$whereValues1,"?page=ubahabsensi");
				  				}
            				} ?>
            				<tr>
		            			<td colspan="9" align="center">
		            				<button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
		            			</td>
            				</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</form>