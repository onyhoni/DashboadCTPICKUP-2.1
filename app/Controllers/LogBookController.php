<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Account;
use App\Models\LogBook;
use App\Models\Pesan;
use App\Models\Tiket;
use CodeIgniter\I18n\Time;
use CodeIgniter\Validation\Validation;


class LogBookController extends BaseController
{

    protected $LogBook;
    protected $Pesan;
    protected $db;


    public function __construct()
    {
        $this->LogBook = new LogBook();
        $this->Pesan = new Pesan();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Log Book',
            'notif' => $this->Pesan->notif(),
            'logs' => $this->LogBook->join('users', 'logbooks.user_id = users.id ')
                ->join('accounts', 'logbooks.account_id = accounts.id')
//                ->select('action,code_3lc,email,status,escalation,logbooks.id,impact,issue,priority,regional,task,username,logbooks.created_at,accounts.cust_industry as customer')
                ->orderBy('logbooks.created_at', 'DESC')->get()->getResult()
        ];
        return view('LogBook/index', $data);
    }


    public function new()
    {
        $data = [
            'title' => 'Log Book',
            'notif' => $this->Pesan->notif(),
            'validation' => \config\Services::validation(),
            'categories' => $this->db->table('categories')->get()->getResult(),
            'issues' => $this->db->table('issues')->get()->getResult()

        ];
        return view('LogBook/create', $data);
    }


    public function create()
    {
        if (!$this->validate([
            'task' => 'required',
            'code_3lc' => 'required',
            'account' => [
                'rules' => 'required|is_exist[accounts.id]',
                'errors' => [
                    'is_exist' => 'Account tidak terdaftar...',
                ],
            ],
            'regional' => 'required',
            'priority' => 'required',
            'issue' => 'required',
            'escalation' => 'required',
            'impact' => 'required',
            'action' => 'required'
        ])) {
            return redirect()->to('log/new')->withInput();
        }

        $data = [
            'task' => $this->request->getVar('task'),
            'code_3lc' => $this->request->getVar('code_3lc'),
            'regional' => $this->request->getVar('regional'),
            'priority' => $this->request->getVar('priority'),
            'issue' => $this->request->getVar('issue'),
            'escalation' => $this->request->getVar('escalation'),
            'impact' => $this->request->getVar('impact'),
            'action' => $this->request->getVar('action'),
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
            'notif' => $this->Pesan->notif(),
            'validation' => \config\Services::validation(),
            'log' => $this->LogBook->where('id', $id)->get()->getRow()
        ];
        return view('LogBook/edit', $data);
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
            ->join('impacts', 'descriptions.impact_id = impacts.id')
            ->select('descriptions.id,descriptions.name,impact_id,impacts.name as impact_name')
            ->where('sub_type_id', $id)->get()->getResult());

    }
}
