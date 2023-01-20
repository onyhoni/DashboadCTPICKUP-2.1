<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use App\Models\Pesan;

class EditController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('cases')
            ->get()->getResultArray();

        $Pesan = new Pesan();

        $data = [
            'title' => 'Edit',
            'cases' => $builder,
            'notif' => $Pesan->notif()
        ];

        return view('edits/index', $data);
    }

    public function dataedit()
    {
        $id  = $this->request->getVar();
        $builder = $this->db->table('tikets')
            ->where('tikets.tiket_id', $id)
            ->get()->getRowArray();

        return json_encode($builder);
    }

    public function update()
    {

        $id = $this->request->getVar('noTicket');

        $tiket = [
            'case_id' => $this->request->getVar('case'),
            'desc'  => $this->request->getVar('keteranganTicket'),
            'urgency'  => $this->request->getVar('urgency'),
            'awb' => $this->request->getVar('awb'),
            'no_order' => $this->request->getVar('no_order'),
            'pic_name' => $this->request->getVar('nama_pic'),
            'account' => $this->request->getVar('account'),
            'origin' => $this->request->getVar('origin'),
            'regional' => $this->request->getVar('regional'),
            'city' => $this->request->getVar('nama_kota'),
            'customer_name' => $this->request->getVar('customer_name'),
            'seller_name' => $this->request->getVar('seller_name'),
            'merchant_id' => $this->request->getVar('merchant_id'),
            'seller_name' => $this->request->getVar('seller_name'),
            'merchant_id' => $this->request->getVar('merchant_id'),
            'seller_address' => $this->request->getVar('seller_address'),
            'seller_phone' => $this->request->getVar('seller_phone'),
            'destinasi' => $this->request->getVar('destinasi'),
            'service' => $this->request->getVar('service'),
            'intruksi' => $this->request->getVar('intruksi'),
            'ins_value' => $this->request->getVar('ins_value'),
            'cod_flag' => $this->request->getVar('cod_flag'),
            'cod_amount' => $this->request->getVar('cod_amount'),
            'armada' => $this->request->getVar('armada'),
            'modul_entry' => $this->request->getVar('modul_entry'),
            'desc_good' => $this->request->getVar('desc'),
            'qty' => $this->request->getVar('qty'),
            'weight' => $this->request->getVar('weight'),
            'updated_at' => Time::now()
        ];

        $this->db->table('tikets')->where('tiket_id', $id)->update($tiket);

        session()->setFlashdata('success', 'Data Berhasil diubah');

        return redirect()->to('/edit');
    }
}
