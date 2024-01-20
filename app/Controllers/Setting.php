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

        $data['title'] = 'Change Full Name';
        $data['bread'] = ['Settings|setting', 'Change Full Name'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/change/name', $data);
    }

    public function email()
    {
        if (!is_login()) return $this->login();

        $model = new \App\Models\UserModel;
        $email = $model->select(['email'])->where(['id' => userdata('id')])->data(false);

        $data['title'] = 'Change User Email';
        $data['bread'] = ['Settings|setting', 'Change Email'];
        $data['email'] = $email['email'];

        $this->plugin->set('scrollbar|icheck');
        return $this->view('setting/change/email', $data);
    }

    public function username()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change Username';
        $data['bread'] = ['Settings|setting', 'Change Username'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/change/username', $data);
    }

    public function password()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Change User Password';
        $data['bread'] = ['Settings|setting', 'Change Password'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/change/password', $data);
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
