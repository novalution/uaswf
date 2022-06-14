<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class Admin extends BaseController
{

    protected $ModelUser;
    public function __construct()
    {
        $this->ModelUser = new UserModel();
        // $this->config = config('Auth');
        $this->db       = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }
    public function index()
    {
        return view('admin/index');
    }
    public function getData()
    {
        $data['title'] = 'User List';
        if ($this->request->isAJAX()) {
            // $data = [
            //     'list' => $this->ModelUser->find()
            // ];
            $this->builder->select('users.id as userid, username, email, user_image, name');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $query = $this->builder->get();
            $data['list'] = $query->getResult();

            $hasil = [
                'data' => view('/admin/list', $data)
            ];
            // echo json_encode($hasil);
            return $this->response->setJSON($hasil);
        } else {
            exit('data tidak dapat diload');
        }
    }
    public function detail($id = 0)
    {
        $data['title'] = 'User Detail';
        $this->builder->select('users.id as userid, username, email, user_image, fullname, alamat, jenis_kelamin, tanggal_lahir, tempat_lahir, telepon, created_at, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('/admin/detail', $data);
    }
}
