<?php 
	$perintah = new CRUD();

	if (isset($_GET['hapus'])) {
		$table = "tb_input";
		$where = "nis='$_GET[nis]'";
		$where1 = "kode_kinerja='$_GET[kk]'";
		$where2 = "tgl='$_GET[tgl]'";
		$where3 = "saksi='$_GET[saksi]'";
		$redirect = "?page=hapusbkp";
		$response = $perintah->deletebkp($table,$where,$where1,$where2,$where3,$redirect);
	}
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
	<div class="col-md-4">
		<div class="tile">
			<h3 class="tile-title">Form Hapus BKP Siswa</h3>
			<div class="tile-body">
			<div class="form-group">
				<div class="form-group">
					<label>Masukkan NIS</label>
					<input class="form-control" type="text" name="nis" autocomplete="off" required>
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
			echo "<script>window.location.href='?page=hapusbkp&nis=$_POST[nis]'</script>";
		}
	 ?>	
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-title">Daftar BKP Siswa</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<tr>
							<th>No.</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>Rayon</th>
							<th>Rombel</th>
							<th>Kode Kinerja</th>
							<th>Kelompok</th>
							<th>Nama Kinerja</th>
							<th>Skor</th>
							<th>Tanggal</th>
							<th>Saksi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<?php 
						$data = $perintah->edit("query_bkp", "nis", "$_GET[nis]");
						$no = 1;

						foreach ($data as $bkp) {
					 ?>
					 <tbody>
					 	<tr>
					 		<td><?php echo $no;?></td>
					 		<td><?php echo $bkp['nis']; ?></td>
					 		<td><?php echo $bkp['nama']; ?></td>
					 		<td><?php echo $bkp['rayon']; ?></td>
					 		<td><?php echo $bkp['rombel']; ?></td>
					 		<td><?php echo $bkp['kode_kinerja']; ?></td>
					 		<td><?php echo $bkp['kelompok']; ?></td>
					 		<td><?php echo $bkp['nama_kinerja']; ?></td>
					 		<td><?php echo $bkp['skor']; ?></td>
					 		<td><?php echo $bkp['tgl']; ?></td>
					 		<td><?php echo $bkp['saksi']; ?></td>
					 		<td>
					 			<a href="#" class="btn btn-danger" id="btdelete<?php echo $no; ?>" >Hapus</a></td>
					 		</td>
					 	</tr>
					 	<script>
		                    $('#btdelete<?php echo $no; ?>').click(function(e){
		                      e.preventDefault();
		                        swal({
		                        title: "Hapus Data",
		                        text: "Yakin ingin menghapus kode kinerja <?= $bkp['kode_kinerja'] ?>?",
		                        type: "warning",
		                        showCancelButton: true,
		                        confirmButtonText: "Ya",
		                        cancelButtonText: "Tidak",
		                        closeOnConfirm: false,
		                        closeOnCancel: true
		                        }, function(isConfirm) {
		                          if (isConfirm) {
		                            window.location.href="?page=hapusbkp&hapus&nis=<?php echo $bkp['nis'] ?>&kk=<?php echo $bkp['kode_kinerja'] ?>&tgl=<?php echo $bkp['tgl'] ?>&saksi=<?php echo $bkp['saksi'] ?>";
		                          }
		                        });
		                      });
		                  </script>
					 </tbody>
					<?php $no++; } ?>
				</table>
			</div>
		</div>
	</div>
</div>
</form>