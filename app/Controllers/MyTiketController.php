<?php

namespace App\Controllers;

use App\Models\Pesan;
use App\Models\Tiket;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;

class MyTiketController extends BaseController
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
            ->where('deleted_at', NULL)
            ->where('user_id', session('id'));

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
        return view('MyTikets/index', $data);
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
                    'max_size' => 'file lebih dari 1mb'
                ]
            ]

        ])) {
            return redirect()->to('/MyTiket')->withInput();
        }

        $file = $this->request->getFile('import');

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadsheet = $reader->load($file);

        $sheet = $spreadsheet->getSheet(0)->toArray();


        $Report = [];

        if ($sheet[0]['1'] != 'pesan') {
            return redirect()->back()->with('error', 'Template tidak sesuai ...');
        }

        for ($i = 1; $i < count($sheet); $i++) {

            $data = $this->Tiket->Search($sheet[$i]['0']);

            if ($data) {
                if ($data['status'] == 'CLOSE') {
                    $Report[] = [
                        'tiket_id' =>  $sheet[$i]['0'],
                        'pesan' => $sheet[$i]['1'],
                        'status' => $sheet[$i]['3'],
                        'reason' => 'Failed Update | Tiket Close'
                    ];
                } else {

                    // Cek jika status Open INVALID
                    if ($sheet[$i]['3'] == 'OPEN') {

                        $Report[] = [
                            'tiket_id' =>  $sheet[$i]['0'],
                            'pesan' => $sheet[$i]['1'],
                            'status' => $sheet[$i]['3'],
                            'reason' => 'Failed Update | Invalid Status'
                        ];
                    } else {
                        $Report[] = [
                            'tiket_id' =>  $sheet[$i]['0'],
                            'pesan' => $sheet[$i]['1'],
                            'status' => $sheet[$i]['3'],
                            'reason' => 'Success Update'
                        ];

                        // Cek Jika Status Kosong tidak perlu rubah status


                        if ($sheet[$i]['3'] !== NULL) {
                            $this->Tiket->Close($sheet[$i]['0'], $sheet[$i]['3']);
                        }

                        // Insert to Pesan

                        $builder = $this->db->table('messages');
                        $data = [
                            'tiket_id' => $sheet[$i]['0'],
                            'pesan' => $sheet[$i]['1'],
                            'foto' => $sheet[$i]['2'],
                            'user_id' => session('id'),
                            'created_at' => Time::now()
                        ];
                        $builder->insert($data);
                    }
                }
            } else {
                $Report[] = [
                    'tiket_id' =>  $sheet[$i]['0'],
                    'pesan' => $sheet[$i]['1'],
                    'status' => $sheet[$i]['3'],
                    'reason' => 'Failed Update | No Tiket tidak terdaftar'
                ];
            }
        }

        session()->setFlashdata('report', $Report);

        return redirect()->to('/MyTiket');
    }
}
