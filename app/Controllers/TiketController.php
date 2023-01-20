<?php

namespace App\Controllers;

use App\Models\Pesan;
use App\Models\Tiket;
use CodeIgniter\I18n\Time;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class TiketController extends BaseController
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
        $status = $this->request->getVar('status');
        $case = $this->request->getVar('case');
        $regional  = $this->request->getVar('regional');
        $startTime = $this->request->getVar('startTime');
        $endTime = $this->request->getVar('endTime');

        $start = $startTime ? $startTime : date('Y-m-d', strtotime('-1 days'));
        $end = $endTime ? $endTime : date('Y-m-d');

        $Pesan = new Pesan();

        $builder = $this->Tiket
            ->select('tiket_id ,awb,seller_name,origin,regional,tikets.case_id as case_id,case,status,created_at,urgency,closed_at, desc ,cases.id as case_id')
            ->join('cases', 'tikets.case_id = cases.id')
            ->where('deleted_at', NULL);


        if ($status) {
            $builder->where('status', $status);
            $builder->where('created_at >=', $start);
            $builder->where('created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } elseif ($case) {
            $builder->where('case_id', $case);
            $builder->where('created_at >=', $start);
            $builder->where('created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } elseif ($regional) {
            $builder->where('regional', $regional);
            $builder->where('created_at >=', $start);
            $builder->where('created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else {
            $builder->where('created_at >=', $start);
            $builder->where('created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        }

        $tikets = $builder->get()->getResult();

        $data = [
            'title' => 'Tiket',
            'validation' => \config\Services::validation(),
            'cases' => $this->Tiket->distinct()->findColumn('case_id'),
            'regionals' => $this->Tiket->distinct()->findColumn('regional'),
            'notif' => $Pesan->notif(),
            'tikets' => $tikets
        ];
        return view('tikets/index', $data);
    }

    public function detail($id)
    {
        $builder = $this->Tiket
            ->join('cases', 'tikets.case_id = cases.id')
            ->where('tikets.tiket_id', $id);

        $query   = $builder->get()->getRowArray();
        $pesan = $this->Pesan
            ->select('pesan,messages.created_at,username,user_id,foto')
            ->join('users', 'users.id = messages.user_id')
            ->orderBy('messages.created_at', 'desc')
            ->where('tiket_id', $id)->findAll();
        $Pesan = new Pesan();

        $data  = [
            'data' => $query,
            'pesans' => $pesan,
            'tiket' => $this->Tiket->Search($id),
            'validation' => \config\Services::validation(),
            'title' => 'Detail',
            'notif' => $Pesan->notif()
        ];
        return view('tikets/detail', $data);
    }

    public function show()
    {
    }

    public function store()
    {

        if (!$this->validate([
            'import' => [
                'rules' => 'uploaded[import]|max_size[import,1024]',
                'errors' => [
                    'uploaded' => 'Pilih File Dahulu',
                    'max_size' => 'file Gambar lebih dari 1mb'
                ]
            ]

        ])) {
            return redirect()->to('/tiket')->withInput();
        }

        $file = $this->request->getFile('import');

        $reader = new Xlsx();

        $spreadsheet = $reader->load($file);

        $sheet = $spreadsheet->getSheet(0)->toArray();


        $Report = [];

        for ($i = 1; $i < count($sheet); $i++) {

            if ($sheet[0]['1'] != 'CASE') {
                return redirect()->back()->with('error', 'Template tidak sesuai ...');
            }

            $data = $this->Tiket->Search($sheet[$i]['0']);

            if ($data == true) {
                $Report[] = [
                    'tiket_id' =>  $sheet[$i]['0'],
                    'awb' => $sheet[$i]['1'],
                    'type_case' => $sheet[$i]['2'],
                    'keterangan' => $sheet[$i]['3'],
                    'urgency' => $sheet[$i]['4'],
                    'Status' => 'Already Exist'
                ];
            } else {
                $Report[] = [
                    'tiket_id' =>  $sheet[$i]['0'],
                    'awb' => $sheet[$i]['1'],
                    'type_case' => $sheet[$i]['2'],
                    'keterangan' => $sheet[$i]['3'],
                    'urgency' => $sheet[$i]['4'],
                    'Status' => 'Successfuly'
                ];
                $this->Tiket->save([
                    'tiket_id' => $sheet[$i]['0'],
                    'case_id' => $sheet[$i]['1'],
                    'desc' => $sheet[$i]['2'],
                    'status' => 'OPEN',
                    'urgency' => $sheet[$i]['3'],
                    'awb' => $sheet[$i]['4'],
                    'no_order'    => $sheet[$i]['5'],
                    'pic_name'    => $sheet[$i]['6'],
                    'account'    => $sheet[$i]['7'],
                    'origin'    => $sheet[$i]['8'],
                    'regional'    => $sheet[$i]['9'],
                    'city'    => $sheet[$i]['10'],
                    'customer_name'    => $sheet[$i]['11'],
                    'seller_name'    => $sheet[$i]['12'],
                    'merchant_id'    => $sheet[$i]['13'],
                    'seller_address'    => $sheet[$i]['14'],
                    'seller_phone'    => $sheet[$i]['15'],
                    'destinasi'    => $sheet[$i]['16'],
                    'service'    => $sheet[$i]['17'],
                    'intruksi'    => $sheet[$i]['18'],
                    'ins_value'    => $sheet[$i]['19'],
                    'cod_flag' => $sheet[$i]['20'],
                    'cod_amount'    => $sheet[$i]['21'],
                    'armada'    => $sheet[$i]['22'],
                    'modul_entry'    => $sheet[$i]['23'],
                    'desc_good'    => $sheet[$i]['24'],
                    'qty'    => $sheet[$i]['25'],
                    'weight'    => $sheet[$i]['26'],
                    'city_id'    => $sheet[$i]['27'],
                    'user_id' => 1
                ]);
            }
        }

        session()->setFlashdata('report', $Report);

        return redirect()->to('/tiket');
    }

    public function take()
    {

        $id = $this->request->getVar('id');

        for ($i = 0; $i < count($id); $i++) {
            $this->db->transBegin();
            try {
                $this->Tiket->Edit($id[$i]);
                $this->Pesan->save([
                    'tiket_id' => $id[$i],
                    'pesan' => 'Tiket Berhasil diambil',
                    'foto' => NULL,
                    'user_id' => 1,
                ]);
                $this->db->transCommit();
            } catch (\Exception $e) {
                $this->db->transRollback();
            }
        }
    }

    public function close()
    {
        $id = $this->request->getVar('id');
        $pesan = $this->request->getVar('pesan');

        for ($i = 0; $i < count($id); $i++) {
            $this->db->transBegin();
            try {
                $this->Tiket->Close($id[$i], 'CLOSE');
                $this->Pesan->save([
                    'tiket_id' => $id[$i],
                    'pesan' => $pesan,
                    'foto' => NULL,
                    'user_id' => 1,
                ]);
                $this->db->transCommit();
            } catch (\Exception $e) {
                $this->db->transRollback();
            }
        }
    }


    public function delete()
    {
        $id = $this->request->getVar('id');

        for ($i = 0; $i < count($id); $i++) {
            $this->db->table('tikets')->delete(['tiket_id' => $id[$i]]);
        }
    }

    public function open()
    {
        $id = $this->request->getVar('id');
        $this->Tiket->Edit($id);
        $this->Pesan->save([
            'tiket_id' => $id,
            'pesan' => 'Tiket telah dibuka',
            'foto' => NULL,
            'user_id' => session('id'),
        ]);

        return redirect()->back();
    }
}
