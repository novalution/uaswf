<?php

namespace App\Controllers;

class Guest extends BaseController
{
    public function __construct()
    {
        $this->db       = \Config\Database::connect();
        $this->labsBuilder = $this->db->table('labs');
        $this->reservasi = $this->db->table('reservasi');
    }

    public function index()
    {
        return view('index');
    }
    public function labs()
    {
        $data['title'] = 'Lab List';
        $query = $this->labsBuilder->get();
        $data['labs'] = $query->getResult();

        if (empty($data['labs'])) {
            return redirect()->to('/');
        }

        return view('/guest/labs', $data);
    }
    public function labDetail($id = 0)
    {
        $data['title'] = 'Lab Detail';
        $query = $this->labsBuilder->getWhere(['lab_id' => $id]);
        $data['lab'] = $query->getRow();

        if (empty($data['lab'])) {
            return redirect()->to('/guest/labs');
        }

        return view('/guest/labsdetail', $data);
    }
    public function reservation()
    {
        $query = $this->reservasi->get();
        $data['rsvp'] = $query->getResult();
        return view('/guest/reservation', $data);
    }
}
