<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class User extends BaseController
{
    protected $ModelUser;
    public function __construct()
    {
        $this->ModelUser = new UserModel();
        // $this->config = config('Auth');
    }

    public function index()
    {
        $data['title'] = "My Profile";
        return view('user/index', $data);
    }
}
