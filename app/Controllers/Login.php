<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Login';
        return $this->view('login/index', $data);
    }

    public function process()
    {
    }
}
