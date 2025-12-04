<html>
<head>
<meta charset="UTF-8">
<title>Surat Peminjaman Fasilitas</title>

<style>
    body {
        font-family: "Times New Roman", serif;
        margin: 40px 60px;
        font-size: 17px;
    }
    .kop {
        text-align: center;
        border-bottom: 3px solid black;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }
    .kop h2 {
        margin: 0;
        font-size: 22px;
        font-weight: bold;
    }
    .judul {
        text-align: center;
        margin-top: 15px;
        text-decoration: underline;
        font-size: 20px;
        font-weight: bold;
    }
    table {
        width: 100%;
        margin-top: 18px;
    }
    td {
        padding: 4px 0;
        vertical-align: top;
    }
    .content {
        margin-top: 20px;
        line-height: 1.6;
    }
    .footer {
        margin-top: 60px;
        font-size: 17px;
    }
    .btn-download {
        margin-top: 30px;
        display: inline-block;
        padding: 10px 18px;
        background: #2b7cff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
    }
</style>
</head>
<body>

<div class="kop">
    <h2>UNIVERSITAS PEMBANGUNAN NASIONAL “VETERAN” JAKARTA</h2>
</div>

<div class="judul">SURAT PEMINJAMAN FASILITAS</div>

<div class="content">
    Yang bertanda tangan di bawah ini:

    <table>
        <tr><td style="width:180px;">Nama</td><td>: <?= $nama ?></td></tr>
        <tr><td>NIM</td><td>: <?= $nim ?></td></tr>
        <tr><td>Fakultas</td><td>: <?= $fakultas ?></td></tr>
        <tr><td>Fasilitas</td><td>: <?= $fasilitas ?></td></tr>
        <tr><td>Ruangan</td><td>: <?= $ruangan ?></td></tr>
        <tr><td>Tanggal Peminjaman</td><td>: <?= $tanggal ?></td></tr>
        <tr><td>Waktu Mulai</td><td>: <?= $mulai ?></td></tr>
        <tr><td>Waktu Selesai</td><td>: <?= $selesai ?></td></tr>
    </table>

    <p style="margin-top:20px;">
        Dengan ini mengajukan permohonan peminjaman fasilitas sesuai data di atas.  
        Demikian surat ini dibuat untuk dapat digunakan sebagaimana mestinya.
    </p>
</div>

<div class="footer">
    Jakarta, <?= date('d F Y') ?>
    <br><br>
    <strong><?= $nama ?></strong><br>
    NIM <?= $nim ?>
</div>

<a href="/riwayat/download/<?= $id_peminjaman ?>" class="btn-download">Download Surat</a>

</body>
</html>
