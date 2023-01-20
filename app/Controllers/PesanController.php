<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\Pesan;

class PesanController extends BaseController
{
    protected $Pesan;
    public function __construct()
    {
        $this->Pesan = new Pesan();
    }

    public function store()
    {
        if (!$this->validate([
            'pesan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pesan wajib di isi'
                ]
            ],

            'pesan-file' => [
                'rules' => 'max_size[pesan-file,1024]|is_image[pesan-file]|mime_in[pesan-file,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'file Gambar lebih dari 1mb',
                    'is_image' => 'file yang anda upload bukan foto',
                    'mime_in' => 'file yang anda upload bukan foto'
                ]
            ]

        ])) {
            return redirect()->to('/tiket/' . $this->request->getVar('tiket_id'))->withInput();
        }

        $fileGambar = $this->request->getFile('pesan-file');

        if ($fileGambar->getError('pesan-file') !== 4) {
            $namaFile = $fileGambar->getRandomName();

            $fileGambar->move('img', $namaFile);
        } else {
            $namaFile = NULL;
        }


        $this->Pesan->save([
            'tiket_id' => $this->request->getVar('tiket_id'),
            'pesan' =>  $this->request->getVar('pesan'),
            'foto' => $namaFile,
            'user_id' => session('id'),
        ]);

        return redirect()->to('/tiket/' . $this->request->getVar('tiket_id'));
    }
}
