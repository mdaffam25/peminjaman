<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Peminjaman</title>
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/table.css">
</head>

<body>

<h2 class="header-title">Universitas Pembangunan Nasional "Veteran" Jakarta</h2>
<h3 class="sub-title">SISTEM PEMINJAMAN FASILITAS</h3>
<br><br>
<h3 class="sub-title">DAFTAR USER</h3>
<br><br>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<div class="btn-action-wrapper">
    <a href="/user/tambah" class="btn btn-tambah">Tambah User</a>
    <a href="/login" class="btn btn-logout">Log Out</a>
</div>

<br>
<div class="overlay"></div>
<table>
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>No Telepon</th>
        <th>Password</th>
        <th>Aksi</th>
        <th>Download</th>
    </tr>

    <?php foreach ($user as $u): ?>
    <tr>
        <td><?= $u['NIM'] ?></td>
        <td><?= $u['nama'] ?></td>
        <td><?= $u['no_telp'] ?></td>
        <td><?= $u['password'] ?></td>

        <td>
            <a href="/user/edit/<?= $u['NIM'] ?>" class="btn edit">Edit</a>
            <a href="/user/delete/<?= $u['NIM'] ?>" class="btn hapus">Hapus</a>
        </td>

        <td>
    <?php if (!empty($u['surat'])): ?>
        <a href="##############<?= $u['NIM'] ?>" class="btn download">Surat izin</a>
    <?php else: ?>
        <a class="btn download disabled">Surat izin</a>
    <?php endif; ?>
        </td>
    </tr>

    <?php endforeach; ?>

</table>
    <div class="footer">
    Universitas Pembangunan Nasional "Veteran" Jakarta — Kampus Bela Negara
</div>

<div id="confirmModal" class="modal">
  <div class="modal-content">
    <p>Apakah Anda yakin ingin menghapus data ini?</p>

    <div class="modal-buttons">
      <button id="btnYes">Hapus</button>
      <button id="btnNo">Batal</button>
    </div>
 </div>
</div>

<script>
let url = "";

document.querySelectorAll(".btn.hapus").forEach(btn => {
    btn.onclick = function(e) {
        e.preventDefault();
        url = this.href;
        confirmModal.style.display = "block";
    };
});

btnYes.onclick = () => window.location.href = url;
btnNo.onclick  = () => confirmModal.style.display = "none";
</script>

</body>
</html>
