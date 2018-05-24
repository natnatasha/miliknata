<?php 
    $perintah = new CRUD();
    $siswa = $perintah->selectCount("tb_siswa","nis");
    $rayon  = $perintah->selectCount("tb_rayon","id_rayon");
    $rombel = $perintah->selectCount("tb_rombel","id_rombel");
    $admin = $perintah->selectCount("tb_user","id");
 ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i>&nbsp; Dashboard</h1>
          <p>Halaman Dashboard</p>
        </div>
</div>
<div class="row">
  <div class="col-md-8">
    <form method="post">
    <div class="tile">
      <div class="row">
        <div class="col-sm-7">
          <h4>Daftar Siswa Tidak Hadir Tanggal</h4>
        </div>
        <div class="col-sm-3">
          <input class="form-control" id="demoDate" name="tgl" type="text" placeholder="Masukkan Tanggal" value="<?= @$_GET['tgl']; ?>">
          <div>
            
          </div>
        </div>
        <div class="col-sm-2" style="text-align: center;">
          <button type="submit" class="btn btn-primary btn-block" name="tampil">Tampil</button>
        </div>
      </div>
      <br><br>
      <?php  
        if (isset($_POST['tampil'])) {
          echo "<script>window.location.href='pagekesiswaan.php?tgl=$_POST[tgl]'</script>";
        }
      ?>
      <div class="tile-body">
        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th rowspan="2">No.</th>
              <th rowspan="2">NIS</th>
              <th rowspan="2">Nama </th>
              <th rowspan="2">Rayon </th>
              <th rowspan="2">Rombel </th>
              <th colspan="4">Status</th>
            </tr>
            <tr>  
              <th>H</th>
              <th>S</th>
              <th>I</th>
              <th>A</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $tgl = $_GET['tgl'];
              $data = mysqli_query($con,"SELECT * FROM query_absen WHERE tgl_absen = '$tgl' AND hadir = '0'");
              $no = 1;
              
              while($absen = mysqli_fetch_assoc($data)){
                if($absen['hadir'] == 1) {
                  $hadir = "checked";
                  $sakit = "";
                  $izin = "";
                  $alpa = "";
                }
                if($absen['sakit'] == 1) {
                  $hadir = "";
                  $sakit = "checked";
                  $izin = "";
                  $alpa = "";
                }
                if($absen['izin'] == 1) {
                  $hadir = "";
                  $sakit = "";
                  $izin = "checked";
                  $alpa = "";
                }
                if($absen['alpa'] == 1) {
                  $hadir = "";
                  $sakit = "";
                  $izin = "";
                  $alpa = "checked";
                }
             ?>
             <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo @$absen['nis']; ?></td>
                <td><?php echo @$absen['nama']; ?></td>
                <td><?php echo @$absen['rayon']; ?></td>
                <td><?php echo @$absen['rombel']; ?></td>
                <td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="hadir" <?php echo $hadir ?>></td>
                <td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="sakit" <?php echo $sakit ?>></td>
                <td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="izin" <?php echo $izin ?>></td>
                <td><input type="radio" name="keterangan<?php echo $absen['nis'] ?>" value="alpa" <?php echo $alpa ?>></td>
            </tr>
          </tbody>
          <script>
            $("[name=keterangan<?= $absen['nis']; ?>]").change(function(){
              $.post("ajax_keterangan.php",{nis: '<?= $absen['nis'] ?>', tgl: '<?= $tgl ?>', ket: $(this).val()}, function (data) {
                obj = JSON.parse(data);
                if (obj.response == "positive") {
                  swal("Berhasil diubah!","","success");
                }
              })
            });
          </script>
          <?php $no++; } ?>
        </table>
      </div>
    </div>
</form>
</div>
<div class="col-md-4">
  <div class="tile">
    <h3 class="tile-title">Keterangan Periode</h3>
    <div class="tile-body">
      <div class="alert alert-danger">Semester 1 : 01/04/2018 - 30/04/2018</div>
      <div class="alert alert-info">Semester 2 : 01/04/2018 - 30/04/2018</div>
      <div class="alert alert-warning">Semester 3 : 01/04/2018 - 30/04/2018</div>
      <div class="alert alert-success">Semester 4 : 01/04/2018 - 30/04/2018</div>
      <div class="alert alert-secondary">Semester 5 : 01/04/2018 - 30/04/2018</div>
      <div class="alert alert-primary">Semester 6 : 01/04/2018 - 30/04/2018</div>
    </div>
  </div>
</div>
</div>