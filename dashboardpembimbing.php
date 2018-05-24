<div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i>&nbsp; Dashboard</h1>
          <p>Halaman Dashboard</p>
        </div>
</div>
<div class="row">
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Daftar Siswa Rayon <?= $_SESSION['rayon'] ?> yang Tidak Hadir Tanggal <?= date('d/m/Y'); ?></h3>
              <div class="tile-body">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th rowspan="2">No</th>
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
                      $tgl = date('d/m/Y');
                      $rayon = $_SESSION['rayon'];
                      $data = mysqli_query($con,"SELECT * FROM query_absen WHERE tgl_absen = '$tgl' AND hadir = '0' AND rayon = '$rayon' ");
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
                  <?php $no++; } ?>
                </table>
              </div>
          </div>
          </div>
       </div>