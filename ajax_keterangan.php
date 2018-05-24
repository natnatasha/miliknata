<?php
	require_once 'controller.php';
	$perintah = new CRUD();
	if (isset($_POST['ket'])) {
		$nis = $_POST['nis'];
		$tgl = $_POST['tgl'];
		$ket = $_POST['ket'];
		if ($ket == 'hadir') {
			$values = "nis='$nis', hadir='1', sakit='0', izin='0', alpa='0'"; 
		}else if ($ket == 'sakit') {
			$values = "nis='$nis', hadir='0', sakit='1', izin='0', alpa='0'"; 
		}else if ($ket == 'izin') {
			$values = "nis='$nis', hadir='0', sakit='0', izin='1', alpa='0'"; 
		}else if ($ket == 'alpa'){
			$values = "nis='$nis', hadir='0', sakit='0', izin='0', alpa='1'"; 
		}
		$response = $perintah->updateDouble("tb_absen","$values", "nis","$nis", "tgl_absen","$tgl","#");
		echo json_encode($response);
	}
?>