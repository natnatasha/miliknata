<?php 
  	$perintah = new CRUD();
  	$data = $perintah->select('tb_rombel');
  	$table = "tb_rombel";
  	$autokode = $perintah->autokode("tb_rombel","id_rombel","RB");
  	
  	if (isset($_POST['simpan'])) {
  		if(empty($_POST['nama_rombel'])){
  			$response = ['response'=>'negative','alert'=>'Lengkapi Field!'];
  		}else{
  			$rombel   = $perintah->validateHtml($_POST['nama_rombel']);
  			$values	  = "'$autokode','$rombel'";
  			$response = $perintah->insert($table,$values,"?page=rombel");
  		}
  	}

  	if (isset($_GET['edit'])) {
  		$where = "id_rombel";
    	$whereValues = "$_GET[id]";
    	$edit = $perintah->selectWhere($table, $where, $whereValues);
    	$autokode = $edit['id_rombel'];
  	}

  	if (isset($_GET['hapus'])) {
  		$redirect = "?page=rombel";
  		$where = "id_rombel";
    	$whereValues = "$_GET[id]";
  		$response = $perintah->delete($table, $where, $whereValues, $redirect);
  	}

    if (isset($_POST['ubah'])) {
      $values = "id_rombel = '$autokode', rombel='$_POST[nama_rombel]'";
      $redirect = "?page=rombel";
      $where = "id_rombel";
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

<form method="post">
<div class="row">
	<div class="col-md-4">	
		<div class="tile">
			<h3 class="tile-title">Form Input Rombel</h3>
			<div class="tile-body">	
					<div class="form-group">
	                    <fieldset disabled="">
	                      <label class="control-label">ID Rombel</label>
	                      <input class="form-control" name="id_rombel" type="text" disabled="" autocomplete="off" value="<?php echo $autokode?>">
	                    </fieldset>
	                  </div>
      					<div class="form-group">
      						<label>Nama Rombel</label>
      						<input type="text" name="nama_rombel" class="form-control" autocomplete="off" placeholder="Masukkan Nama Rombel" value="<?= @$edit['rombel'] ?>">
      					</div>
					 <div class="tile-footer">
			        <?php if (@$_GET['id'] == "") { ?>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
              <?php }else{ ?>
                <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
              <?php } ?>
			     </div>
				
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="tile">
			<h3 class="tile-title">Data rombel</h3>
			<div class="tile-body">
				<table class="table table-hover table-bordered" id="sampleTable">
					<thead>
						<th>No.</th>
          	<th>ID Rombel</th>
          	<th>Nama Rombel</th>
          	<th colspan="2">Aksi</th>
					</thead>
					<tbody>
						<?php 
            				$no = 1;
            				foreach ($data as $rombel) { ?>
            			<tr>
              				<td><?php echo $no; ?></td>
              				<td><?php echo $rombel['id_rombel'] ?></td>
              				<td><?php echo $rombel['rombel'] ?></td>
                      <td><a class="btn btn-info" href="?page=rombel&edit&id=<?php echo $rombel['id_rombel'] ?>">Edit</a></td>
                      <td><a class="btn btn-danger" href="#" id="btdelete<?php echo $no; ?>">Hapus</a></td>
            			</tr>
                  <script>
                    $('#btdelete<?php echo $no; ?>').click(function(e){
                      e.preventDefault();
                        swal({
                        title: "Hapus Data",
                        text: "Yakin ingin menghapus rombel <?= $rombel['rombel'] ?>?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: false,
                        closeOnCancel: true
                        }, function(isConfirm) {
                          if (isConfirm) {
                            window.location.href="?page=rombel&hapus&id=<?php echo $rombel['id_rombel'] ?>";
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
</form>