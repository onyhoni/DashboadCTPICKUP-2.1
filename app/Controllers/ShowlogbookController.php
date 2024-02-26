<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ShowlogbookController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
//        dd();
        $data = [
            'title' => 'Show logBook',
            'validation' => \config\Services::validation(),
            'categories' => $this->db->table('categories')->get()->getResult(),
            'issues' => $this->db->table('issues')->get()->getResult(),
            'impacts' => $this->db->table('impacts')->get()->getResult(),
            'sub_types' => $this->db->table('sub_types')->join('issues', 'sub_types.issue_id = issues.id')->select('sub_types.*, issues.name as issue')->get()->getResult(),
            'descriptions' => $this->db->table('descriptions')
                ->join('sub_types', 'descriptions.sub_type_id = sub_types.id')
                ->join('impacts', 'descriptions.impact_id = impacts.id')
                ->select('descriptions.* ,impacts.name as impact, sub_types.name as sub_type')
                ->get()->getResult()
        ];
        return view('ShowLogbook/index', $data);
    }

    public function editCategory()
    {
        $id = $this->request->getVar('id');
        $table = $this->request->getVar('table');

        return json_encode($this->db->table($table)->where('id', $id)->get()->getRow());

    }

    public function updateCategory()
    {
        $id = $this->request->getVar('id-category');
        $table = $this->request->getVar('table-name');
        $data = [
            'name' => $this->request->getVar('category'),
        ];

        $this->db->table($table)->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Update Successfuly');
    }

    public function editSubType()
    {
        $id = $this->request->getVar('id');

        return json_encode($this->db->table('sub_types')->where('id', $id)->get()->getRow());

    }

    public function updateSubType()
    {
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'issue_id' => $this->request->getVar('issue'),
        ];

        $this->db->table('sub_types')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Update Successfuly');
    }

    public function editDescription()
    {
        $id = $this->request->getVar('id');
        return json_encode($this->db->table('descriptions')->where('id', $id)->get()->getRow());
    }

    public function updateDescription()
    {
        $id = $this->request->getVar('id');

        $data = [
            'sub_type_id' => $this->request->getVar('sub_type'),
            'impact_id ' => $this->request->getVar('sub_type'),
            'name' => $this->request->getVar('description')
        ];

        $this->db->table('descriptions')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Updated Successfuly');
    }
}
