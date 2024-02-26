<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class CreateController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function create()
    {
        $data = [
            'title' => 'Created',
            'validation' => \config\Services::validation(),
            'issues' => $this->db->table('issues')->get()->getResult(),
            'sub_types' => $this->db->table('sub_types')->get()->getResult(),
            'impacts' => $this->db->table('impacts')->get()->getResult(),
        ];
        return view('Create/index', $data);
    }

    public function category()
    {

        if (!$this->validate([
            'category' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }

        $this->db->table('categories')->insert(['name' => $this->request->getVar('category')]);

        return redirect()->back()->with('success', 'Insert Successfuly');
    }

    public function issue()
    {

        if (!$this->validate([
            'issue' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }

        $this->db->table('issues')->insert(['name' => $this->request->getVar('issue')]);

        return redirect()->back()->with('success', 'Insert Successfuly');
    }

    public function subType()
    {
        if (!$this->validate([
            'issue' => 'required',
            'sub_type' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }
        $this->db->table('sub_types')->insert([
            'issue_id' => $this->request->getVar('issue'),
            'name' => $this->request->getVar('sub_type')
        ]);

        return redirect()->back()->with('success', 'insert Successfuly');
    }

    public function description()
    {
        if (!$this->validate([
            'sub_type' => 'required',
            'description' => 'required',
            'impact' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }

        $this->db->table('descriptions')->insert([
            'sub_type_id' => $this->request->getVar('sub_type'),
            'impact_id' => $this->request->getVar('impact'),
            'name' => $this->request->getVar('description')
        ]);

        return redirect()->back()->with('success', ' insert Successfuly');
    }

    public function impact()
    {
        if (!$this->validate([
            'impact' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }
        $this->db->table('impacts')->insert(['name' => $this->request->getVar('impact')]);

        return redirect()->back()->with('success', 'Insert Successfuly');

    }
}
