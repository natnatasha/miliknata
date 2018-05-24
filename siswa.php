  <?php 
  $perintah = new CRUD();
  $data = $perintah->select('tb_siswa');
  $table = "tb_siswa";
  $redirect = "?page=siswa";
  $where = "nis";
  $whereValues = @$_GET[id];

  $nis   = $perintah->validateHtml(@$_POST['nis']);
  $nama   = $perintah->validateHtml(@$_POST['nama']);
  $jk   = $perintah->validateHtml(@$_POST['jk']);
  $rayon   = $perintah->validateHtml(@$_POST['rayon']);
  $rombel   = $perintah->validateHtml(@$_POST['rombel']);
  $tgl_lahir   = $perintah->validateHtml(@$_POST['tgl_lahir']);
  $alamat = $perintah-> validateHtml(@$_POST['alamat']);

  if (isset($_POST['simpan'])) {
    $values   = "'$nis','$nama', '$jk', '$rayon', '$rombel', '$tgl_lahir', '$alamat'";
    $response = $perintah->insert($table,$values,"?page=siswa");
  }

  if (isset($_GET['edit'])) {
    $edit = $perintah->selectWhere($table, $where, $whereValues);
  }

  
  if (isset($_GET['hapus'])) {
    $response = $perintah->delete($table, $where, $whereValues, $redirect);
  }

  if (isset($_POST['ubah'])) {
      $values = "nis='$nis',nama='$nama', jk='$jk', rayon='$rayon', rombel='$rombel', tgl_lahir='$tgl_lahir', alamat='$alamat'"; 
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
      <h3 class="tile-title">Form Input Siswa</h3>
      <form method="post">
      <div class="tile-body">
                 <div class="form-group">
                  <label class="control-label">NIS</label>
                  <input pattern="[0-9 A-Z]+" class="form-control" type="number" autocomplete="off" name="nis" required placeholder="Masukkan NIS" value="<?= @$edit['nis'] ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Lengkap</label>
                  <input class="form-control" type="text" name="nama" required placeholder="Masukkan Nama" value="<?= @$edit['nama'] ?>">
                </div>
                <label>Jenis Kelamin</label>
                <div class="form-group">
                  <label class="radio-inline">
                  <input type="radio" name="jk" value="L" required
                    <?php if (isset($_GET['edit'])) {
                      if (@$edit['jk'] == "L") {
                        echo "checked='on'";
                      }
                    } ?>
                  >Laki-laki
                  </label>
                  <label class="radio-inline">
                  <input type="radio" name="jk" value="P" required
                    <?php if (isset($_GET['edit'])) {
                      if (@$edit['jk'] == "P") {
                        echo "checked='on'";
                      }
                    } ?>
                  >Perempuan
                  </label>
                </div>  
                <div class="form-group">
                    <label for="exampleSelect1">Rayon</label>
                    <select class="form-control" name="rayon" id="exampleSelect1" required >
                      <?php  
                        $rayon = $perintah->select("tb_rayon");
                        foreach ($rayon as $ry) { ?>
                          <option value="<?= $ry['rayon'] ?>"
                              <?php 
                                if (@$edit['rayon'] == $ry['rayon']) {
                                  echo "selected";
                                }
                              ?>
                            >
                          <?php echo $ry['rayon']; ?>
                          </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Rombel</label>
                    <select class="form-control" name="rombel" id="exampleSelect1" required >
                      <?php  
                        $rombel = $perintah->select("tb_rombel");
                        foreach ($rombel as $rb) { ?>
                          <option value="<?= $rb['rombel'] ?>"
                              <?php 
                                if (@$edit['rombel'] == $rb['rombel']) {
                                  echo "selected";
                                }
                              ?>
                          >
                          <?php echo $rb['rombel']; ?>
                          </option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Tanggal Lahir</label>
                  <input class="form-control" name="tgl_lahir" id="tglhr" required type="text" value="<?= @$edit['tgl_lahir'] ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Alamat</label>
                  <textarea class="form-control" name="alamat" required type="text"><?= @$edit['alamat'] ?></textarea>
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
  <?php 
     $siswa = $perintah->selectCount("tb_siswa","nis");
   ?>
  <div class="col-md-4">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Jumlah Siswa</h4>
        <p><b><?php echo $siswa['count']; ?></b></p>
      </div>
    </div>
  </div>
</div>

<div class="row">     
  <div class="col-md-12">  
      <div class="tile">
      <h3 class="tile-title">Data Siswa</h3>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>JK</th>
              <th>Rayon</th>
              <th>Rombel</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($data as $siswa) { ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $siswa['nis'] ?></td>
                  <td><?php echo $siswa['nama'] ?></td>
                  <td><?php echo $siswa['jk'] ?></td>
                  <td><?php echo $siswa['rayon'] ?></td>
                  <td><?php echo $siswa['rombel'] ?></td>
                  <td><?php echo $siswa['tgl_lahir'] ?></td>
                  <td><?php echo $siswa['alamat'] ?></td>
                  <td><a class="btn btn-info" href="?page=siswa&edit&id=<?php echo $siswa['nis'] ?>">Edit</a></td>
                  <td><a href="#" class="btn btn-danger" id="btdelete<?php echo $no; ?>">Hapus</a></td>
              </tr>
              <script>
                $('#btdelete<?php echo $no; ?>').click(function(e){
                  e.preventDefault();
                  swal({
                  title: "Hapus Data",
                  text: "Yakin ingin menghapus siswa <?= $siswa['nis'] ?>?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Ya",
                  cancelButtonText: "Tidak",
                  closeOnConfirm: false,
                  closeOnCancel: true
                  }, function(isConfirm) {
                    if (isConfirm) {
                      window.location.href="?page=siswa&hapus&id=<?php echo $siswa['nis'] ?>";
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