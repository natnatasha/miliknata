<?php 
	include 'controller.php';
	$perintah = new CRUD();
	$data = $perintah->selectWhere("tb_siswa", "nis", "$_GET[nis]");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    	@media print{
    		.print{
    			display: none;
    		}
    	}
    </style>
	<title>Document</title>
</head>
<body>
	<br>
	<div class="row">
		<div class="col-md-1 offset-md-1" >
			<img  src="1.png" style="width: 120px; height: 120px;">
		</div>
		<div class="col-md-8 offset-md-1" style="font-size: 35px;">
			<h1>Laporan BKP Siswa</h1>
			<p><b>SMK WIKRAMA BOGOR</b></p>
			<button class="btn btn-success print" onclick="window.print()"><i class="fa fa-print"></i>Print</button>
		</div>
	</div>	
	<hr style="height: 1px !important; background-color: black;">
	<div class="container" style="font-size: 20px;">
		<p class="text-right">Tanggal: <?= date('d/m/Y'); ?></p>
		<p>NIS		: <?= $data['nis'] ?></p>
		<p>Nama		: <?= $data['nama'] ?></p>
		<p>Rayon	: <?= $data['rayon'] ?></p>
		<p>Rombel	: <?= $data['rombel'] ?></p>
		<br>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Kinerja</th>
					<th>Kelompok</th>
					<th>Nama Kinerja</th>
					<th>Skor</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<?php
				$data = $perintah->selectDoubleWhere("query_bkp", "nis", "$_GET[nis]", "kelompok", "H");
				$no = 1;

				foreach ($data as $bkp) {
			 ?>
			<tbody>
				<tr>
      				<td><?php echo $no; ?></td>
      				<td><?php echo $bkp['kode_kinerja'] ?></td>
      				<td><?php echo $bkp['kelompok'] ?></td>
      				<td><?php echo $bkp['nama_kinerja'] ?></td>
      				<td><?php echo $bkp['skor'] ?></td>
      				<td><?php echo $bkp['tgl'];	 ?></td>
				</tr>
				<?php $no++; }  ?>
				<?php 
					$ha = mysqli_query($con, "SELECT SUM(skor) as reward FROM tb_input WHERE nis='$_GET[nis]' AND kelompok='H' AND tgl BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
					$h = mysqli_fetch_assoc($ha);

			 	?>
			 	<tr>
			 		<td colspan="5" class="text-right" style="font-weight: bold;">Total Reward	:</td>
			 		<td><?= ($h['reward']!==NULL)?$h['reward']:"0"; ?></td>
			 	</tr>
			</tbody>
		</table>
		<br>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Kinerja</th>
					<th>Kelompok</th>
					<th>Nama Kinerja</th>
					<th>Skor</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<?php
				$data = $perintah->selectDoubleWhere("query_bkp", "nis", "$_GET[nis]", "kelompok", "P");
				$no = 1;
				
				foreach ($data as $bkp) {
			 ?>
			<tbody>
				<tr>
      				<td><?php echo $no; ?></td>
      				<td><?php echo $bkp['kode_kinerja'] ?></td>
      				<td><?php echo $bkp['kelompok'] ?></td>
      				<td><?php echo $bkp['nama_kinerja'] ?></td>
      				<td><?php echo $bkp['skor'] ?></td>
      				<td><?php echo $bkp['tgl'];	 ?></td>
				</tr>
				<?php $no++; }  ?>
				<?php 
					$pe = mysqli_query($con, "SELECT SUM(skor) as punishment FROM tb_input WHERE nis='$_GET[nis]' AND kelompok='P' AND tgl BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
					$p = mysqli_fetch_assoc($pe);

			 	?>
			 	<tr>
			 		<td colspan="5" class="text-right" style="font-weight: bold;">Total Punishment	:</td>
			 		<td><?= ($p['punishment']!==NULL)?$p['punishment']:"0"; ?></td>
			 	</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>