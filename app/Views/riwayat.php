<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Peminjaman</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background: #2b7a2f;
            color: white;
        }
        a.btn {
            padding: 6px 15px;
            background: #2b7a2f;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
        a.btn:hover {
            background: #256b29;
        }
    </style>
</head>
<body>

<a href="/dashboard" class="btn" style="background:#555;margin-bottom:15px;display:inline-block;">← Back</a>

<h2>Riwayat Peminjaman</h2>

<table>
    <tr>
        <th>Fakultas</th>
        <th>Fasilitas</th>
        <th>Ruangan</th>
        <th>Tanggal Pinjam</th>
        <th>Mulai</th>
        <th>Selesai</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($riwayat)) : ?>
        <?php foreach ($riwayat as $row) : ?>
            <tr>
                <td><?= $row['nama_fakultas']; ?></td>
                <td><?= $row['nama_fasilitas']; ?></td>
                <td><?= $row['nama_ruangan'] ?: '-'; ?></td>
                <td><?= $row['tanggal_peminjaman']; ?></td>
                <td><?= $row['waktu_mulai']; ?></td>
                <td><?= $row['waktu_selesai']; ?></td>
                <td>
                    <a class="btn" href="/download/surat/<?= $row['id_peminjaman']; ?>">Download</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7" style="text-align:center;">Tidak ada riwayat peminjaman.</td>
        </tr>
    <?php endif; ?>

</table>

</body>
</html>
