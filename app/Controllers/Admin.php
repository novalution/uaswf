<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

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
            $this->builder->select('users.id as userid, username, email, user_image, deleted_at, name');
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
        $this->builder->select('users.id as userid, username, email, user_image, fullname, alamat, jenis_kelamin, deleted_at, tanggal_lahir, tempat_lahir, telepon, created_at, name');
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
    public function delete($id)
    {
        // $userModel = new UserModel();
        // $userModel->delete($id);
        // return redirect()->to('/admin');
        if ($this->request->isAjax()) {
            $this->ModelUser->delete($id);
            $pesan = [
                'sukses' => "Data anggota dengan ID=$id berhasil dihapus"
            ];
            echo json_encode($pesan);
        } else {
            exit('Data tidak dapat dihapus');
        }
    }
    public function edit($id)
    {
        $data['title'] = 'User Detail';
        $this->builder->select('users.id as userid, username, email, user_image, fullname, alamat, jenis_kelamin, deleted_at, tanggal_lahir, tempat_lahir, telepon, created_at, name, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        // d($data);
        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('/admin/edit', $data);
    }
    public function update($id)
    {
        if ($this->request->getFile('user_image')->getName() != '') {
            $avatar = $this->request->getFile('user_image');
            $namaavatar = $avatar->getRandomName();
            $avatar->move(ROOTPATH . 'public/img/', $namaavatar);
        } else {
            $namaavatar = $this->request->getVar('avalama');
        }
        if ($this->request->getVar('password') != $this->request->getVar('passlama')) {
            // $pass = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $pass = Password::hash($this->request->getVar('password'));
        } else {
            $pass = $this->request->getVar('passlama');
        }
        $this->ModelUser->save([
            'id' => $id,
            'fullname' => $this->request->getVar('fullname'),
            'alamat' => $this->request->getVar('alamat'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'telepon' => $this->request->getVar('telepon'),
            'email' => $this->request->getVar('email'),
            'password_hash' => $pass,
            'user_image' => $namaavatar
        ]);
        return redirect()->to('/admin');
    }
    // public function edit($id)
    // {
    //     $data = [
    //         'title' => "Form Edit Data",
    //         'validation' => \Config\Services::validation(),
    //         'users' => $this->ModelUser->
    //     ]
    // }
}
