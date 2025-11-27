public function save(){
    $fasilitas = $this->input->post('fasilitas');
    $ruangan = $this->input->post('ruangan');
    $tanggal = $this->input->post('tanggal');
    $mulai = $this->input->post('mulai');
    $selesai = $this->input->post('selesai');

    // Cek tabrakan data
    $cek = $this->PeminjamanModel->cekKetersediaan($fasilitas, $ruangan, $tanggal, $mulai, $selesai);

    if($cek > 0){
        echo "<script>alert('Fasilitas atau ruangan tidak tersedia pada waktu tersebut.'); window.history.back();</script>";
        return;
    }

    $data = [
        'NIM' => $this->input->post('nim'),
        'id_fakultas' => $this->input->post('fakultas'),
        'id_fasilitas' => $fasilitas,
        'id_ruangan' => $ruangan,
        'tanggal_peminjaman' => $tanggal,
        'waktu_mulai' => $mulai,
        'waktu_selesai' => $selesai,
        'keterangan' => $this->input->post('keterangan')
    ];

    $this->PeminjamanModel->insertPeminjaman($data);
    redirect('PeminjamanController/index');
}
