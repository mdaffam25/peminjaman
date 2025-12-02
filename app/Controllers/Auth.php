<?php

namespace App\Controllers;
use App\Models\UserModel;

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

        $nim = $this->request->getVar('nim');
        $password = $this->request->getVar('password');
        $remember = $this->request->getVar('remember');

        $user = $userModel->getByNIM($nim);

        if ($user && $password == $user['password']) {

            // SET SESSION
            $session->set([
                'id_user' => $user['id_user'],
                'nama' => $user['nama'],
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
