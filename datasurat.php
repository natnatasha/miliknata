<?php 
	include 'controller.php';
	$perintah = new CRUD();
	$data = $perintah->select("tb_siswa", "nis", "$_GET[nis]");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="row">
	<div class="col-md-8">
		<div class="row">
		<div class="col-md-4">
			<div class="tile">
				<h3 class="tile-title">Form Input SP</h3>
				<form method="post">
				<div class="tile-body">
					<div class="form-group">
		                <fieldset disabled="">
	                      	<label class="control-label" for="disabledInput">NIS</label>
	                      	<input class="form-control" name="nis" type="text" disabled="" value="<?= $data[nis] ?>">
		                </fieldset>
		            </div>
		            <div class="form-group">
		                <fieldset disabled="">
	                      	<label class="control-label" for="disabledInput">Nama</label>
	                      	<input class="form-control" name="nama" type="text" disabled="" value="<?= $data[nama] ?>">
		                </fieldset>
		            </div>
		            <div class="form-group">
		                <fieldset disabled="">
	                      	<label class="control-label" for="disabledInput">JK</label>
	                      	<input class="form-control" name="jk" type="text" disabled="" value="<?= $data[jk] ?>">
		                </fieldset>
		            </div>
		            <div class="form-group">
		                <fieldset disabled="">
	                      	<label class="control-label" for="disabledInput">Rayon</label>
	                      	<input class="form-control" name="rayon" type="text" disabled="" value="<?= $data[rayon] ?>">
		                </fieldset>
		            </div>
		            <div class="form-group">
		                <fieldset disabled="">
	                      	<label class="control-label" for="disabledInput">Rombel</label>
	                      	<input class="form-control" name="nama" type="text" disabled="" value="<?= $data[rombel] ?>">
		                </fieldset>
		            </div>
				</div>
				</form>
			</div>
		</div>
		</div>
	</div>
</div>
</body>
</html>