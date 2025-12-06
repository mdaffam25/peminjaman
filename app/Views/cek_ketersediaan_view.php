<!DOCTYPE html>
<html>
<head>
    <title>Cek Ketersediaan</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <h2 class="mb-4">Cek Ketersediaan Fasilitas</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= $err ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('/cek/cek_ketersediaan'); ?>" class="card p-4 shadow-sm">
        <?= csrf_field() ?>

        <!-- FAKULTAS -->
        <div class="mb-3">
            <label class="form-label">Fakultas</label>
            <select name="fakultas" id="fakultas" class="form-select">
                <option value="">-- Pilih Fakultas --</option>
                <?php foreach ($fakultas as $f): ?>
                    <?php $sel = (old('fakultas') == $f->id_fakultas || (isset($fakDipilih) && $fakDipilih == $f->id_fakultas)) ? 'selected' : ''; ?>
                    <option value="<?= $f->id_fakultas ?>" <?= $sel ?>>
                        <?= $f->nama_fakultas ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- FASILITAS -->
        <div class="mb-3">
            <label class="form-label">Fasilitas</label>
            <select name="fasilitas" id="fasilitas" class="form-select"
                    onchange="location.href='<?= current_url() ?>?fasilitas='+this.value+'&fakultas='+document.getElementById('fakultas').value">
                <option value="">-- Pilih Fasilitas --</option>
                <?php foreach ($fasilitas as $fs): ?>
                    <?php $selF = (old('fasilitas') == $fs->id_fasilitas || (isset($fasDipilih) && $fasDipilih == $fs->id_fasilitas)) ? 'selected' : ''; ?>
                    <option value="<?= $fs->id_fasilitas ?>" <?= $selF ?>>
                        <?= $fs->nama_fasilitas ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- DROPDOWN RUANGAN -->
        <?php
            $selectedFas = $fasDipilih ?? old('fasilitas');
            $selectedFasName = '';
            if (!empty($selectedFas)) {
                foreach ($fasilitas as $ff) {
                    if ($ff->id_fasilitas == $selectedFas) {
                        $selectedFasName = $ff->nama_fasilitas;
                        break;
                    }
                }
            }
        ?>

        <?php if ($selectedFasName === 'Ruang Kelas' || $selectedFasName === 'Ruang Lab'): ?>
            <div class="mb-3">
                <label class="form-label">Ruangan</label>
                <select name="ruangan" class="form-select">
                    <option value="">-- Pilih Ruangan --</option>
                    <?php foreach ($ruangan as $r): ?>
                        <?php $selR = (old('ruangan') == $r->id_ruangan) ? 'selected' : ''; ?>
                        <option value="<?= $r->id_ruangan ?>" <?= $selR ?>>
                            <?= $r->nama_ruangan ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal_peminjaman" class="form-control"
                   value="<?= old('tanggal_peminjaman') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Mulai</label>
            <input type="time" name="waktu_mulai" class="form-control"
                   value="<?= old('waktu_mulai') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Waktu Selesai</label>
            <input type="time" name="waktu_selesai" class="form-control"
                   value="<?= old('waktu_selesai') ?>">
        </div>

        <button type="submit" class="btn btn-primary w-100">Cek Ketersediaan</button>
        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary w-100 mt-2">
        Kembali ke Dashboard
</a>


    </form>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelector("form").addEventListener("submit", function(e){

    let errors = [];

    let fakultas       = document.querySelector("[name='fakultas']").value;
    let fasilitas      = document.querySelector("[name='fasilitas']").value;
    let tanggal        = document.querySelector("[name='tanggal_peminjaman']").value;
    let waktuMulai     = document.querySelector("[name='waktu_mulai']").value;
    let waktuSelesai   = document.querySelector("[name='waktu_selesai']").value;
    let ruanganEl      = document.querySelector("[name='ruangan']");

    
    if(fakultas === "") errors.push("Fakultas wajib dipilih.");
    if(fasilitas === "") errors.push("Fasilitas wajib dipilih.");
    if(tanggal === "") errors.push("Tanggal wajib diisi.");
    if(waktuMulai === "") errors.push("Waktu mulai wajib diisi.");
    if(waktuSelesai === "") errors.push("Waktu selesai wajib diisi.");

    if(waktuMulai !== "" && waktuSelesai !== ""){
        if(waktuMulai >= waktuSelesai){
            errors.push("Waktu selesai harus lebih besar dari waktu mulai.");
        }
    }

    if(ruanganEl !== null){
        if(ruanganEl.value === ""){
            errors.push("Silakan pilih ruangan.");
        }
    }

    
    let today = new Date();
    today.setHours(0,0,0,0);

    let selectedDate = new Date(tanggal);
    selectedDate.setHours(0,0,0,0);

    if(selectedDate < today){
        errors.push("Tanggal peminjaman tidak boleh di masa lalu.");
    }


    if(errors.length > 0){
        e.preventDefault(); // 

        let errorHTML = "<ul>";
        errors.forEach(function(err){
            errorHTML += "<li>" + err + "</li>";
        });
        errorHTML += "</ul>";

        let alertBox = document.createElement("div");
        alertBox.className = "alert alert-danger mb-3";
        alertBox.innerHTML = errorHTML;

        let oldAlert = document.querySelector(".alert");
        if(oldAlert) oldAlert.remove();

        document.querySelector("form").prepend(alertBox);
    }

});
</script>


</body>
</html>
