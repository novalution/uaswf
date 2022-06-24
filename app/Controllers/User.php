<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;
use \App\Models\Reservasi;

class User extends BaseController
{
    protected $ModelUser;
    protected $status;
    public function __construct()
    {
        $this->ModelUser = new UserModel();
        $this->pesan = new Reservasi();
        // $this->config = config('Auth');
        $this->db       = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->labsBuilder = $this->db->table('labs');
        $this->waktuBuilder = $this->db->table('waktu');
        $this->reservasi = $this->db->table('reservasi');
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
        $this->builder->select('users.id as userid, username, email, user_image, fullname, alamat, jenis_kelamin, deleted_at, tanggal_lahir, tempat_lahir, telepon, created_at, name, password_hash');
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
            $pass = Password::hash($passbaru, PASSWORD_DEFAULT);
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
    public function labs()
    {
        $data['title'] = 'Lab List';
        $query = $this->labsBuilder->get();
        $data['labs'] = $query->getResult();

        if (empty($data['labs'])) {
            return redirect()->to('/');
        }

        return view('/user/labs', $data);
    }
    public function labDetail($id = 0)
    {
        $data['title'] = 'Lab Detail';
        $query = $this->labsBuilder->getWhere(['lab_id' => $id]);
        $data['lab'] = $query->getRow();

        if (empty($data['lab'])) {
            return redirect()->to('/user/labs');
        }

        return view('/user/labsdetail', $data);
    }
    public function reservation()
    {
        $data['title'] = 'Jam Reservasi';
        $query = $this->waktuBuilder->get();
        $data['waktu'] = $query->getResult();

        return view('user/reservasi', $data);
    }
    public function pesan()
    {
        $nama = $this->request->getVar('nama');
        $lab = $this->request->getVar('lab');
        $tanggal = $this->request->getVar('tanggal');
        $jam = $this->request->getVar('jam');
        $jam_explode = explode('|', $jam);
        $notes = $this->request->getVar('notes');
        $email = $this->request->getVar('email');
        $telepon = $this->request->getVar('telepon');
        $biaya = $this->request->getVar('biaya');
        if (in_groups('user_non_uns')) {
            $biaya = 'Rp 50000';
        } else {
            $biaya = 'Rp 0';
        }
        $input = [
            'nama' => $nama,
            'nama_lab' => $lab,
            'tanggal' => $tanggal,
            'jam_mulai' => $jam_explode[0],
            'jam_selesai' => $jam_explode[1],
            'notes' => $notes,
            'email' => $email,
            'telepon' => $telepon,
            'biaya' => $biaya
        ];
        $this->reservasi->select('*');
        $this->reservasi->where('nama_lab', $lab);
        $this->reservasi->where('tanggal', $tanggal);
        $this->reservasi->where('jam_mulai', $jam_explode[0]);
        $this->reservasi->where('jam_selesai', $jam_explode[1]);
        $query = $this->reservasi->get();
        // dd($input);
        if (count($query->getResult()) == 0) {
            $this->pesan->save($input);
            $pesan = [
                'sukses' => 'Berhasil Reservasi'
            ];
        } else {
            $pesan = [
                'gagal' => 'Waktu anda bertabrakan dengan jadwal lain'
            ];
        }
        return $this->response->setJSON($pesan);
    }
}
