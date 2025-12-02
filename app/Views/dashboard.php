<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Peminjaman</title>
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- load css custom -->
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body class="bg-light">

<!-- Header -->
<nav class="navbar navbar-dark custom-nav px-4">
    <span class="navbar-brand fw-bold">
        Selamat Datang, <?= session()->get('nama') ?>
    </span>
    <a href="/logout" class="btn btn-danger px-4">Logout</a>
</nav>

<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Dashboard Sistem Peminjaman</h2>

    <div class="row g-4">

        <!-- User CRUD -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>User</h5>
                    <a href="/pengguna" class="btn btn-primary w-100">Kelola User</a>
                </div>
            </div>
        </div>

        <!-- Fakultas -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Fakultas</h5>
                    <a href="/fakultas" class="btn btn-primary w-100">Kelola Fakultas</a>
                </div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Fasilitas</h5>
                    <a href="/fasilitas" class="btn btn-primary w-100">Kelola Fasilitas</a>
                </div>
            </div>
        </div>

        <!-- Ruangan -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Ruangan</h5>
                    <a href="/ruangan" class="btn btn-primary w-100">Kelola Ruangan</a>
                </div>
            </div>
        </div>

        <!-- Peminjaman -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Peminjaman</h5>
                    <a href="/peminjaman" class="btn btn-primary w-100">Kelola Peminjaman</a>
                </div>
            </div>
        </div>

        <!-- Riwayat -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Riwayat Peminjaman</h5>
                    <a href="/peminjaman/riwayat" class="btn btn-primary w-100">Riwayat Peminjaman</a>
                </div>
            </div>
        </div>

        <!-- Cek -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Cek Ketersediaan Fasilitas & Ruangan</h5>
                    <a href="/cek-ketersediaan" class="btn btn-primary w-100">Cek Ketersediaan</a>
                </div>
            </div>
        </div>

        <!-- Log -->
        <div class="col-md-4">
            <div class="card custom-card shadow">
                <div class="card-body text-center">
                    <h5>Log & Arsip</h5>
                    <a href="/log" class="btn btn-primary w-100">Lihat Log & Arsip</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
