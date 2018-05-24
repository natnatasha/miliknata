<?php 
  	$perintah = new CRUD();
  	$data = $perintah->select('tb_rayon');
  	$table = "tb_rayon";
  	$autokode = $perintah->autokode("tb_rayon","id_rayon","RY");
  	
  	if (isset($_POST['simpan'])) {
  		if(empty($_POST['nama_rayon'])){
  			$response = ['response'=>'negative','alert'=>'Lengkapi field!'];
  		}else{
  			$rayon   = $perintah->validateHtml($_POST['nama_rayon']);
  			$values	  = "'$autokode','$rayon'";
  			$response = $perintah->insert($table,$values,"?page=rayon");
  		}
  	}

  	if (isset($_GET['edit'])) {
  		$where = "id_rayon";
    	$whereValues = "$_GET[id]";
    	$edit = $perintah->selectWhere($table, $where, $whereValues);
    	$autokode = $edit['id_rayon'];
  	}

  	if (isset($_GET['hapus'])) {
  		$redirect = "?page=rayon";
  		$where = "id_rayon";
    	$whereValues = "$_GET[id]";
  		$response = $perintah->delete($table, $where, $whereValues, $redirect);
  	}

    if (isset($_POST['ubah'])) {
      $values = "id_rayon = '$autokode', rayon = '$_POST[nama_rayon]'";
      $redirect = "?page=rayon";
      $where = "id_rayon";
      $whereValues = "$_GET[id]";
      $response = $perintah->update($table,$values,$where,$whereValues,$redirect);
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

<div class="row">
	<div class="col-md-4">	
		<div class="tile">
			<h3 class="tile-title">Form Input Rayon</h3>
			<div class="tile-body">	
				<form method="post">
					<div class="form-group">
	                    <fieldset disabled="">
	                      <label class="control-label" for="disabledInput">ID Rayon</label>
	                      <input class="form-control" name="id_rayon" type="text" disabled="" autocomplete="off" value="<?php echo $autokode ?>">
	                    </fieldset>
	                  </div>
					<div class="form-group">
						<label>Nama Rayon</label>
						<input type="text" name="nama_rayon" class="form-control" placeholder="Masukkan Nama Rayon" value="<?= @$edit['rayon'] ?>">
					</div>
					<div class="tile-footer">
					 	<?php if (@$_GET['id'] == "") { ?>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
              <?php }else{ ?>
                <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
              <?php } ?>
			    </div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="tile">
			<h3 class="tile-title">Data Rayon</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<th>No.</th>
          	<th>ID Rayon</th>
          	<th>Nama Rayon</th>
          	<th colspan="2">Aksi</th>
					</thead>
					<tbody>
						<?php 
            				$no = 1;
            				foreach ($data as $rayon) { ?>
            			<tr>
              				<td><?php echo $no; ?></td>
              				<td><?php echo $rayon['id_rayon'] ?></td>
              				<td><?php echo $rayon['rayon'] ?></td>
              				<td><a class="btn btn-info" href="?page=rayon&edit&id=<?php echo $rayon['id_rayon'] ?>">Edit</a></td>
                      <td><a class="btn btn-danger" href="#" id="btdelete<?php echo $no; ?>">Hapus</a></td>
                  </tr>
                  <script>
                    $('#btdelete<?php echo $no; ?>').click(function(e){
                      e.preventDefault();
                        swal({
                        title: "Hapus Data",
                        text: "Yakin ingin menghapus rayon <?= $rayon['rayon'] ?>?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: false,
                        closeOnCancel: true
                        }, function(isConfirm) {
                          if (isConfirm) {
                            window.location.href="?page=rayon&hapus&id=<?php echo $rayon['id_rayon'] ?>";
                          }
                        });
                      });
                  </script>
          				<?php $no++; } ?>
 					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>