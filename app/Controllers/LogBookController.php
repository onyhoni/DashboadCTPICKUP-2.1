<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pesan;
use App\Models\Tiket;

class LogBookController extends BaseController
{

    protected $Tiket;
    protected $Pesan;
    protected $db;

    public function __construct()
    {
        $this->Tiket = new Tiket();
        $this->Pesan = new Pesan();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Log Book',
            'notif' => $this->Pesan->notif(),
        ];
        return view('LogBook/index', $data);
    }


    public function new() {
        $data = [
            'title' => 'Log Book',
            'notif' => $this->Pesan->notif(),
        ];
        return view('LogBook/new', $data);
    }
}
