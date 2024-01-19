<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Setting extends BaseController
{
    public function index()
    {
        if (!is_login()) return $this->login();

        $model = new \App\Models\UserModel;
        $data['title']    = 'Account Settings';
        $data['userdata'] = $model->select([
            'email', 'verify_at'
        ])->where([
            'id' => userdata('id')
        ])->data(false);

        $this->plugin->set('scrollbar');
        return $this->view('setting/index', $data);
    }

    public function name()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change';
        return $this->view('layout/blank', $data);
    }

    public function email()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change User Email';
        $data['bread']    = ['Settings|setting', 'Change Email'];

        return $this->view('layout/blank', $data);
    }

    public function username()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change';
        return $this->view('layout/blank', $data);
    }

    public function password()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change';
        return $this->view('layout/blank', $data);
    }

    public function verify()
    {
        if (!is_login()) return $this->login();

        $model = new \App\Models\UserModel;
        $data['title']    = 'Email Verification';
        $data['bread']    = ['Settings|setting', 'Email Verification'];
        $data['userdata'] = $model->select([
            'email', 'verify_at'
        ])->where([
            'id' => userdata('id')
        ])->data(false);

        $this->plugin->set('scrollbar|inputmask');
        return $this->view('setting/verification/email', $data);
    }

    public function verifyProcess()
    {
        if (!is_login()) return $this->login();

        $otp = space_replace($this->request->getPost('verifyotp'), '');


        var_dump($otp);
    }

    public function verifySend()
    {
        $code = mt_rand(100000, 999999);

        $email = new \App\Libraries\Email;
        $email
            ->setReceiver('hsn.abdullah282@gmail.com', 'Hasan Abdullah')
            ->setSubject('Email Verification OTP Code');
        $sendResult = $email->sendOTP($code);
    }
}
