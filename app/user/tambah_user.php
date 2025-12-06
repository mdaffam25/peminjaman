<link rel="stylesheet" href="/css/form.css">

    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert error">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

<h2>Tambah Pengguna</h2>
<div class="form-container">

    <form method="post" action="/user/simpan"> 

        <label>NIM</label>
        <input type="text" name="NIM" id="NIM" placeholder="Masukkan NIM">

        <label>Nama</label>
        <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap">

        <label>Nomer Telepon</label>
        <input type="text" name="no_telp" id="no_telp" placeholder="Masukkan nomor telepon">

        <label>Password</label>
        <input type="text" name="password" id="password" placeholder="Masukkan password">

        <button type="submit">Simpan</button>

        <a href="/dashboard_petugas" class="btn-outline">Kembali</a>
    </form>
</div>

