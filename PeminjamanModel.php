public function cekKetersediaan($fasilitas, $ruangan, $tanggal, $mulai, $selesai)
{
    $this->db->where('id_fasilitas', $fasilitas);
    $this->db->where('tanggal_peminjaman', $tanggal);

    // Cek tabrakan waktu
    $this->db->where("(('$mulai' BETWEEN waktu_mulai AND waktu_selesai)
        OR ('$selesai' BETWEEN waktu_mulai AND waktu_selesai)
        OR (waktu_mulai BETWEEN '$mulai' AND '$selesai')
        OR (waktu_selesai BETWEEN '$mulai' AND '$selesai'))");

    if ($ruangan !== "") {
        $this->db->where('id_ruangan', $ruangan);
    }

    return $this->db->get('peminjaman')->num_rows();
}
