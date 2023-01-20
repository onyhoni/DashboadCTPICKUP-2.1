<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Zip;
use App\Models\User;
use App\Models\Pesan;

class ZipController extends BaseController
{
    protected $Pesan;
    protected $Zip;
    protected $db;

    public function __construct()
    {
        $this->Pesan = new Pesan();
        $this->Zip = new Zip();
        $this->db = \Config\Database::connect();
    }

    public function index($id = null)
    {
        $User = new User();

        $keyword = $this->request->getVar('keyword');

        $zip = $keyword ? $this->Zip->SearcH($keyword) : $this->Zip;

        $currentPage = $this->request->getVar('page_zipcode') ? $this->request->getVar('page_zipcode') : 1;

        $data = [
            'title' => 'Edit User',
            'validation' => \Config\Services::validation(),
            'user' => $User->find($id),
            'notif' => $this->Pesan->notif(),
            'zips' => $zip->paginate(10, 'zipcode'),
            'pager' => $zip->pager,
            'currentPage' => $currentPage,
        ];

        return view('Zips/index', $data);
    }

    public function edit($id)
    {
        return view('Zips/edit', [
            'zip' => $this->Zip->find($id),
            'title' => 'Edit User',
            'validation' => \Config\Services::validation(),
            'notif' => $this->Pesan->notif(),
        ]);
    }

    public function update($id)
    {

        if (!$this->validate([
            '3lc' => 'required',
            'regional' => 'required',
            'sla' => 'required',
            'zona' => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            'code_3lc' => $this->request->getVar('3lc'),
            'regional' => $this->request->getVar('regional'),
            'sla' => $this->request->getVar('sla'),
            'zona' => $this->request->getVar('zona')
        ];

        $this->db->table('cities')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Success Update data');
    }

    public function new()
    {
        return view('Zips/create', [
            'title' => 'Create Zip Code',
            'validation' => \Config\Services::validation(),
            'notif' => $this->Pesan->notif()
        ]);
    }

    public function create()
    {

        if (!$this->validate([
            'zip' => 'required|is_unique[cities.id]',
            '3lc' => 'required',
            'regional' => 'required',
            'sla' => 'required',
            'zona' => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        $this->Zip->insert([
            'id' => $this->request->getVar('zip'),
            'code_3lc' => $this->request->getVar('3lc'),
            'regional' => $this->request->getVar('regional'),
            'sla' => $this->request->getVar('sla'),
            'zona' => $this->request->getVar('zona')
        ]);

        return redirect()->to('/zip')->with('success', 'Succes Add Zip code');
    }

    public function delete($id)
    {
        $this->Zip->delete($id);
        return redirect()->back()->with('success', 'Your Are success delete');
    }
}
