<?php

namespace App\Controllers;

use App\Models\Pesan;
use App\Models\User;
use Hermawan\DataTables\DataTable;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $User;
    protected $Pesan;

    public function __construct()
    {
        $this->User = new User();
        $this->Pesan = new Pesan();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $user = $this->User->find();
        $data = [
            'users' => $user,
            'title' => 'List User',
            'notif' => $this->Pesan->notif()
        ];
        return view('users/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    // public function new()
    // {
    //     $builder = $this->User
    //         ->select('id,username, email, password, role, created_at');
    //     return DataTable::of($builder)->addNumbering('number')
    //         ->add('action', function ($row) {
    //             return '<div>
    //                 <form class="d-inline" action="/user/' . $row->id . '" method="post">
    //                     <input type="hidden" name="_method" value="DELETE">
    //                         <button type="submit" class="btn btn-danger">Delete</button>
    //                 </form>

    //                 <a class="btn btn-warning" href="/user/' . $row->id . '/edit">Edit</a>
    //         </div>';
    //         })
    //         ->toJson(true);
    // }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */


    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {

        $data = [
            'title' => 'Edit User',
            'validation' => \Config\Services::validation(),
            'user' => $this->User->find($id),
            'notif' => $this->Pesan->notif()
        ];
        return view('users/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if ($this->request->getVar('username') == $this->request->getVar('usernameOld')) {
            $rules = 'required|min_length[4]|max_length[20]';
        } else {
            $rules = 'required|min_length[4]|max_length[20]|is_unique[users.username]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'email' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'role' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }
        $users = new User();
        $users->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
        ]);
        return redirect()->to('/user')->with('success', 'Success Updated');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->User->delete($id);
        return redirect()->back()->with('success', 'Your Are success delete');
    }
}
