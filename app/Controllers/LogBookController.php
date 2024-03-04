<?php

namespace App\Controllers;


use App\Models\LogBook;
use App\Models\Pesan;
use CodeIgniter\I18n\Time;

;


class LogBookController extends BaseController
{

    protected $LogBook;
    protected $Pesan;
    protected $db;


    public function __construct()
    {
        $this->LogBook = new LogBook();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $status = $this->request->getVar('status');
        $category = $this->request->getVar('category');
        $regional = $this->request->getVar('regional');
        $startTime = $this->request->getVar('startTime');
        $endTime = $this->request->getVar('endTime');

        $start = $startTime ? $startTime : date('Y-m-d', strtotime('-7 days'));
        $end = $endTime ? $endTime : date('Y-m-d');

        $builder = $this->LogBook
            ->join('users', 'logbooks.user_id = users.id ')
            ->join('accounts', 'logbooks.account_id = accounts.id')
            ->join('categories', 'logbooks.category_id = categories.id')
            ->join('issues', 'logbooks.issue_id = issues.id')
            ->join('sub_types', 'logbooks.sub_type_id = sub_types.id')
            ->join('descriptions', 'logbooks.description_id = descriptions.id')
            ->join('impacts', 'logbooks.impact_id = impacts.id')
            ->select('logbooks.*, accounts.cust_industry as customer, logbooks.created_at as created_at, categories.name as category, issues.name as issue, sub_types.name as sub_type, descriptions.name as description, impacts.name as impact, username')
            ->orderBy('logbooks.created_at', 'DESC');


        if ($status) {
            $builder->where('status', $status);
            $builder->where('logbooks.created_at >=', $start);
            $builder->where('logbooks.created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } elseif ($category) {
            $builder->where('category_id', $category);
            $builder->where('logbooks.created_at >=', $start);
            $builder->where('logbooks.created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } elseif ($regional) {
            $builder->where('regional', $regional);
            $builder->where('logbooks.created_at >=', $start);
            $builder->where('logbooks.created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        } else {
            $builder->where('logbooks.created_at >=', $start);
            $builder->where('logbooks.created_at <=', date('Y-m-d', strtotime('+1 days', strtotime($end))));
        }

        $logbooks = $builder->get()->getResultArray();

        $data = [
            'request' => [
                'status' => $status,
                'category' => $category,
                'regional' => $regional,
                'startTime' => $startTime,
                'endTime' => $endTime
            ],
            'title' => 'Log Book',
            'logs' => $logbooks
        ];

        for ($i = 0; $i < count($data['logs']); $i++) {
            $lastUpdate = $this->db->table('updatelogbooks')->where('logbook_id', $data['logs'][$i]['id'])->orderBy('created_at', 'DESC')->get()->getRowArray();

            array_push($data['logs'][$i], $lastUpdate ? $lastUpdate : []);
        }


        // dd($data['logs']);
        return view('LogBook/index', $data);
    }


    public function new()
    {
        $data = [
            'title' => 'Log Book',
            'validation' => \config\Services::validation(),
            'categories' => $this->db->table('categories')->get()->getResult(),
            'issues' => $this->db->table('issues')->get()->getResult()

        ];
        return view('LogBook/create', $data);
    }


    public function create()
    {
        //        dd($this->request->getVar());
        if (!$this->validate([
            'task' => 'required',
            'code_3lc' => [
                'rules' => 'required|is_exist[cities.code_3lc]',
                'errors' => [
                    'is_exist' => 'code 3lc invalid',
                ],
            ],
            'account' => [
                'rules' => 'required|is_exist[accounts.id]',
                'errors' => [
                    'is_exist' => 'account invalid',
                ],
            ],
            'regional' => 'required',
            'priority' => 'required',
            'escalation' => 'required',
            'category' => 'required',
            'issue' => 'required',
            'sub_type' => 'required',
            'description' => 'required',
            'impact' => 'required',
            'action' => 'required'
        ])) {
            return redirect()->to('log/new')->withInput();
        }


        $data = [
            'account_id' => $this->request->getVar('account'),
            'code_3lc' => $this->request->getVar('code_3lc'),
            'regional' => $this->request->getVar('regional'),
            'priority' => $this->request->getVar('priority'),
            'category_id' => $this->request->getVar('category'),
            'issue_id' => $this->request->getVar('issue'),
            'sub_type_id' => $this->request->getVar('sub_type'),
            'description_id' => $this->request->getVar('description'),
            'impact_id' => $this->request->getVar('impact'),
            'escalation' => $this->request->getVar('escalation'),
            'action' => $this->request->getVar('action'),
            'task' => $this->request->getVar('task'),
            'user_id' => session('id'),
            'created_at' => Time::now()
        ];

        $this->db->table('logbooks')->insert($data);


        return redirect()->to('log/new')->with('success', 'Log created ');
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Log Book | Edit',
            'validation' => \config\Services::validation(),
            'categories' => $this->db->table('categories')->get()->getResult(),
            'issues' => $this->db->table('issues')->get()->getResult(),
            'log' => $this->LogBook->where('logbooks.id', $id)->get()->getRow()
        ];
        return view('LogBook/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'account_id' => $this->request->getVar('account'),
            'code_3lc' => $this->request->getVar('code_3lc'),
            'regional' => $this->request->getVar('regional'),
            'priority' => $this->request->getVar('priority'),
            'category_id' => $this->request->getVar('category'),
            'issue_id' => $this->request->getVar('issue'),
            'sub_type_id' => $this->request->getVar('sub_type'),
            'description_id' => $this->request->getVar('description'),
            'impact_id' => $this->request->getVar('impact'),
            'escalation' => $this->request->getVar('escalation'),
            'action' => $this->request->getVar('action'),
            'task' => $this->request->getVar('task'),
            'updated_at' => Time::now()
        ];

        $this->db->table('logbooks')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Log updated ');
    }

    public function show($id)
    {
        $data = [
            'title' => 'Details',
            'validation' => \config\Services::validation(),
            'updates' => $this->db->table('updatelogbooks')->join('users', 'updatelogbooks.user_id = users.id')
                ->where('updatelogbooks.logbook_id', $id)
                ->select('updatelogbooks.*,users.username')
                ->orderBy('updatelogbooks.created_At', 'desc')
                ->get()->getResult(),
            'log' => $this->LogBook
                ->join('users', 'logbooks.user_id = users.id ')
                ->join('accounts', 'logbooks.account_id = accounts.id')
                ->join('categories', 'logbooks.category_id = categories.id')
                ->join('issues', 'logbooks.issue_id = issues.id')
                ->join('sub_types', 'logbooks.sub_type_id = sub_types.id')
                ->join('descriptions', 'logbooks.description_id = descriptions.id')
                ->join('impacts', 'logbooks.impact_id = impacts.id')
                ->select('logbooks.* ,accounts.cust_industry as customer,categories.name as category, issues.name as issue,sub_types.name as sub_type,descriptions.name as description,impacts.name as impact,username')
                ->where('logbooks.id', $id)->get()->getRow()

        ];

        return view('LogBook/show.php', $data);

    }


    public function getSubType()
    {
        $id = $this->request->getVar('id');
        return json_encode($this->db->table('sub_types')->where('issue_id', $id)->get()->getResult());
    }

    public function getDesc()
    {
        $id = $this->request->getVar('id');
        return json_encode($this->db->table('descriptions')
            ->where('sub_type_id', $id)->get()->getResult());
    }

    public function getImpact()
    {
        $id = $this->request->getVar('id');
        return json_encode(
            $this->db->table('descriptions')
                ->join('impacts', 'descriptions.impact_id = impacts.id')
                ->select('impacts.id , impacts.name')
                ->where('descriptions.id', $id)->get()->getResult()
        );
    }


    public function updatelog()
    {
        if (!$this->validate([
            'resolution' => 'required',
            'evidence' => 'max_size[evidence,2048]|is_image[evidence]|mime_in[evidence,image/jpg,image/png,image/jpeg]'
        ])) {
            return redirect()->back()->withInput();
        }

        $fileGambar = $this->request->getFile('evidance');

        if ($fileGambar->getError('evidence') !== 4) {
            $namaFile = $fileGambar->getRandomName();

            $fileGambar->move('img', $namaFile);
        } else {
            $namaFile = NULL;
        }

        $this->db->table('updatelogbooks')->insert([
            'resolution' => $this->request->getVar('resolution'),
            'logbook_id' => $this->request->getVar('id'),
            'created_at' => Time::now(),
            'evidence' => $namaFile,
            'user_id' => session('id')
        ]);

        return redirect()->back();

    }

    public function close()
    {
        $id = $this->request->getVar('id');

        $this->db->table('logbooks')->where('id', $id)->update(['status' => 'CLOSE', 'updated_at' => Time::now()]);

        return redirect()->back();
    }
}
