<!DOCTYPE html>
<html>
<head>
    <title>Hasil Cek</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

<h2 class="mb-4 text-center">Hasil Cek Ketersediaan</h2>

<p><b>Fakultas:</b> 
    <?php
      $fakName = '';
      foreach($fakultas ?? [] as $f){
          if(isset($input['fakultas']) && $input['fakultas'] == $f->id_fakultas) { 
              $fakName = $f->nama_fakultas; 
              break; 
          }
      }
      echo $fakName ?: ($input['fakultas'] ?? '-');
    ?>
</p>

<p><b>Fasilitas:</b>
    <?php
      $fasName = '';
      foreach($fasilitas ?? [] as $fs){
          if(isset($input['fasilitas']) && $input['fasilitas'] == $fs->id_fasilitas) { 
              $fasName = $fs->nama_fasilitas; 
              break; 
          }
      }
      echo $fasName ?: ($input['fasilitas'] ?? '-');
    ?>
</p>

<?php if (!empty($input['ruangan'])): ?>
    <p><b>Ruangan:</b>
        <?php
            $rName = '';
            foreach($ruangan ?? [] as $r){
                if($input['ruangan'] == $r->id_ruangan){ 
                    $rName = $r->nama_ruangan; 
                    break; 
                }
            }
            echo $rName ?: $input['ruangan'];
        ?>
    </p>
<?php endif; ?>

<p><b>Tanggal:</b> <?= $input['tanggal_peminjaman'] ?></p>
<p><b>Jam:</b> <?= $input['waktu_mulai'] ?> - <?= $input['waktu_selesai'] ?></p>

<hr>

<h3>Status:</h3>

<?php if (!empty($hasil) && count($hasil) > 0): ?>

    <p class="text-danger fw-bold">TIDAK TERSEDIA ➜ Ada bentrok jadwal</p>

    <h4 class="mt-3">Detail yang bentrok:</h4>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fasilitas</th>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Mulai</th>
                <th>Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($hasil as $h): ?>
                <tr>
                    <td><?= $h->id_peminjaman ?></td>
                    <td><?= isset($h->nama_fasilitas) ? $h->nama_fasilitas : $h->id_fasilitas ?></td>
                    <td><?= isset($h->nama_ruangan) && $h->nama_ruangan ? $h->nama_ruangan : '-' ?></td>
                    <td><?= $h->tanggal_peminjaman ?></td>
                    <td><?= $h->waktu_mulai ?></td>
                    <td><?= $h->waktu_selesai ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>

    <p class="text-success fw-bold">TERSEDIA</p>

<?php endif; ?>

<br>

<a href="<?= base_url('/cek?fasilitas='.$input['fasilitas'].'&fakultas='.$input['fakultas']) ?>" class="btn btn-secondary">
    Kembali
</a>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
