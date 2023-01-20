<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pesan;
use App\Models\User;

class RegisterController extends BaseController
{
    public function index()
    {
        $Pesan = new Pesan();
        $data = [
            'validation' => \Config\Services::validation(),
            'title' => 'Registration',
            'notif' => $Pesan->notif()
        ];
        return view('auth/register', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|min_length[4]|max_length[100]|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                    'is_unique' => 'Email sudah digunakan sebelumnya'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }
        $users = new User();
        $users->save([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'email' => $this->request->getVar('email'),
            'role' => 'User'
        ]);
        return redirect()->to('/user')->with('success', 'Success Registed');
    }
}
