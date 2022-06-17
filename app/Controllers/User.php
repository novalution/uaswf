<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use Myth\Auth\Models\UserModel;

class User extends BaseController
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
        $data['title'] = "My Profile";
        return view('user/index', $data);
    }
    public function getForm()
    {
        if ($this->request->isAJAX()) {
            $hasil = [
                'data' => view('user/form')
            ];
            return $this->response->setJSON($hasil);
        } else {
            exit('data tidak dapat diload');
        }
    }
    public function edit($id)
    {
        $data['title'] = 'User Detail';
        $this->builder->select('users.id as userid, username, email, user_image, fullname, alamat, jenis_kelamin, deleted_at, tanggal_lahir, tempat_lahir, telepon, created_at, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        // d($data);
        if (empty($data['user'])) {
            return redirect()->to('/user');
        }

        return view('/user/edit', $data);
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
        $passbaru = $this->request->getVar('password');
        $passlama = $this->request->getVar('passlama');
        if ($passbaru != $passlama) {
            $pass = password_hash($passbaru, PASSWORD_DEFAULT);
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
        return redirect()->to('/user');
    }
}
