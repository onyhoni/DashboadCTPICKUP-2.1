<?php

namespace App\Controllers;

use App\Models\Account;
use CodeIgniter\I18n\Time;
use Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\Pesan;

class AccountController extends BaseController
{
    protected $Account;
    protected $Pesan;
    protected $db;

    public function __construct()
    {
        $this->Account = new Account();
        $this->Pesan = new Pesan();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');


        if ($keyword) {
            $account = $this->Account->Search($keyword);
        } else {
            $account = $this->Account;
        }



        $currentPage = $this->request->getVar('page_zipcode') ? $this->request->getVar('page_zipcode') : 1;

        return view(
            'accounts/index',
            [

                'title' => 'List Account',
                'notif' => $this->Pesan->notif(),
                'accounts' => $account->paginate(10, 'account'),
                'pager' => $account->pager,
                'currentPage' => $currentPage,
            ]

        );
    }

    public function store()
    {
        if (!$this->validate([
            'account' => 'required|is_unique[accounts.id]',
            'customer_name' => 'required|max_length[225]',
            'industry' => 'required|max_length[225]',
            'branch' => 'required|max_length[225]',
            'payment' => 'required|max_length[225]',
            'pic_name' => 'required|max_length[225]',
            'sales_name' => 'required|max_length[225]',
            'sales_phone' => 'required|max_length[20]'
        ])) {
            return redirect()->to('account/create')->withInput();
        }

        $data = [
            'id' => $this->request->getVar('account'),
            'cust_grouping' => $this->request->getVar('customer_name'),
            'cust_industry' => $this->request->getVar('industry'),
            'cust_branch' => $this->request->getVar('branch'),
            'payment_metode' => $this->request->getVar('payment'),
            'pic_name' => $this->request->getVar('pic_name'),
            'sales_name' => $this->request->getVar('sales_name'),
            'sales_phone' => $this->request->getVar('sales_phone'),
            'created_at' => Time::now(),
        ];

        $this->db->table('accounts')->insert($data);



        return redirect()->to('account')->with('success', 'Nomor Account Berhasil didaftarkan');
    }

    public function destroy($id)
    {
        $this->Account->delete($id);

        return redirect()->to('account');
    }

    public function create()
    {
        $data = [
            'title' => 'Create New Account',
            'notif' => $this->Pesan->notif(),
            'validation' => \config\Services::validation()
        ];
        return view('accounts/create', $data);
    }

    public function edit($id)
    {
        $data = [
            'account' => $this->Account->find($id),
            'validation' => \config\Services::validation(),
            'title' => 'Edit Account',
            'notif' => $this->Pesan->notif(),
        ];
        return view('accounts/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'customer_name' => 'required|max_length[225]',
            'industry' => 'required|max_length[225]',
            'branch' => 'required|max_length[225]',
            'payment' => 'required|max_length[225]',
            'pic_name' => 'required|max_length[225]',
            'sales_name' => 'required|max_length[225]',
            'sales_phone' => 'required|max_length[20]'
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            'cust_grouping' => $this->request->getVar('customer_name'),
            'cust_industry' => $this->request->getVar('industry'),
            'cust_branch' => $this->request->getVar('branch'),
            'payment_metode' => $this->request->getVar('payment'),
            'pic_name' => $this->request->getVar('pic_name'),
            'sales_name' => $this->request->getVar('sales_name'),
            'sales_phone' => $this->request->getVar('sales_phone'),
            'updated_at' => Time::now(),
        ];

        $this->db->table('accounts')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Success Update data');
    }
}
