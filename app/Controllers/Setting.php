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
            'email', 'valid'
        ])->where([
            'id' => userdata('id')
        ])->data(false);

        $this->plugin->set('scrollbar');
        return $this->view('setting/index', $data);
    }

    public function verify()
    {
        if (!is_login()) return $this->login();

        $data['title'] = 'Email Verification';
        $data['bread'] = ['Settings|setting', 'Email Verification'];

        $this->plugin->set('scrollbar');
        return $this->view('setting/verification/email', $data);
    }
}
