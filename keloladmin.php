<?php 
	$perintah = new CRUD();
	$autokode = $perintah->autokode("tb_user","id","AD");
	$admin  = $perintah->select("tb_user");
 	
 	if (isset($_POST['tambah'])) {
		$id  = $_POST['id'];
		$name     = $_POST['nama_user'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm  = $_POST['confirm'];
		$level    = $_POST['level'];
		$rayon    = $_POST['rayon'];
		$redirect = "?page=admin";
		$response = $perintah->register($id,$name,$username,$password,$confirm,$level,$rayon,$redirect);
 	}

 	if (isset($_GET['hapus'])) {
 		$id = $_GET['id'];
 		$response = $perintah->delete("tb_user","id",$id,"?page=admin");
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
<div class="col-sm-4">
	<div class="tile">
		<h3>Form Tambah Admin</h3>
		<hr>
		<form method="post">
			<div class="form-group">
				<label for="">ID Admin</label>
				<input type="text" class="form-control form-control-sm" name="id" value="<?php echo $autokode; ?>" readonly>
			</div>
			<div class="form-group">
				<label for="">Nama</label>
				<input type="text" class="form-control form-control-sm" name="nama_user" autocomplete="off" autofocus="on">
			</div>
			<div class="form-group">
				<label for="">Username</label>
				<input type="text" class="form-control form-control-sm" autocomplete="off" name="username">
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" class="form-control form-control-sm" name="password">
			</div>
			<div class="form-group">
				<label for="">Confirm Password</label>
				<input type="password" class="form-control form-control-sm" name="confirm">
			</div>
			<div class="form-group">
				<select name="level" class="form-control" id="changeLevel">
					<option value="Kesiswaan">Kesiswaan</option>
					<option value="Pembimbing">Pembimbing</option>
				</select>
			</div>
			<div class="form-group" id="eleRayon">
				<select name="rayon" class="form-control">
					<?php  
                        $rayon = $perintah->select("tb_rayon");
                        foreach ($rayon as $ry) { ?>
                          <option value="<?= $ry['rayon'] ?>">
                          <?php echo $ry['rayon']; ?>
                          </option>
                 	<?php } ?>
				</select>
			</div>
			<button class="btn btn-primary" name="tambah">Simpan</button>
		</form>
	</div>
</div>

<div class="col-md-6">
          <div class="tab-content">
            <div class="tab-pane active" id="user-timeline">
              <div class="tile">
              	<h4 class="line-head">Data Admin</h4>
              	<table class="table table-hover table-bordered" id="sampleTable">
				<thead>
					<tr>
						<th>ID Admin</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Level</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no =1;
					foreach($admin as $adm){ ?>
					<tr>
						<td><?php echo $adm['id'] ?></td>
						<td><?php echo $adm['nama'] ?></td>
						<td><?php echo $adm['username'] ?></td>
						<td><?php echo $adm['user_role'] ?></td>
						<td>
							<a href="#" class="btn btn-danger" id="btdelete<?php echo $no; ?>">Hapus</a>
						</td>
					</tr>
					<script>
						$(document).ready(function(){
							$("#btdelete<?php echo $no; ?>").click(function(e){
								e.preventDefault();
								swal({
									title: "Hapus Data",
						            text: "Yakin ingin menghapus admin <?= $adm['id'] ?>?",
						            type: "warning",
						            showCancelButton: true,
						            confirmButtonText: "Yes",
						            cancelButtonText: "Cancel",
						      		closeOnConfirm: false,
						      		closeOnCancel: true
								}, function(isConfirm) {
					            if (isConfirm) {
					            	window.location.href="?page=admin&hapus&id=<?php echo $adm['id'] ?>";
					            }
					          });
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

        <script>
        	$(document).ready(function(){
        		$('#eleRayon').hide();
        		$('#changeLevel').on('change',function(){
        			var level = $('#changeLevel').val();
        			if (level == "Pembimbing") {
        				$('#eleRayon').show();
        			}else{
        				$('#eleRayon').hide();
        			}
        		});
        	})
        </script>