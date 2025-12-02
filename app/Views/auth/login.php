<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="/css/login.css"> <!-- PISAH CSS -->
</head>

<body>

<div class="box">
    <h2>Login to Your Account</h2>

    <form action="/login/process" method="post">
        <input type="text" name="nim" placeholder="Masukkan NIM"
        value="<?= $_COOKIE['nim'] ?? '' ?>" required>

        <input type="password" name="password" placeholder="Password"
        value="<?= $_COOKIE['password'] ?? '' ?>" required>

        <label class="remember">
            <input type="checkbox" name="remember"
                <?= isset($_COOKIE['nim']) ? "checked" : "" ?>>
            Remember me
        </label>

        <button type="submit">Log in</button>
    </form>
</div>


<?php if(session()->getFlashdata('success')): ?>
<script>
Swal.fire("Berhasil", "<?= session()->getFlashdata('success') ?>", "success");
</script>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<script>
Swal.fire("Gagal", "<?= session()->getFlashdata('error') ?>", "error");
</script>
<?php endif; ?>

</body>
</html>
