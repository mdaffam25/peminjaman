<link rel="stylesheet" href="/css/form.css">

    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert error">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

<h2>Edit User</h2>
<div class="form-container">

<form method="post" action="/user/update/<?=$user['NIM'] ?>">

   <label>NIM</label>
      <input type="text" name="NIM" value="<?=$user['NIM'] ?>" placeholder="Masukkan NIM">

   <label>Nama</label>
      <input type="text" name="nama" value="<?=$user['nama'] ?>" placeholder="Masukkan nama lengkap">

   <label>Nomer Telepon</label>
      <input type="text" name="no_telp" value="<?=$user['no_telp'] ?>" placeholder="Masukkan nomor telepon">

    <label>Password</label>
      <input type="text" name="password" value="<?=$user['password'] ?>" placeholder="Masukkan password">

   <button type="submit">Update</button>

   <a href="/dashboard_petugas" class="btn-outline">Kembali</a>
</form>
</div>

