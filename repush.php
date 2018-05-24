<?php
  $perintah = new CRUD();
  $table = "tb_repush";
  $where = "kode_kinerja";
  $whereValues = @$_GET[id];
  $redirect = "?page=repush";

  $kode_kinerja   = $perintah->validateHtml(@$_POST['kode']);
  $nama_kinerja   = $perintah->validateHtml(@$_POST['nama']);
  $kelompok   = $perintah->validateHtml(@$_POST['kelompok']);
  $skor1   = $perintah->validateHtml(@$_POST['skor1']);
  $skor2   = $perintah->validateHtml(@$_POST['skor2']);
  $skor3   = $perintah->validateHtml(@$_POST['skor3']);

  if(isset($_POST['simpan'])){
    if(empty($_POST['kode']) || empty($_POST['nama']) || empty($_POST['kelompok']) || empty($_POST['skor1']) || empty($_POST['skor2']) || empty($_POST['skor3'])){
        $response = ['response'=>'negative','alert'=>'Lengkapi Field!'];
      }else{
        $values   = "'$kode_kinerja','$nama_kinerja', '$kelompok', '$skor1', '$skor2', '$skor3'";
        $response = $perintah->insert($table,$values,$redirect);
      }
  }

  if (isset($_GET['edit'])) {
    $edit = $perintah->selectWhere($table, $where, $whereValues);
  }

  if (isset($_GET['hapus'])) {
    $response = $perintah->delete($table, $where, $whereValues, $redirect);
  }

  if (isset($_POST['ubah'])) {
    $values   = "kode_kinerja = '$kode_kinerja', nama_kinerja = '$nama_kinerja', kelompok='$kelompok', skor1='$skor1', skor2='$skor2', skor3='$skor3'";
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
  <div class="col-md-6">
    <div class="tile">
      <h3 class="tile-title">Form Input Reward & Punishment</h3>
      <form method="post">
          <div class="tile-body">
                    <div class="form-group">
                      <label class="control-label">Kode Kinerja</label>
                      <input class="form-control" name="kode" autocomplete="off" type="text" placeholder="Masukkan Kode Kinerja" value="<?= @$edit['kode_kinerja'] ?>">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Nama Kinerja</label>
                      <textarea class="form-control" name="nama" autocomplete="off" placeholder="Masukkan Nama Kinerja" ><?= @$edit['nama_kinerja'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelect1">Kelompok</label>
                        <select class="form-control" name="kelompok" id="exampleSelect1">
                          <option value="H"
                            <?php 
                                if (@$edit['kelompok'] == "H") {
                                  echo "selected";
                                }
                              ?>
                          >H</option>
                          <option value="P"
                            <?php 
                                if (@$edit['kelompok'] == "P") {
                                  echo "selected";
                                }
                              ?>
                          >P</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Skor I</label>
                      <input class="form-control" name="skor1" type="text" autocomplete="off" placeholder="Masukkan Skor I" value="<?= @$edit['skor1'] ?>">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Skor II</label>
                      <input class="form-control" name="skor2" type="text" autocomplete="off" placeholder="Masukkan Skor II" value="<?= @$edit['skor2'] ?>">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Skor III</label>
                      <input class="form-control" name="skor3" type="text" autocomplete="off" placeholder="Masukkan Skor III" value="<?= @$edit['skor3'] ?>">
                    </div>
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
<div class="row">
  <div class="col-md-10">
    <div class="tile">
      <h3 class="tile-title">Data Reward</h3>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Kinerja</th>
                    <th>Nama Kinerja</th>
                    <th>Skor I</th>
                    <th>Skor II</th>
                    <th>Skor III</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $where = "kelompok";
                    $whereValues = "H";
                     $data = $perintah->edit($table, $where, $whereValues);
                      foreach ($data as $repush) { ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $repush['kode_kinerja'] ?></td>
                      <td><?php echo $repush['nama_kinerja'] ?></td>
                      <td><?php echo $repush['skor1'] ?></td>
                      <td><?php echo $repush['skor2'] ?></td>
                      <td><?php echo $repush['skor3'] ?></td>
                      <td><a class="btn btn-info" href="?page=repush&edit&id=<?php echo $repush['kode_kinerja'] ?>">Edit</a></td>
                      <td><a href="#" class="btn btn-danger" id="btdelete<?php echo $no; ?>">Hapus</a></td>
                  </tr>
                  <script>
                      $('#btdelete<?php echo $no; ?>').click(function(e){
                        e.preventDefault();
                        swal({
                        title: "Hapus Data",
                        text: "Yakin ingin menghapus kode kinerja <?= $repush['kode_kinerja'] ?>?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: false,
                        closeOnCancel: true
                        }, function(isConfirm) {
                          if (isConfirm) {
                            window.location.href="?page=repush&hapus&id=<?php echo $repush['kode_kinerja'] ?>";
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

<div class="row">
  <div class="col-md-10">
    <div class="tile">
      <h3 class="tile-title">Data Punishment</h3>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Kinerja</th>
                    <th>Nama Kinerja</th>
                    <th>Skor I</th>
                    <th>Skor II</th>
                    <th>Skor III</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    $where = "kelompok";
                    $whereValues = "P";
                     $data = $perintah->edit($table, $where, $whereValues);
                      foreach ($data as $repush) { ?>
                  <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $repush['kode_kinerja'] ?></td>
                      <td><?php echo $repush['nama_kinerja'] ?></td>
                      <td><?php echo $repush['skor1'] ?></td>
                      <td><?php echo $repush['skor2'] ?></td>
                      <td><?php echo $repush['skor3'] ?></td>
                      <td><a class="btn btn-info" href="?page=repush&edit&id=<?php echo $repush['kode_kinerja'] ?>">Edit</a></td>
                      <td><a href="#" class="btn btn-danger" id="btdelete<?php echo $no; ?>">Hapus</a></td>
                  </tr>
                  <script>
                      $('#btdelete<?php echo $no; ?>').click(function(e){
                        e.preventDefault();
                        swal({
                        title: "Hapus Data",
                        text: "Yakin ingin menghapus kode kinerja <?= $repush['kode_kinerja'] ?>?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya",
                        cancelButtonText: "Tidak",
                        closeOnConfirm: false,
                        closeOnCancel: true
                        }, function(isConfirm) {
                          if (isConfirm) {
                            window.location.href="?page=repush&hapus&id=<?php echo $repush['kode_kinerja'] ?>";
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



