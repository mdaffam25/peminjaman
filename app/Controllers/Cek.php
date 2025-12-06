<?php

namespace App\Controllers;

use App\Models\M_Cek;
use CodeIgniter\Controller;

class Cek extends Controller
{
    protected $mCek;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->mCek = new M_Cek();
    }

    public function index()
    {
        // baca GET param untuk menampilkan dropdown ruangan (preserve pilihan)
        $fasDipilih = $this->request->getGet('fasilitas') ?? old('fasilitas');
        $fakultasDipilih = $this->request->getGet('fakultas') ?? old('fakultas');

        $data = [
            'fakultas'   => $this->mCek->getFakultas(),
            'fasilitas'  => $this->mCek->getFasilitas(),
            'ruangan'    => $this->mCek->getRuangan(),
            'fasDipilih' => $fasDipilih,
            'fakDipilih' => $fakultasDipilih
        ];

        return view('cek_ketersediaan_view', $data);
    }

    public function cek_ketersediaan()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'fakultas'           => 'required',
            'fasilitas'          => 'required',
            'tanggal_peminjaman' => 'required|valid_date[Y-m-d]|is_not_past_date',
            'waktu_mulai'        => 'required',
            'waktu_selesai'      => 'required'
        ];

        $validation->setRules($rules);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $input = $this->request->getPost();

        // Tambahan validasi: waktu_mulai harus < waktu_selesai
        if (isset($input['waktu_mulai'], $input['waktu_selesai']) && $input['waktu_mulai'] >= $input['waktu_selesai']) {
            return redirect()->back()
                ->withInput()
                ->with('errors', ['Waktu mulai harus lebih kecil dari waktu selesai']);
        }

        // Pastikan nilai yang dikirim adalah id (int) - convert if needed
        // model expects 'fasilitas' = id_fasilitas, 'ruangan' = id_ruangan (optional)

        $hasil = $this->mCek->cekFasilitas($input);

        $data = [
            'hasil'     => $hasil,
            'input'     => $input,
            // Kirim juga daftar lookup supaya view dapat menampilkan nama (bukan hanya ID)
            'fakultas'  => $this->mCek->getFakultas(),
            'fasilitas' => $this->mCek->getFasilitas(),
            'ruangan'   => $this->mCek->getRuangan()
        ];

        return view('hasil_ketersediaan', $data);

        
    }
}
