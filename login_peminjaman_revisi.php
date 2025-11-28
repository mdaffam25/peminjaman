<?php // Tetap file .php agar berjalan di XAMPP ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login & Daftar | UPNVJ</title>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Poppins", sans-serif;
        background-image: url("https://cdn-web.ruangguru.com/file-uploader/56ddec85-99cc-4a83-aed7-7c2d129dc608.jpg");
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(3px);
    }

    .card {
        width: 380px;
        background: rgba(255, 255, 255, 0.87);
        padding: 30px;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.28);
        text-align: center;
        display: none;
        animation: fade .25s ease;
    }

    #menuAwal {
        display: block;
    }

    @keyframes fade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        margin-bottom: 18px;
        font-weight: 600;
        color: #0f3d2e;
    }

    h1 {
        font-size: 24px; 
        margin-bottom: 10px; 
        color:#0f3d2e; 
        font-weight:700;
    }

    input, select {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #bdbdbd;
        margin-top: 10px;
        margin-bottom: 14px;
        font-size: 14px;
    }

    .btn {
        width: 100%;
        padding: 14px;
        background: #2ecc71;
        border: none;
        font-size: 16px;
        color: white;
        cursor: pointer;
        border-radius: 10px;
        font-weight: 600;
        margin-top: 10px;
        transition: 0.2s;
    }

    .btn:hover {
        background: #27ae60;
    }

    /* MODAL */
    .modal-bg {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        display: none;
        justify-content: center;
        align-items: center;
    }

    .modal-box {
        background: white;
        padding: 22px;
        border-radius: 12px;
        width: 300px;
        text-align: center;
        animation: fade 0.3s ease;
    }

    .modal-btn {
        margin-top: 15px;
        padding: 10px 16px;
        border: none;
        background: #3498db;
        color: white;
        border-radius: 6px;
        cursor: pointer;
    }
</style>
</head>
<body>

<!-- MODAL -->
<div class="modal-bg" id="modal">
    <div class="modal-box">
        <p id="modalText"></p>
        <button class="modal-btn" onclick="closeModal()">OK</button>
    </div>
</div>

<!-- MENU AWAL -->
<div class="card" id="menuAwal">

    <h1>Peminjaman Ruangan UPNVJ</h1>

    <h2>Selamat Datang</h2>
    <button class="btn" onclick="showDaftar()">Daftar</button>
    <button class="btn" onclick="cekLogin()">Login</button>
</div>

<!-- FORM DAFTAR -->
<div class="card" id="formDaftar">
    <h2>Form Daftar</h2>

    <input type="text" id="namaDaftar" placeholder="Nama Lengkap">
    <input type="text" id="nimDaftar" placeholder="NIM">

    <!-- FAKULTAS PAKAI DROPDOWN BIAR RAPI -->
    <select id="fakDaftar">
        <option value="">Pilih Fakultas</option>
        <option value="Ilmu Komputer">Fakultas Ilmu Komputer</option>
        <option value="Ekonomi & Bisnis">Fakultas Ekonomi dan Bisnis</option>
        <option value="Hukum">Fakultas Hukum</option>
        <option value="Kesehatan">Fakultas Kesehatan</option>
    </select>

    <select id="prodiDaftar">
        <option value="">Pilih Prodi</option>
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Informatika">Informatika</option>
        <option value="Manajemen">Manajemen</option>
        <option value="Akuntansi">Akuntansi</option>
        <option value="Sains Data">Sains Data</option>
    </select>

    <button class="btn" onclick="daftar()">Daftar</button>
</div>

<!-- FORM LOGIN -->
<div class="card" id="formLogin">
    <h2>Login</h2>
    <input type="text" id="namaLogin" placeholder="Nama Lengkap">
    <input type="text" id="nimLogin" placeholder="NIM">
    <button class="btn" onclick="login()">Login</button>
</div>

<script>
function showModal(msg) {
    document.getElementById("modalText").innerText = msg;
    document.getElementById("modal").style.display = "flex";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}

function showDaftar() {
    document.getElementById("menuAwal").style.display = "none";
    document.getElementById("formDaftar").style.display = "block";
}

function cekLogin() {
    let data = localStorage.getItem("userData");
    if (!data) {
        showModal("Harap daftar terlebih dahulu!");
        return;
    }
    document.getElementById("menuAwal").style.display = "none";
    document.getElementById("formLogin").style.display = "block";
}

function daftar() {
    let nama = document.getElementById("namaDaftar").value.trim();
    let nim = document.getElementById("nimDaftar").value.trim();
    let fak = document.getElementById("fakDaftar").value.trim();
    let prodi = document.getElementById("prodiDaftar").value.trim();

    if (!nama || !nim || !fak || !prodi) {
        showModal("Semua data harus diisi!");
        return;
    }

    let userData = { nama, nim };
    localStorage.setItem("userData", JSON.stringify(userData));

    showModal("Pendaftaran berhasil! Silakan login.");

    setTimeout(() => {
        document.getElementById("formDaftar").style.display = "none";
        document.getElementById("formLogin").style.display = "block";
    }, 700);
}

function login() {
    let data = JSON.parse(localStorage.getItem("userData"));
    let nama = document.getElementById("namaLogin").value.trim();
    let nim = document.getElementById("nimLogin").value.trim();

    if (nama === data.nama && nim === data.nim) {
        showModal("Login berhasil!");
    } else {
        showModal("Nama atau NIM salah!");
    }
}
</script>

</body>
</html>



