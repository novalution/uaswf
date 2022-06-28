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
        $this->roleBuilder = $this->db->table('auth_groups_users');
        $this->accessBuilder = $this->db->table('auth_logins');
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
            return redirect()->to('/admin/dashboard');
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
            return redirect()->to('/admin/userlist');
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
    public function getDashboardData()
    {
        $now = date("Y-m-d");
        $year = date("Y");
        $month = date("m");
        // $oneMonthBefore = strtotime('-1 month', $now);
        // $oneMonthAfter = strtotime('+1 month', $now);
        // $oneYearBefore = strtotime('-1 year', $now);
        // $oneYearAfter = strtotime('+1 year', $now);

        $this->builder->select('id');
        $this->builder->where('deleted_at IS NOT NULL');
        $deletedUserQuery = $this->builder->get();
        $rsvpQuery = $this->reservasi->get();
        $roleQuery = $this->roleBuilder->get();
        $labQuery = $this->labsBuilder->get();
        $data['deletedUsers'] = $deletedUserQuery->getResult();
        $data['reservations'] = $rsvpQuery->getResult();
        $data['roles'] = $roleQuery->getResult();
        $data['labs'] = $labQuery->getResult();

        // //User access data, daily
        // $this->accessBuilder->where('date = '.date("Y-m-d").' AND success = 1');
        // $data['dailyAccess'] = $this->accessBuilder->countAllResults();

        // //User access data, monthly
        // $this->accessBuilder->where('date BETWEEN '.$oneMonthBefore.' AND '.$now.' AND success = 1');
        // $data['monthlyAccess'] = $this->accessBuilder->countAllResults();

        // //User access data, yearly
        // $this->accessBuilder->where('date BETWEEN '.$oneYearBefore.' AND '.$now.' AND success = 1');
        // $data['yearlyAccess'] = $this->accessBuilder->countAllResults();

        // //Daily reservation
        // $this->reservasi->where('tanggal', $now);
        // $data['dailyRsvp'] = $this->reservasi->countAllResults();

        // //Monthly reservation
        // $this->reservasi->where('tanggal BETWEEN '.$oneMonthBefore.' AND '.$now.' AND status = "verif"');
        // $data['dailyRsvp'] = $this->reservasi->countAllResults();

        // //Yearly reservation
        // $this->reservasi->where('tanggal BETWEEN '.$oneMonthBefore.' AND '.$now.' AND status = "verif"');
        // $data['dailyRsvp'] = $this->reservasi->countAllResults();

        //User access data, daily
        $this->accessBuilder->where('DATE_FORMAT(date, "%Y-%m-%d")', $now);
        $this->accessBuilder->where('success', 1);
        $this->accessBuilder->groupBy('user_id');
        $data['dailyAccess'] = $this->accessBuilder->countAllResults();

        //User access data, monthly
        $this->accessBuilder->where('YEAR(date)', $year);
        $this->accessBuilder->where('MONTH(date)', $month);
        $this->accessBuilder->where('success', 1);
        $this->accessBuilder->groupBy('user_id');
        $data['monthlyAccess'] = $this->accessBuilder->countAllResults();

        //User access data, yearly
        $this->accessBuilder->where('YEAR(date)', $year);
        $this->accessBuilder->where('success', 1);
        $this->accessBuilder->groupBy('user_id');
        $data['yearlyAccess'] = $this->accessBuilder->countAllResults();

        //Daily reservation
        $this->reservasi->where('tanggal', $now);
        $this->reservasi->where('status', "verif");
        $data['dailyRsvp'] = $this->reservasi->countAllResults();

        //Monthly reservation
        $this->reservasi->where("YEAR(tanggal)", $year);
        $this->reservasi->where("MONTH(tanggal)", $month);
        $this->reservasi->where('status', "verif");
        $data['monthlyRsvp'] = $this->reservasi->countAllResults();

        //Yearly reservation
        $this->reservasi->where("YEAR(tanggal)", $year);
        $this->reservasi->where('status', "verif");
        $data['yearlyRsvp'] = $this->reservasi->countAllResults();

        return view('/admin/index', $data);
    }
}
