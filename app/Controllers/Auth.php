<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PetugasModel; 

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $userModel = new UserModel();
        $petugasModel = new PetugasModel(); 

        $nim = $this->request->getVar('nim');
        $password = $this->request->getVar('password');
        $remember = $this->request->getVar('remember');

        // ===== CEK PETUGAS DARI TABEL petugas TERLEBIH DAHULU =====
        $petugas = $petugasModel->getByNIM($nim);

        if ($petugas && $password == $petugas['password']) {

            // SET SESSION 
            $session->set([
                'nim' => $petugas['NIM'],
                'logged_in' => true,
                'last_activity' => time()
            ]);

            // REMEMBER ME 
            if ($remember) {
                setcookie("nim", $nim, time() + 86400, "/");
                setcookie("password", $password, time() + 86400, "/");
            } else {
                setcookie("nim", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }

            return redirect()->to('/dashboard_petugas')->with('success', 'Login Petugas Berhasil!');
        }

        // ===== CEK USER BIASA =====
        $user = $userModel->getByNIM($nim);

        if ($user && $password == $user['password']) {

            // SET SESSION
            $session->set([
                'nim' => $user['NIM'],
                'logged_in' => true,
                'last_activity' => time()
            ]);

            // REMEMBER ME 
            if ($remember) {
                setcookie("nim", $nim, time() + 86400, "/");
                setcookie("password", $password, time() + 86400, "/");
            } else {
                setcookie("nim", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
            }

            return redirect()->to('/dashboard')->with('success', 'Login Berhasil!');
        }

        return redirect()->to('/login')->with('error', 'NIM atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil!');
    }
}
