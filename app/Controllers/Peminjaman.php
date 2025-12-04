public function riwayat()
{
    $model = new \App\Models\PeminjamanModel();
    $data['riwayat'] = $model->getRiwayat();

    return view('riwayat', $data);
}

public function surat($id_peminjaman)
{
    $model = new \App\Models\PeminjamanModel();
    $data = $model->find($id_peminjaman);

    if (!$data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data peminjaman tidak ditemukan");
    }

    return view('surat_peminjaman', $data);
}

public function download($id_peminjaman)
{
    $dompdf = new \Dompdf\Dompdf();
    $model = new \App\Models\PeminjamanModel();

    $data = $model->find($id_peminjaman);
    if (!$data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data tidak ditemukan");
    }

    $html = view('surat_peminjaman', $data);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return $dompdf->stream("Surat-Peminjaman.pdf", ["Attachment" => true]);
}
