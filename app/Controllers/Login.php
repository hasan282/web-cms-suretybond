<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if (is_login())
            return redirect()->to('dashboard');

        $model = new UserModel;
        $userhash = get_cookie('USRLOG');

        $data['title']    = 'Login';
        $data['userdata'] = $userhash === null ? null : $model->select(
            ['user', 'image', 'nama']
        )->where(['hash' => $userhash])->data(false);
        $data['flash']    = array(
            'message'  => $this->session->getFlashdata('message'),
            'invalid'  => $this->session->getFlashdata('invalid'),
            'username' => $this->session->getFlashdata('username'),
            'url'      => $this->session->getFlashdata('requesturl')
        );
        return $this->view('login/index', $data);
    }

    public function process()
    {
        $userOrEmail = $this->request->getPost('inputuser');
        $password    = $this->request->getPost('inputpass');
        $requestUri  = $this->request->getPost('urrequest') . '';

        $model = new UserModel;
        $login = $model->login($userOrEmail, $password);

        $redirect = redirect()->to('' . $requestUri);
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
            set_cookie('USRLOG', $login['data']['hash'], 60 * 60 * 24 * 5);
            $redirect->withCookies();
            if ($requestUri != '') uri_unlock($requestUri);
        } else {
            if (empty($login['data'])) {
                $this->session->setFlashdata('message', 'Account is Not Registered');
                $this->session->setFlashdata('invalid', 'user');
            } else {
                $this->session->setFlashdata('message', 'Your Password is Incorrect');
                $this->session->setFlashdata('invalid', 'pass');
                $this->session->setFlashdata('username', $login['data']['user']);
            }
        }
        return $redirect;
    }

    public function out()
    {
        remove_userdata();
        return redirect()->to('');
    }

    public function switch()
    {
        set_cookie('USRLOG', '', 0);
        delete_cookie('USRLOG');
        return redirect()->to('')->withCookies();
    }
}
