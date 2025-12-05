<?php
// ===== KONEKSI DATABASE =====
$koneksi = mysqli_connect("localhost", "root", "", "Peminjaman");
if (!$koneksi) { die("Koneksi gagal: " . mysqli_connect_error()); }

// ===== PROSES INPUT =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ruangan    = $_POST['ruangan'];
    $fakultas   = $_POST['fakultas'];
    $keterangan = $_POST['keterangan'];

    $tanggal    = $_POST['tanggal'];
    $mulai      = $_POST['mulai'];
    $selesai    = $_POST['selesai'];

    for ($i = 0; $i < count($tanggal); $i++) {

        $tgl = $tanggal[$i];
        $wm  = $mulai[$i];
        $ws  = $selesai[$i];

        $query = "INSERT INTO peminjaman 
            (NIM, id_fakultas, id_fasilitas, id_ruangan, tanggal_peminjaman, waktu_mulai, waktu_selesai, keterangan)
            VALUES ('2410514010', '$fakultas', 2, '$ruangan', '$tgl', '$wm', '$ws', '$keterangan')
        ";

        mysqli_query($koneksi, $query);
    }

    echo "<script>alert('Peminjaman berhasil disimpan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Peminjaman Ruangan</title>

<style>
    body { 
        font-family: 'Segoe UI', Arial; 
        max-width: 700px; 
        margin: auto; 
        padding: 20px; 
        background: #e8f5e9; /* hijau muda */
    }
    h2 {
        text-align: center;
        background: #2e7d32; /* hijau tua */
        color: white;
        padding: 12px;
        border-radius: 10px;
    }
    .card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-top: 20px;
        border-left: 5px solid #43a047; /* aksen hijau */
    }
    .hari-box {
        border: 1px solid #b8e0b9;
        padding: 15px;
        margin-bottom: 12px;
        border-radius: 10px;
        background: #f1f8f2; /* hijau super soft */
    }
    label { 
        font-weight: bold; 
        display: block; 
        margin-top: 10px; 
        color: #1b5e20; /* hijau teks */
    }
    input, select, textarea {
        padding: 10px;
        width: 100%;
        margin-top: 4px;
        border-radius: 6px;
        border: 1px solid #a5d6a7; /* border hijau */
    }
    button {
        margin-top: 15px;
        padding: 12px 15px;
        border: none;
        font-weight: bold;
        background: #2e7d32; /* hijau utama */
        color: white;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
    }
    button:hover {
        background: #1b5e20;
    }
    .btn-tambah {
        background: #43a047; /* hijau terang */
        width: auto;
    }
    .btn-tambah:hover {
        background: #2e7d32;
    }
</style>

</head>
<body>

<h2>Form Peminjaman Ruangan</h2>

<div class="card">
<form method="POST">

    <!-- FAKULTAS -->
    <label>Pilih Fakultas</label>
    <select name="fakultas" required>
        <option value="">-- Pilih Fakultas --</option>
        <?php
        $fk = mysqli_query($koneksi, "SELECT * FROM fakultas");
        while ($f = mysqli_fetch_assoc($fk)) {
            echo "<option value='".$f['id_fakultas']."'>".$f['nama_fakultas']."</option>";
        }
        ?>
    </select>

    <!-- RUANGAN (DIUPDATE SESUAI SCREENSHOT) -->
    <label>Pilih Ruangan</label>
    <select name="ruangan" required>
        <option value="1">Ruang Lab 201</option>
        <option value="2">Ruang Lab 301</option>
        <option value="3">Ruang Lab 401</option>
        <option value="4">Ruang Kelas 201</option>
        <option value="5">Ruang Kelas 202</option>
        <option value="6">Ruang Kelas 301</option>
        <option value="7">Ruang Kelas 302</option>
        <option value="8">Ruang Kelas 303</option>
        <option value="9">Ruang Kelas 403</option>
    </select>

    <!-- KETERANGAN -->
    <label>Keterangan Peminjaman</label>
    <textarea name="keterangan" placeholder="Contoh: Untuk rapat, praktikum, ujian, dsb..." required></textarea>

    <hr style="margin: 20px 0;">

    <h3 style="color:#1b5e20;">Jadwal Peminjaman</h3>

    <div id="hari-container">

        <div class="hari-box">
            <label>Tanggal</label>
            <input type="date" name="tanggal[]" required>

            <label>Waktu Mulai</label>
            <input type="time" name="mulai[]" required>

            <label>Waktu Selesai</label>
            <input type="time" name="selesai[]" required>
        </div>

    </div>

    <button type="button" class="btn-tambah" onclick="tambahHari()">+ Tambah Hari</button>

    <button type="submit">Simpan Peminjaman</button>
</form>
</div>


<script>
function tambahHari() {
    let container = document.getElementById("hari-container");

    let box = document.createElement("div");
    box.className = "hari-box";

    box.innerHTML = `
        <label>Tanggal</label>
        <input type="date" name="tanggal[]" required>

        <label>Waktu Mulai</label>
        <input type="time" name="mulai[]" required>

        <label>Waktu Selesai</label>
        <input type="time" name="selesai[]" required>
    `;

    container.appendChild(box);
}
</script>

</body>
</html>


