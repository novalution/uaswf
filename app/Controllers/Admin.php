<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;
use App\Models\Reservasi;

class Admin extends BaseController
{

    protected $ModelUser;
    protected $reservasi;
    public function __construct()
    {
        $this->ModelUser = new UserModel();
        // $this->config = config('Auth');
        $this->reservasi = new Reservasi();
        $this->db       = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->labsBuilder = $this->db->table('labs');
    }
    public function users()
    {
        return view('admin/users');
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
    public function labs()
    {
        $data['title'] = 'Lab List';
        $query = $this->labsBuilder->get();
        $data['labs'] = $query->getResult();

        if (empty($data['labs'])) {
            return redirect()->to('/admin');
        }

        return view('/admin/labs', $data);
    }
    public function labDetail($id = 0)
    {
        $data['title'] = 'Lab Detail';
        $query = $this->labsBuilder->getWhere(['lab_id' => $id]);
        $data['lab'] = $query->getRow();

        if (empty($data['lab'])) {
            return redirect()->to('/admin/labs');
        }

        return view('/admin/labsdetail', $data);
    }
    public function labEdit($id = 0)
    {
        $data['title'] = 'Edit Lab Details';
        $query = $this->labsBuilder->getWhere(['lab_id' => $id]);
        $data['lab'] = $query->getRow();

        if (empty($data['lab'])) {
            return redirect()->to('/admin/labs/' . $id);
        }

        return view('/admin/labsedit', $data);
    }
    public function labDelete($id)
    {
        if ($this->request->isAjax()) {
            $this->labsBuilder->delete(['lab_id' => $id]);
            $pesan = [
                'sukses' => "Successfully deleted lab data with ID=$id."
            ];
            echo json_encode($pesan);
        } else {
            exit('Lab data cannot be deleted.');
        }
    }
    public function labUpdate($id)
    {
        if ($this->request->getFile('lab_image')->getName() != '') {
            $image = $this->request->getFile('lab_image');
            $namaImage = $image->getRandomName();
            $image->move(ROOTPATH . 'public/img/', $namaImage);
        } else {
            $namaImage = $this->request->getVar('imglama');
        }
        $data = [
            'lab_name' => $this->request->getVar('lab_name'),
            'capacity' => $this->request->getVar('capacity'),
            'status' => $this->request->getVar('status'),
            'description' => $this->request->getVar('description'),
            'lab_image' => $namaImage
        ];
        $this->labsBuilder->where('lab_id', $id);
        $this->labsBuilder->update($data);
        return redirect()->to('/admin/labs/' . $id);
    }
    public function addLab()
    {
        return view('admin/addlab');
    }
    public function newLab()
    {
        if ($this->request->getFile('lab_image')->getName() != '') {
            $image = $this->request->getFile('lab_image');
            $namaImage = $image->getRandomName();
            $image->move(ROOTPATH . 'public/img/', $namaImage);
        } else {
            $namaImage = 'default.jpg';
        }
        $data = [
            'lab_name' => $this->request->getVar('lab_name'),
            'capacity' => $this->request->getVar('capacity'),
            'status' => $this->request->getVar('status'),
            'description' => $this->request->getVar('description'),
            'lab_image' => $namaImage
        ];
        $this->labsBuilder->insert($data);
        return redirect()->to('/admin/labs/');
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
        return redirect()->to('/admin/users/' . $id);
    }
    public function acc()
    {
        $data['title'] = 'Reserver List';
        $query = $this->reservasi->get();
        $data['status'] = $query->getResult();

        return view('/admin/acc', $data);
    }
    public function accept($id)
    {
        $status = 'verif';
        $this->reservasi->save([
            'id_reservasi' => $id,
            'status' => $status
        ]);
        return redirect()->to('/admin/acc/');
    }
    public function reject($id)
    {
        $status = 'ditolak';
        $this->reservasi->save([
            'id_reservasi' => $id,
            'status' => $status
        ]);
        return redirect()->to('/admin/acc/');
    }
}
