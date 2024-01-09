<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Login';
        return $this->view('login/index', $data);
    }

    public function process()
    {
        $userOrEmail = $this->request->getPost('inputuser');
        $password    = $this->request->getPost('inputpass');
        $requestUri  = $this->request->getPost('urrequest');

        $result = 0;

        // var_dump($userOrEmail);
        // var_dump($password);
        // var_dump($requestUri);

        // $this->session->getFlashdata('');

        // $this->session->setFlashdata('');

        return redirect()->to('');
    }
}
