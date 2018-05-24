<?php 
	$perintah = new CRUD();

	if (isset($_POST['enter'])) {
		$sql = mysqli_query($con,"SELECT * from tb_siswa WHERE nis= '$_POST[nis]'");
		$data = mysqli_fetch_array($sql);
		@$nis = $data['nis'];
		@$nama = $data['nama'];
		@$rayon = $data['rayon'];
		@$rombel = $data['rombel'];
	}

	if(isset($_POST['kinerja'])){
		$sql = mysqli_query($con,"SELECT COUNT(kode_kinerja) as jumlah from tb_input WHERE kode_kinerja = '$_POST[kinerja]' AND nis = '$_POST[nis]'");
		$jumlah = mysqli_fetch_array($sql);
		$total = $jumlah['jumlah'];

		if (@$total == 0) {
			$data = $perintah->selectWhere("tb_repush", "kode_kinerja", "$_POST[kinerja]");
			$poin = $data['skor1'];
		} else if (@$total == 1){
			$data = $perintah->selectWhere("tb_repush", "kode_kinerja", "$_POST[kinerja]");
			$poin = $data['skor2'];
		} else {
			$data = $perintah->selectWhere("tb_repush", "kode_kinerja", "$_POST[kinerja]");
			$poin = $data['skor3'];
		} 

		@$nis1 = $_POST['nis'];
		@$nama1 = $_POST['nama'];
		@$rayon1 = $_POST['rayon'];
		@$rombel1 = $_POST['rombel'];
		@$kel1 = $_POST['kel'];
	}

	if (isset($_POST['simpan'])) {
		$nis = $_POST['nis'];
		$kel = $_POST['kel'];
		$kinerja = $_POST['kinerja'];
		$skor = $_POST['skor'];
		$saksi = $_POST['saksi'];
		$tgl = $_POST['tgl'];

		$values = "'$nis', '$kel', '$kinerja', '$skor', '$saksi', '$tgl'";
		$response = $perintah->insert("tb_input", $values, "?page=bkp");

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
	<div class="col-md-8">
		<div class="tile">
			<h3 class="tile-title">Form Input BKP Siswa</h3>
			<div class="tile-body">
				<div class="row">

					<div class="col-md-4">
						<label class="control-label">NIS</label>	
						<div class="input-group">						
							<input type="text" class="form-control" value="<?php if(@$_POST['kinerja'] == ""){ echo @$nis; }else{ echo @$nis1; } ?>" name="nis" required autocomplete="off" placeholder="Masukkan NIS">
					      	<span class="input-group-btn">
					        	<button type="submit" class="btn btn-primary" name="enter">Enter</button>
					      	</span>
						</div>
						<div class="form-group">
							<label class="control-label">Nama</label>
							<input class="form-control" type="text" name="nama" readonly required value="<?php if(@$_POST['kinerja'] == ""){ echo @$nama; }else{ echo @$nama1; } ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Rayon</label>
							<input class="form-control" type="text" name="rayon" readonly required value="<?php if(@$_POST['kinerja'] == ""){ echo @$rayon; }else{ echo @$rayon1; } ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Rombel</label>
							<input class="form-control" type="text" name="rombel" readonly required value="<?php if(@$_POST['kinerja'] == ""){ echo @$rombel; }else{ echo @$rombel1; } ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Pilih Kelompok</label>
							<select class="form-control" name="kel" id="selectkel">
								<option value=""></option>
								<option value="H" <?php if(@$kel1 == "H"){echo "selected";} ?>>Reward</option>
								<option value="P" <?php if(@$kel1 == "P"){echo "selected";} ?>>Punishment</option>
							</select>
						</div> 
						
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Pilih Kinerja</label>
							<select class="form-control" name="kinerja" id="pilihkinerja" onchange="submit()">
								<option value="<?php echo @$_POST['kinerja'] ?>"><?php echo @$_POST['kinerja'] ?></option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">Skor</label>
							<input class="form-control" type="text" name="skor" readonly required value="<?php echo @$poin ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Saksi</label>
							<select class="form-control" name="saksi">
								<option value="<?php echo @$_POST['saksi'] ?>"><?php echo @$_POST['saksi'] ?></option>
								<option value="gdn">GDN</option>
								<option value="gds">GDS</option>
								<option value="kesiswaan">Kesiswaan</option>
								<option value="pramuka">Pramuka</option>
								<option value="b.indo">Guru B.Indonesia</option>
								<option value="b.inggris">Guru B.Inggris</option>
								<option value="b.sunda">Guru B.Sunda</option>
								<option value="sejarah">Guru Sejarah</option>
								<option value="mtk">Guru Matematika</option>
								<option value=pkn"">Guru PKN</option>
								<option value="agama">Guru Agama</option>
								<option value="penjas">Guru Penjasorkes</option>
								<option value="kwh">Guru KWH</option>
								<option value="fisika">Guru Fisika</option>
								<option value="kimia">Guru Kimia</option>
								<option value="bdp">Laboran BDP</option>
								<option value="htl">Laboran HTL</option>
								<option value="mmd">Laboran MMD</option>
								<option value="otkp">Laboran OTKP</option>
								<option value="rpl">Laboran RPL</option>
								<option value="tbg">Laboran TBG</option>
								<option value="tkj">Laboran TKJ</option>
							</select>
						</div>
						<div class="form-group">
							<label> Tanggal</label>
							<input class="form-control" id="demoDate" name="tgl" type="text" placeholder="Masukkan Tanggal">
						</div>
					</div>
				</div>
			
			</div>
			<div class="tile-footer">
				<button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
			</div>
		</div>
	</div>
</div>
</form>
<script>
	$(document).ready(function(){
		$("#selectkel").on('change', function(){
			$("#pilihkinerja").load("ajax_isikinerja.php?kel=" + $(this).val());
		});
	});
</script>
