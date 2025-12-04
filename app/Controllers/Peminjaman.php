public function riwayat()
{
    $model = new \App\Models\PeminjamanModel();
    $data['riwayat'] = $model->getRiwayat();

    return view('riwayat', $data);
}
