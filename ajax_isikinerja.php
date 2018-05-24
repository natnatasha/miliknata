 <?php
 require_once 'controller.php';
 $perintah = new CRUD();
?>
<option value=""></option>
<?php  
    $kinerja = $perintah->select("tb_repush WHERE kelompok = '" . $_GET['kel'] . "'");
    foreach ($kinerja as $kr) { ?>
      <option value="<?= $kr['kode_kinerja'] ?>">
      <?php echo $kr['kode_kinerja']; ?>
      </option>
<?php } ?>