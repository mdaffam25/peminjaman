<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class C_petugas extends Controller
{
    protected $userModel;
    protected $db;

    public function __construct()
    {
        $this->userModel = new UserModel(); // Load UserModel
        $this->db = \Config\Database::connect(); // Koneksi database
    }

    // Ambil data input dari form
    private function input()
    {
        return [
            'NIM'      => $this->request->getPost('NIM'),
            'nama'     => $this->request->getPost('nama'),
            'no_telp'  => $this->request->getPost('no_telp'),
            'password' => $this->request->getPost('password'),
        ];
    }  

    // Tampilan Utama
    public function index()
    {
        $data['user'] = $this->userModel->findAll();
        return view('dashboard_petugas', $data);
    }

    // Form Tambah
    public function tambah()
    {
        return view('user/tambah_user');
    }

    // Simpan
    public function simpan()
    {
        $data = $this->input();

        // Validasi semua data harus diisi
        if (empty($data['NIM']) || empty($data['nama']) || empty($data['no_telp']) || empty($data['password'])) {
            return redirect()->back()->with('error', 'Semua data harus diisi!');
        }

        // Validasi NIM dan no_telp harus angka
        if (!is_numeric($data['NIM']) || !is_numeric($data['no_telp'])) {
            return redirect()->back()->with('error', 'NIM dan Nomer Telepon harus berupa angka!');
        }

        // Validasi nama harus huruf 
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['nama'])) {
            return redirect()->back()->with('error', 'Nama harus berupa huruf!');
        }
       
        // Cek apakah NIM, nama, atau no_telp sudah terdaftar
    foreach (['NIM', 'nama', 'no_telp'] as $field) {
        if ($this->userModel->where($field, $data[$field])->first()) {
           return redirect()->back()->with('error', "$field sudah terdaftar!");
           }
        }

        // Insert data
        $sql = "INSERT INTO user (NIM, nama, no_telp, password) VALUES 
               ('{$data['NIM']}', 
                '{$data['nama']}', 
                '{$data['no_telp']}', 
                '{$data['password']}')";

        if ($this->db->query($sql)) {
            return redirect()->to('dashboard_petugas')->with('success', 'Data user berhasil ditambah');
        }

        return redirect()->back()->with('error', 'Gagal menambah data user');
    }

    // Form edit
    public function edit($nim)
    {
        $data['user'] = $this->userModel->find($nim);
        return view('user/edit_user', $data);
    }

    // Update
    public function update($nim)
    {
        $data = $this->input();

        // Validasi semua data harus diisi
        if (empty($data['NIM']) || empty($data['nama']) || empty($data['no_telp']) || empty($data['password'])) {
            return redirect()->back()->with('error', 'Semua data harus diisi!');
        }

        // Validasi NIM dan no_telp harus angka
        if (!is_numeric($data['NIM']) || !is_numeric($data['no_telp'])) {
            return redirect()->back()->with('error', 'NIM dan Nomer Telepon harus berupa angka!');
        }

        // Validasi nama harus huruf 
        if (!preg_match("/^[a-zA-Z\s]+$/", $data['nama'])) {
            return redirect()->back()->with('error', 'Nama harus berupa huruf!');
        }
        
        // Update data
         $sql = "UPDATE user SET
                NIM='{$data['NIM']}',
                nama='{$data['nama']}',
                no_telp='{$data['no_telp']}',
                password='{$data['password']}'
                WHERE NIM='$nim'";

        if ($this->db->query($sql)) {
            return redirect()->to('dashboard_petugas')->with('success', 'Data user berhasil diupdate');
        }

        return redirect()->back()->with('error', 'Gagal update data');
    }

    // Delete data
    public function delete($nim)
    {
        $sql = "DELETE FROM user WHERE NIM='$nim'";

        if ($this->db->query($sql)) {
            return redirect()->to('dashboard_petugas')->with('success', 'Data user berhasil dihapus');
        }

        return redirect()->back()->with('error', 'Gagal menghapus data');
    }
}
