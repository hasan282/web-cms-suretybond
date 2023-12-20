<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Login ke Aplikasi';
        return $this->view('login/index', $data);
    }
}
