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
			<h3 class="tile-title">
				Absensi Siswa
			</h3>
			<div class="tile-body">
				<div class="form-group">
					<label> Tanggal</label>
					<input class="form-control" id="demoDate" name="tgl" type="text" required placeholder="Masukkan Tanggal" value="<?= @$_GET['tgl']; ?>">
				</div>
				<div class="form-group">
					<label >Rombel</label>
					 <select class="form-control" name="rombel" id="exampleSelect1" required>
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
			echo "<script>window.location.href='?page=absensi&rombel=$_POST[rombel]&tgl=$_POST[tgl]'</script>";
		}
		if (!empty($_GET['rombel'])){
			$table = "query_absen";
			$where = "rombel";
			$whereValues = @$_GET['rombel'];
			$data = $perintah->selectWhere($table,$where,$whereValues);
			$tglAbsen = $data['tgl_absen'];
			
			if($tglAbsen == $_GET['tgl']){
				echo "<script>alert('ROMBEL $_GET[rombel] TANGGAL $_GET[tgl] sudah diabsen!');document.location.href='?page=absensi'</script>"; 
			}else{
	 ?>
	<div class="col-md-9">
		<div class="tile">
			<h3 class="tile-title">
				Daftar Absensi Siswa
			</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">NIS</th>
                    <th rowspan="2">Nama </th>
                    <th colspan="4">Status</th>
                    <th rowspan="2">Tanggal</th>
                  </tr>
                  <tr>	
					<th>H</th>
					<th>S</th>
					<th>I</th>
					<th>A</th>
                  </tr>
                </thead>
                <tbody>
					<?php 
            			$no = 1;
            			$table = "tb_siswa";
						$where = "rombel";
						$whereValues = @$_GET['rombel'];
						$data = $perintah->edit($table,$where,$whereValues);
            			foreach ($data as $absen) { ?>
            			<tr>
              				<td><?php echo $no; ?></td>
              				<td><?php echo $absen['nis'] ?></td>
              				<td><?php echo $absen['nama'] ?></td>
              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="hadir" checked="checked"></td>
              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="sakit"></td>
              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="izin"></td>
              				<td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="alpa"></td>
              				<td><?php echo $_GET['tgl']; ?></td>
            			</tr>
          			<?php $no++;

          			if (@$_POST['keterangan'.@$absen['nis']] == 'hadir') {
						$values = "'$absen[nis]', '1', '0', '0', '0', '$_GET[tgl]'"; 
					}else if (@$_POST['keterangan'.@$absen['nis']] == 'sakit') {
						$values = "'$absen[nis]', '0', '1', '0', '0', '$_GET[tgl]'"; 
					}else if (@$_POST['keterangan'.@$absen['nis']] == 'izin') {
						$values = "'$absen[nis]', '0', '0', '1', '0', '$_GET[tgl]'"; 
					}else if (@$_POST['keterangan'.@$absen['nis']] == 'alpa'){
						$values = "'$absen[nis]', '0', '0', '0', '1', '$_GET[tgl]'"; 
					}

					if (isset($_REQUEST['simpan'])) {
						$response = $perintah->insert("tb_absen",$values,"?page=absensi");
				  	}
          			}
          			?>
          			<tr>
            			<td colspan="9" align="center">
            				<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
            			</td>
            		</tr>
	            	<?php } } ?>
                </tbody>
              </table>
			</div>
		</div>
	</div>
</div>
</form>

