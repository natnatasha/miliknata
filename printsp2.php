<?php 
	include 'controller.php';
	$perintah = new CRUD();
	$data = $perintah->selectWhere("tb_siswa", "nis", "$_GET[nis]");
 ?>
 <style>
 	.font{
 		font-family: Tahoma;
 		font-size: 19px;
 	}
 </style>
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

    	.div{
    		font-size: 20px;
    	}
    </style>
 	<title>Document</title>
 </head>
 <body>
 	<br>
 	<div class="container" style="margin-top: 163px;">
 		<div class="row">
 			<div class="col-md-2">
 				<button class="btn btn-success print" onclick="window.print()"><i class="fa fa-print"></i>Print</button>
 			</div>
 			<div style="font-size: 19px;" class="col-md-2 offset-md-10" >
 				<div>Kepada</div >
			 	<div>Orang Tua Peserta Didik</div>
			 	<div style="font-weight: bold;"><?= $data['nama'] ?></div >
			 	<div>Di</div >	
			 	<div>Tempat</div>	
 			</div>
 		</div>
 		<!-- <hr style="height: 1px;background-color: black;"> -->
 		<br>
 		<h1  class="text-center"><u>SURAT PERINGATAN II</u></h1>
 		<br>
 		<?php 
 			@$bulan = $_GET['bln'];
	        switch ($bulan) {
	          case '1':
	            $bln = "I";
	          break;
	          case '2':
	            $bln = "II";
	          break;
	          case '3':
	            $bln = "III";
	          break;
	          case '4':
	            $bln = "IV";
	          break;
	          case '5':
	            $bln = "V";
	          break;
	          case '6':
	            $bln = "VI";
	          break;
	          case '7':
	            $bln = "VII";
	          break;
	          case '8':
	            $bln = "VIII";
	          break;
	          case '9':
	            $bln = "IX";
	          break;
	          case '10':
	            $bln = "X";
	          break;
	          case '11':
	            $bln = "XI";
	          break;
	          case '12':
	            $bln = "XII";
	          break;
	        }
 		 ?>
 		<h3 class="text-center">No.421.5/<?=$_GET['no']?>/SMK Wikrama/<?= $bln ?>/<?=$_GET['thn']?></h3>
 		<br>
 		<br>
 		<div class="font">
 		<p>Menindaklanjuti Surat Peringatan Pertama, Peserta Didik yang tertera di bawah ini:</p>
		<table style="font-family: Tahoma;font-size: 19px;">	
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?=  $data['nama'] ?></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td>:</td>
				<td><?=  $data['nis'] ?></td>
			</tr>
			<?php 	
				$rombel = explode(' ',$data['rombel']);
				if ($rombel[0] == "RPL") {
					$jurusan = "Rekayasa Perangkat Lunak";
				}elseif ($rombel[0] == "MMD") {
					$jurusan = "Multimedia";
				}elseif ($rombel[0] == "APK") {
					$jurusan = "Administrasi Perkantoran";
				}elseif ($rombel[0] == "TKJ") {
					$jurusan = "Teknik Komputer & Jaringan";
				}elseif ($rombel[0] == "PMN") {
					$jurusan = "Pemasaran";
				}elseif ($rombel[0] == "BDP") {
					$jurusan = "Bisnis Daring Pemasaran";
				}elseif ($rombel[0] == "TBG") {
					$jurusan = "Tata Boga";
				}elseif ($rombel[0] == "HTL") {
					$jurusan = "Perhotelan";
				}
			 ?>
			<tr>
				<td>Rombel</td>
				<td>:</td>
				<td><?= $data['rombel'] ?></td>
			</tr>
			<tr>
				<td>Rayon</td>
				<td>:</td>
				<td><?=  $data['rayon'] ?></td>
			</tr>
			<tr>
				<td>Kompetensi Keahlian</td>
				<td>:</td>
				<td><?=  $jurusan ?></td>
			</tr>
			<tr>
				<td>Skor Pelanggaran</td>
				<td>:</td>
				<td><?=  $_GET['skor']?></td>
			</tr>
		</table>
		<br>
		<p>Telah melakukan pelanggaran yang patut mendapatkan Surat Peringatan 2 (dua). Pihak orang tua diminta lebih memperhatikan perkembangan Peserta Didik tersebut demi terciptanya suasana belajar yang kondusif.</p>
		<br>
		<br>
		<p>Surat Peringatan ini disampaikan untuk dijadikan perhatian.</p>
		<br>
		
 	</div>
 	<br>	
 	<div style="margin-top: 100px;"	 class="font">
 		<div class="col-md-3 offset-md-9" style="text-align: center;">
			<p>Bogor, <?= date('d-m-Y') ?></p>
			<p><b>Kepala SMK Wikrama</b></p>
			<p style="margin-top: 100px;"><b>Iin Mulyani,S.Si</b></p>
		</div>
 		<p >	<b>	Tembusan:</b></p>
 		<p style="margin-top: -20px;">1. Pembimbing Siswa</p>
 		<p style="margin-top: -20px;">2. Arsip	</p>
 	</div>
 	
 	</div>
 		
 </body>
 </html>
