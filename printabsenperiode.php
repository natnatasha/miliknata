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
			<h1>Laporan Ketidakhadiran Siswa</h1>
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
							<th>S</th>
							<th>I</th>
							<th>A</th>
							<th>Tanggal</th>
						</tr>
					</thead>
					<?php
						$sql = mysqli_query($con, "SELECT sakit, izin, alpa, tgl_absen FROM tb_absen WHERE nis='$_GET[nis]' AND tgl_absen BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'");
						$no = 1;

						while ($absen = mysqli_fetch_assoc($sql)) {
						
							if(@$absen['sakit'] == 1) {
								$diss = "";
								$disi = "disabled";
								$disa = "disabled";
								$sakit = "checked";
								$izin = "";
								$alpa = "";
								$tgl = $absen['tgl_absen'];
							}else if(@$absen['izin'] == 1) {
								$diss = "disabled";
								$disi = "";
								$disa = "disabled";
								$sakit = "";
								$izin = "checked";
								$alpa = "";
								$tgl = $absen['tgl_absen'];
							}else if(@$absen['alpa'] == 1) {
								$diss = "disabled";
								$disi = "disabled";
								$disa = "";
								$sakit = "";
								$izin = "";
								$alpa = "checked";
								$tgl = $absen['tgl_absen'];
							}else{
								$diss = "disabled";
								$disi = "disabled";
								$disa = "disabled";
								$sakit = "disabled";
								$izin = "disabled";
								$alpa = "disabled";
								$tgl = "";
							}

					 ?>
					<tbody>
						<tr>
		      				<td><?php echo $no; ?></td>
		      				<td><input type="radio" <?= $diss; ?> <?php echo $sakit ?> ></td>
		      				<td><input type="radio" <?= $disi; ?> <?php echo $izin ?>></td>
		      				<td><input type="radio" <?= $disa; ?> <?php echo $alpa ?>></td>
		      				<td><?php echo $tgl;?></td>
						</tr>
						<?php $no++; }  ?>
						<?php 
							$sql = mysqli_query($con,"SELECT SUM(sakit) as sakit, SUM(izin) as izin, SUM(alpa) as alpa FROM tb_absen WHERE nis='$_GET[nis]'");
							$hue = mysqli_fetch_assoc($sql);

							$s = $hue['sakit'];
							$i = $hue['izin'];
							$a = $hue['alpa'];
							$t = $s + $i + $a;
						 ?>
						 <tr>
						 	<td colspan="4" class="text-right">Jumlah Sakit	:</td>
						 	<td><?= $s; ?></td>
						 </tr>
						 <tr>
						 	<td colspan="4" class="text-right">Jumlah Izin	:</td>
						 	<td><?= $i; ?></td>
						 </tr>
						 <tr>
						 	<td colspan="4" class="text-right">Jumlah Alpa	:</td>
						 	<td><?= $a; ?></td>
						 </tr>
						 <tr>
						 	<td colspan="4" class="text-right" style="font-weight: bold;">Total	:</td>
						 	<td><?= $t; ?></td>
						 </tr>
					</tbody>
				</table>
	</div>
</body>
</html>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>