<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        if (is_login())
            return redirect()->to('dashboard');

        $data['title'] = 'Login';
        return $this->view('login/index', $data);
    }

    public function process()
    {
        $userOrEmail = $this->request->getPost('inputuser');
        $password    = $this->request->getPost('inputpass');
        $requestUri  = $this->request->getPost('urrequest');

        $model = new \App\Models\UserModel;
        $login = $model->login($userOrEmail, $password);

        if ($login['status']) {
            $userdata = array(
                'id'       => $login['data']['id'],
                'user'     => $login['data']['user'],
                'nama'     => $login['data']['nama'],
                'foto'     => $login['data']['image'],
                'agent'    => $login['data']['agent'],
                'agent_id' => $login['data']['agent_id'],
                'access'   => $login['data']['access_id']
            );
            set_userdata($userdata);
        } else {
        }
        return redirect()->to('');
    }

    public function out()
    {
        remove_userdata();
        return redirect()->to('');
    }
}
